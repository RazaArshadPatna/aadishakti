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
$filename='Distributor_Lists'.$file_ending;
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
$sql = "SELECT `id`, `dst_code`, `utr_no`, `photo`, `name`, `father`, `proprietor`, `center`, `village`, `post`, `police`, `panchayat`, `block`, `district`, `state`, `pin`, `mobile_1`, `mobile_2`, `whatsapp`, `aadhar`, `voter`, `pan`, `company`, `reg_no`, `gst`, `seed_no`, `fertilizer_no`, `pesticide_no`, `other_no`, `apply_lic`, `password`, `entry_date`, `status` FROM `distributor_registration` WHERE 1";
$st=$conn->prepare($sql);
$i=0;
$st->bind_result($id, $dst_code, $utr_no, $photo, $name, $father, $proprietor, $center, $village, $post, $police, $panchayat, $block, $district, $state, $pin, $mobile_1, $mobile_2, $whatsapp, $aadhar, $voter, $pan, $company, $reg_no, $gst, $seed_no, $fertilizer_no, $pesticide_no, $other_no, $apply_lic, $password, $entry_date, $status);
$st->execute();
$st->store_result();
while($st->fetch()){
    $excel[]=array(
        'DISTRIBUTOR CODE'=>$dst_code,
        'UTR'=>$utr_no,
        'PHOTO'=>$url.'distributor_photo/'.$photo,
        'NAME'=>$name,
        'FATHER'=>$father,
        'PROPRIETOR'=>$proprietor,
        'CENTER'=>$center,
        'VILLAGE'=>$village,
        'POST'=>$post,
        'POLICE'=>$police,
        'PANCHAYAT'=>$panchayat,
        'BLOCK'=>$block,
        'DISTRICT'=>$district,
        'STATE'=>get_state($conn,$state),
        'PIN'=>$pin,
        'MOBILE1'=>$mobile_1,
        'MOBILE2'=>$mobile_2,
        'WHATSAPP'=>$whatsapp,
        'AADHAR'=>$aadhar,
        'VOTER'=>$voter,
        'PAN'=>$pan,
        'COMPANY'=>$company,
        'REG_NO'=>$reg_no,
        'SEED LIC NO'=>$seed_no,
        'FERTILIZER LIC NO'=>$fertilizer_no,
        'PESTICIDE LIC NO'=>$pesticide_no,
        'OTHER LIC NO'=>$other_no,
        'APPLIED LIC'=>$apply_lic,
        'PASSWORD'=>$password,
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