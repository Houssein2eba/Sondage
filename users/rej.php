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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            
                <h1 class="opacity">REGISTER</h1>
                <input type="text" name="user" placeholder="USERNAME" required/>
                <input type="number" min="20000000" max="49999999" name="tel" placeholder="TELPHONE"required/>
                <input type="password" name="passw" placeholder="PASSWORD" required/>
                <button class="opacity">SUBMIT</button>
                 <div class="register-forget opacity">
            <a href="login.php">LOGIN</a>
        </div>
            </div>
        </form>
       
        

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

// Create the database connection
$con = mysqli_connect($servername, $username, $password, $dbname);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["user"];
    $tel = $_POST["tel"];
    $passw = $_POST["passw"];

    // Create the User table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS User (
            id int(11) PRIMARY KEY AUTO_INCREMENT,
            NOM varchar(56) not null,
            tel int(11) not null,
            password varchar(255) not null
        );";

    $r = mysqli_query($con, $sql);
    if (!$r) {
        echo 'Error creating table: ' . mysqli_error($con);
        exit;
    }

    // Check if the user already exists
    $sql = "SELECT id FROM User WHERE (NOM=? AND password=?) OR tel=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssi", $nom, $passw, $tel);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        echo "<script>alert('المستخدم موجود مسبقا')</script>";
    } else {
        // Insert the new user
        $sql = "INSERT INTO User (NOM, tel, password) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sis", $nom, $tel, $passw);
        $stmt->execute();
        $stmt->close();

        // Set the session variable
        $_SESSION["id"] = mysqli_insert_id($con);

        // Redirect to the desired page after successful registration
        header("Location: http://localhost/prep/usr/0pre.php");
        exit;
    }
} else {
    die("Statement error");
}
?>
