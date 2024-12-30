<?php

if(!isset($_SESSION['id_mart_admin'])){

    $a=md5(1);
    header("Location:login.php?error=$a");
}
