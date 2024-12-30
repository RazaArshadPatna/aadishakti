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
$filename='Withdrawal_Lists'.$file_ending;
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
$sql = "SELECT `id`, `farmer_id`, `name`, `mobile`, `bank`, `ifsc`, `micr`, `branch`, `upi_id`, `upi_phone`, `amount`, `entry_time`, `status` FROM `withdrawal_request` WHERE 1";
$st=$conn->prepare($sql);
$i=0;
$st->bind_result($id, $farmer_id, $name, $mobile, $bank, $ifsc, $micr, $branch, $upi_id, $upi_phone, $amount, $entry_time, $status);
$st->execute();
$st->store_result();
while($st->fetch()){
    $excel[]=array(
        'FARMER ID'=>$farmer_id,
        'NAME'=>$name,
        'MOBILE'=>$mobile,
        'BANK'=>$bank,
        'IFSC'=>$ifsc,
        'MICR'=>$micr,
        'BRANCH'=>$branch,
        'UPI ID'=>$upi_id,
        'UPI PHONE'=>$upi_phone,
        'AMOUNT'=>$amount,
        'STATUS'=>$status,
        'ENTRY DATE'=>date('d-m-Y',strtotime($entry_time)),
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