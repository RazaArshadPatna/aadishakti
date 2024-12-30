<?php
session_start();
include '../include/connection.php';
require_once '../common/Image-Uploads.php';
require_once '../common/test-input.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];

$status= test_input($_POST['status']);
$id = test_input($_POST['id']);

$sql="update  `withdrawal_request` set `status`=? where id=?";
$s=$conn->prepare($sql);
$s->bind_param("ss",$status,$id);
if($s->execute()){
    return true;
} else {
    return FALSE;
}
                

