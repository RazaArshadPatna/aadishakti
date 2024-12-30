<?php
session_start();
unset($_SESSION['hash_key']);
unset($_SESSION['id_mart_admin']);
unset($_SESSION['email_admin']);
unset($_SESSION['name_admin']);
unset($_SESSION['mobile']);
unset($_SESSION['avtar']);
unset($_SESSION['roll']);
unset($_SESSION['reg']);

header("Location:login.php");
?>

