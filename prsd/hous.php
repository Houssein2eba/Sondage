
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!isset($_SESSION["user"])){
  header("location:http://localhost/prep/users/login.html");
  exit();
}
$user=$_SESSION["user"];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valeur = $_POST['rat'];
    $type = $_POST['sond'];
    
    $sql="SELECT * from sondage where nom_rat=? and id_user=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("ss",$type,$user);
$stmt->execute();
$res=$stmt->get_result();

if($res->num_rows===0){
  // stop here
    $sql = "INSERT INTO sondage (nom_rat,valeur,id_user) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss",$type,$valeur,$user);
        $stmt->execute();
        $stmt->close();
    } else {
        error_log("Error preparing statement: " . mysqli_error($conn));
        die("Error preparing statement");
    }

    function getCountByRating($conn,$type,$ratingValue) {
      $sql = "SELECT COUNT(valeur) AS count FROM sondage WHERE valeur ='$ratingValue' and nom_rat='$type'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
          $row = mysqli_fetch_assoc($result);
          return $row['count'];
      } else {
          return -1;
      }
  }
  $c1 = getCountByRating($conn,$type ,'Poor');
  $c2 = getCountByRating($conn,$type ,'Fair');
  $c3 = getCountByRating($conn,$type,'Good');
  $c4 = getCountByRating($conn,$type ,'Very Good');
  $c5 = getCountByRating($conn,$type,'Excellent');
  $sum = $c1 + $c2 + $c3 + $c4 + $c5;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey and Ratings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<style>
body {
    font-family: Arial, sans-serif;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}
form {
    background:#ffffff;
    border: 1px solid #ccc;
    padding: 30px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
button {
    color: #303d31;
    padding: 10px 20px;
    width: 90%;
    border: 2px solid black;
    border-radius: 4px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    font-size: 24px;
    background: #bbd6bc;
}
span{
    margin: left 100px;
}
h1 {
    text-align: center;
    margin-top: 0;
}
.in{
    position: fixed;
    z-index: -19;
    width: 0px;
    margin-top:25px;
    border:none;
    margin-bottom:-25px;
}
</style>
<div>

    <form method="post"   action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>Housing and Real Estate</h1>   
    <label>Rating:</label>
        <input type="text" class="in" name="sond" value="Housing and Real Estate">
        <button type="submit" id="r1" name="rat" value="Poor" class="h1">Poor <span id="r11"></span></button><br>
        <button type="submit" id="r2" name="rat" value="Fair" class="h2">Fair<span id="r12"></span></button><br>
        <button type="submit" id="r3" name="rat" value="Good" class="h3">Good<span id="r13"></span></button><br>
        <button type="submit" id="r4" name="rat" value="Very Good" class="h4">Very Good<span id="r14"></span></button><br>
        <button type="submit" id="r5" name="rat" value="Excellent" class="h5">Excellent<span id="r15"></span></button><br><br>
    </form>
</div>
<script>
    let r1=document.getElementById('r1')
    let r2=document.getElementById('r2')
    let r3=document.getElementById('r3')
    let r4=document.getElementById('r4')
    let r5=document.getElementById('r5')
    let r11=document.getElementById('r11')
    let r12=document.getElementById('r12')
    let r13=document.getElementById('r13')
    let r14=document.getElementById('r14')
    let r15=document.getElementById('r15')
    let i=1
    const sond =()=>{
        r11.innerHTML='<span><?php echo number_format($c1 / $sum * 100, 2) ?>%</span>'
        r12.innerHTML='<span><?php echo number_format($c2 / $sum * 100, 2) ?>%</span>'
        r13.innerHTML='<span><?php echo number_format($c3 / $sum * 100, 2) ?>%</span>'
        r14.innerHTML='<span><?php echo number_format($c4 / $sum * 100, 2) ?>%</span>'
        r15.innerHTML='<span><?php echo number_format($c5 / $sum * 100, 2) ?>%</span>'
        r1.style.background='linear-gradient(90deg, #bbd6bc 0%, #bbd6bc <?php echo $c1/$sum*100?>%, transparent <?php echo $c1/$sum*100?>%)'
        r2.style.background='linear-gradient(90deg, #bbd6bc 0%, #bbd6bc <?php echo $c2/$sum*100?>%, transparent <?php echo $c2/$sum*100?>%)'
        r3.style.background='linear-gradient(90deg, #bbd6bc 0%, #bbd6bc <?php echo $c3/$sum*100?>%, transparent <?php echo $c3/$sum*100?>%)'
        r4.style.background='linear-gradient(90deg, #bbd6bc 0%, #bbd6bc <?php echo $c4/$sum*100?>%, transparent <?php echo $c4/$sum*100?>%)'
        r5.style.background='linear-gradient(90deg, #bbd6bc 0%, #bbd6bc <?php echo $c5/$sum*100?>%, transparent <?php echo $c5/$sum*100?>%)'

        r1.type='button';
           r2.type='button';
           r3.type='button';
           r4.type='button';
           r5.type='button';
    }
   window.onload = function() {
    if (sessionStorage.getItem('loadCount')) {
        var loadCount = sessionStorage.getItem('loadCount');
        loadCount++;
        sessionStorage.setItem('loadCount', loadCount);
    } else {
        sessionStorage.setItem('loadCount', 1);
    }
    if (sessionStorage.getItem('loadCount') >= 2) {
        sond();
    }
}
</script>

</body>
</html>
