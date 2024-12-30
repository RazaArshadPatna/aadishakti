<?php
include '../include/connection.php';
require_once './test-input.php';

$goto=$_SERVER['HTTP_REFERER'];
$imgid = $_POST['id'];
$pid = $_POST['pid'];
$new_img="";
$path="../upload/curricular-activity/";
$sql = "SELECT `multi_image` from `curricular_activity` where `id`=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$pid);
$stmt->bind_result($img);
if($stmt->execute()){
while($stmt->fetch()){
      
    }
$img_data = explode(',',$img);
$count = 0;
$length = sizeof($img_data)-1;
foreach($img_data as $key=>$val) {
    if($count==$length){
        break;
    }
    if($key==$imgid){
       
        $img_path=$path."/$val";
            if (file_exists("$img_path")&&!empty($val)) {
                     unlink($img_path);
            }
             
    }else{
        $new_img.= $val.',';
    }
    $count++;
}

$sql1="update `curricular_activity` set `multi_image`='".$new_img."' where id='".$pid."'";
$s=$conn->prepare($sql1);
if($s->execute()){
    echo 1;
} else {
    echo 2;
}
}
?>