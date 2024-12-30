<?php
session_start();
include '../include/connection.php';
require_once '../common/test-input.php';
require_once '../common/Image-Uploads.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];
$url = "http://localhost/agromitra/upload/";
$goto=$_SERVER['HTTP_REFERER'];

$file_ending = ".xls";
$filename='Group_Lists'.$file_ending;
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename");  
header("Pragma: no-cache"); 
header("Expires: 0");
function get_genere($conn,$gid){
$sql = "SELECT `name` FROM genere WHERE `id`='".$gid."'";
$st=$conn->prepare($sql);
$st->bind_result($gname);
$st->execute();
$st->fetch();
$st->close();
return $gname;
}
function get_state($conn,$id){
    $sql = "SELECT `heading1` FROM `master_state` WHERE `cat_id`='".$id."'";
    $st=$conn->prepare($sql);
    $st->bind_result($state);
    $st->execute();
    $st->fetch();
    $st->close();
    return $state;
}
function get_post($conn,$post){
    $sql = "SELECT `heading1` FROM `master_post` WHERE `cat_id`='".$post."'";
    $st= $conn->prepare($sql);
    $st->bind_result($post);
    $st->execute();
    $st->fetch();
    $st->close();
    return $post;
  }

/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
$sql = "SELECT `id`, `grp_id`, `grp_name`, `farmer_grp_id`, `consultant_name`, `consultant_code`, `product_details`, `entry_date`, `status` FROM `farmer_group` WHERE 1";
$st=$conn->prepare($sql);
$i=0;
$st->bind_result($id, $grp_id, $grp_name, $farmer_grp_id, $consultant_name, $consultant_code, $product_details, $entry_date, $status);
$st->execute();
$st->store_result();
while($st->fetch()){
    $excel[]=array(
        'GROUP_ID'=>$farmer_grp_id,
        'GROUP NAME'=>$grp_name,
        'CONSULTANT NAME'=>$consultant_name,
        'CONSULTANT CODE'=>$consultant_code,
        'PRODUCT DETAILS'=>$product_details,
        'ENTRY DATE'=>date('d-m-Y',strtotime($entry_date)),
        );
}
$flag = false; 
foreach($excel as $row) { 
    if(!$flag) { 
        // display column names as first row 
        echo implode("\t", array_keys($row)) . "\n"; 
        $flag = true; 
    } 
    // filter data 
    array_walk($row, 'filterData'); 
    echo implode("\t", array_values($row)) . "\n"; 
} 
 
exit;
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}
?>