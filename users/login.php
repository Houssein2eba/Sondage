<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة الدخول</title>
    <link rel="stylesheet" href="STYLE.css">
</head>
<body>

<section class="container">
    <div class="login-container">
        <div class="circle circle-one"></div> <div class="circle circle-two"></div><div class="form-container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            
                <h1 class="opacity">LOG IN</h1>
                <input type="text" name="user" placeholder="USERNAME OR TELPHONE" required/>
                <input type="password" name="passw" placeholder="PASSWORD" required/>
                <button  class="opacity">Login</button>
                <div class="register-forget opacity">
            <a href="Rej.php">REGISTRER</a>

        </div>
            </div>
        </form>
        <div class="register-forget opacity">
            <a href="location:http://localhost/prep/users/Rej.php">REGISTRER</a>

        </div>
        
    </div>
   
</div>
<div class="theme-btn-container"></div>
</section>
</body>
</html>
<?php
session_start();

$servername = "localhost";
$username = "hashimi";
$password = "26si61da91ty32";
$dbname = "Web";
$con = mysqli_connect($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["user"];
    $passw = $_POST["passw"];

    $sql = "SELECT id FROM User WHERE (NOM=? OR tel=?) and password=?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $nom, $nom, $passw);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $_SESSION["id"] = $row['id'];
        header("Location: http://localhost/prep/usr/0pre.php");
        exit; 
    } else {
        echo "<script>alert('User Not Found')</script>";
    }
} else {
    die("statement error");
}
?>
