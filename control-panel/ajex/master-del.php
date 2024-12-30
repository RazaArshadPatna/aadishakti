<?php
session_start();
require_once '../include/connection.php';

$table_name=$_REQUEST['table'];
$ids=$_REQUEST['all'];

function del($conn,$id,$table_name){
    $sql="delete from $table_name where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("s",$id);
    if($s->execute()){
        return true;
    }else{
        return false;
    }
}


foreach($ids as $val){
    del($conn,$val,$table_name);
}
