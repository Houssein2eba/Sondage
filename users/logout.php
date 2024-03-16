<?php
session_start();
session_destroy();
header("location:http://localhost/prep/users/login.html");
exit();
?>