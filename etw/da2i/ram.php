<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey and Ratings</title>
</head>
<body>
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $str = $_POST['str'];
    $tab = $_POST['tab'];
    $sql = "CREATE TABLE IF NOT EXISTS $tab(
    id int(11) PRIMARY KEY AUTO_INCREMENT,
    str int(1) not null)";
    $r = mysqli_query($conn, $sql);
    if (!$r) {
        echo 'Error creating table: ' . mysqli_connect_error($conn);
    }
    $sql = "INSERT INTO $tab (str) VALUES (?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $str);
        $stmt->execute();
        $stmt->close();
    } else {
        error_log("Error preparing statement: " . mysqli_error($conn));
        die("Error preparing statement");
    }
    function getCountByRating($conn,$tab, $ratingValue) {
        $sql = "SELECT COUNT(str) AS count FROM $tab WHERE str ='$ratingValue'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['count'];
        } else {
            return -1;
        }
    }
    $c1 = getCountByRating($conn,$tab, 1);
    $c2 = getCountByRating($conn,$tab, 2);
    $c3 = getCountByRating($conn,$tab, 3);
    $c4 = getCountByRating($conn, $tab,4);
    $c5 = getCountByRating($conn,$tab, 5);
    $sum = $c1 + $c2 + $c3 + $c4 + $c5;
    $s = (1 * $c1 + $c2 * 2 + $c3 * 3 + $c4 * 4 + $c5 * 5) / $sum;
    if ($s >= 4) {
        $s1 = 100;
        $s2 = 100;
        $s3 = 100;
        $s4 = 100;
        $s5 = ($s - 4) * 100;
    } elseif ($s >= 3 and $s <= 4) {
        $s1 = 100;
        $s2 = 100;
        $s3 = 100;
        $s4 = ($s - 3) * 100;
        $s5 = 0;
    } elseif ($s >= 2 and $s <= 3) {
        $s1 = 100;
        $s2 = 100;
        $s3 = ($s - 2) * 100;
        $s4 = 0;
        $s5 = 0;
    } elseif ($s >= 1 and $s <= 2) {
        $s1 = 100;
        $s2 = ($s - 1) * 100;
        $s3 = 0;
        $s4 = 0;
        $s5 = 0;
    } else {
        $s1 = $s * 100;
        $s2 = 0;
        $s3 = 0;
        $s4 = 0;
        $s5 = 0;
    }}
?>

<style>
*{
    margin: 0;
    padding: 0;
}
body{
     margin: 0;
    padding: 0;
    height: 350px;
    width: 300px;
}
form{
    margin-top:15px;
   margin-left:10px;
    width: 300px;
     /* border:1.5px solid black; */
    border-radius: 25px;
    background-color: #ffffff;
   height: 350px;
   box-shadow: 2px 2px 15px 0px rgba(0, 0, 0, 0.2);

}

span{
    position: relative;
    font-size: 20px;
    margin-top: 10px;
    left: -1%;
}
img{
    margin-top: 15px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 7px solid steelblue;
     margin-left: 30%;
     margin-right: 30%;
}
h1{
    text-align:center;
     margin-top:-15px;
     margin-bottom:15px;
}
h3{
    text-align: center;
    padding: 10px;
}
.bt {
    display: flex;
    justify-content: center;
    margin: 0.2%;

    /* تعديل هامش العناصر */
    margin-top: -7.5%; /* قم بتجربة القيم للحصول على المسافة المطلوبة */
    margin-bottom:-4.5%;
}

.ver {
    position: relative;
    margin: 0;
    margin-left: 51%;
    margin-top: -9.4%;
}

.tab{
    color: transparent;
    background-color: transparent;
    position: relative;
    top: -100px;
     border:none; 
    z-index: -1;
}
input[type="submit"]:hover{
    background: chocolate ;
    transform: scale(1.2);
    transition:  transform 0.4s, background 0.4s;
}

input[type="submit"]{
    width: 40px;
    height: 40px;
   background: rgb(213, 212, 212);
   /* background: linear-gradient(90deg, chocolate 55%, transparent 10%); */
  clip-path: polygon(48% 8%, 60.36% 33.04%, 88% 37.08%, 68% 56.56%, 72.72% 84.08%, 48% 71.08%, 23.28% 84.08%, 28% 56.56%, 8% 37.08%, 35.64% 33.04%, 48% 8%);
 color: transparent; 
 cursor: pointer;
 margin: 2.5px;
}



</style>
<form method="post"   action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="prof">
    <img src="unknown.png" alt="Hashimi">
   
</div><input type="text" class="tab" name="tab" value="ram">
     <h1>Ramla Babaha</h1>
         <div class="bt" >
     <input type="submit" name="str" id="s1" value="1">
     <input type="submit" name="str" id="s2" value="2">
     <input type="submit" name="str" id="s3" value="3">
     <input type="submit" name="str" id="s4" value="4">
     <input type="submit" name="str" id="s5" value="5"><span id="s11"></span>
     </div>
    <h3>طالب في DA2I</h3>
   </form>
<script>
    let r1=document.getElementById('s1')
    let r2=document.getElementById('s2')
    let r3=document.getElementById('s3')
    let r4=document.getElementById('s4')
    let r5=document.getElementById('s5')
    let r11=document.getElementById('s11')
    let i=1
     const etw =()=>{
    r1.style.background='linear-gradient(90deg, chocolate  <?php echo $s1?>%,  rgb(213, 212, 212) 10%)'
    r2.style.background='linear-gradient(90deg, chocolate  <?php echo $s2?>%,  rgb(213, 212, 212) 10%)'
    r3.style.background='linear-gradient(90deg, chocolate  <?php echo $s3?>%,  rgb(213, 212, 212) 10%)'
    r4.style.background='linear-gradient(90deg, chocolate  <?php echo $s4?>%,  rgb(213, 212, 212) 10%)'
    r5.style.background='linear-gradient(90deg, chocolate  <?php echo $s5?>%,  rgb(213, 212, 212) 10%)'
    r11.innerHTML='(<?php echo number_format($s, 2)?>)'}
       window.onload = function() {
    if (sessionStorage.getItem('loadCount')) {
        var loadCount = sessionStorage.getItem('loadCount');
        loadCount++;
        sessionStorage.setItem('loadCount', loadCount);
    } else {
        sessionStorage.setItem('loadCount', 1);
    }
    etw();
}
</script>
</body>
</html>
