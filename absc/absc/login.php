<?php
ob_start();
session_start();
include "db.php";
$check_user = mysqli_query($conn, "SELECT * FROM auth WHERE ALogin = '".mysqli_real_escape_string($conn,$_POST['login'])."'");
$data = mysqli_fetch_assoc($check_user);
if($data['APassword'] === $_POST['password']) {
    header("Location: students.php");
    $_SESSION["mes_true"] = true;
}
else {
    header("Location: Admin.php");
    $_SESSION["mes_false"] = true;
}
ob_end_flush();
?>
