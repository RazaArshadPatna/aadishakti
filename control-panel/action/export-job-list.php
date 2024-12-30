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
$filename='Job_Lists'.$file_ending;
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
function get_song($conn,$id){
    $sql = "SELECT `name` FROM song_language WHERE `id`='".$id."'";
    $st=$conn->prepare($sql);
    $st->bind_result($gname);
    $st->execute();
    $st->fetch();
    $st->close();
    return $gname;
}
function getadmin($conn,$id){
    $sql = "SELECT `email` FROM admin_member WHERE `admin_id`='".$id."'";
    $st=$conn->prepare($sql);
    $st->bind_result($gname);
    $st->execute();
    $st->fetch();
    $st->close();
    return $gname;
}
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
$sql = "SELECT `id`, `app_no`, `utr_no`, `state`, `post`, `name`, `father`, `reference`, `reference_name`, `aadhar_no`, `pan_no`, `dob`, `email`, `gender`, `category`, `whatsapp`, `mobile`, `village`, `panchayat`, `block`, `district`, `pin`, `country`, `qualification`, `college`, `passing_year`, `technical_knowledge`, `experience`, `organisation`, `payment_slip`, `photo`, `entry_date`, `status` FROM `job_apply` WHERE 1";
$st=$conn->prepare($sql);
$i=0;
$st->bind_result($id, $app_no, $utr_no, $state, $post, $name, $father, $reference, $reference_name, $aadhar_no, $pan_no, $dob, $email, $gender, $category, $whatsapp, $mobile, $village, $panchayat, $block, $district, $pin, $country, $qualification, $college, $passing_year, $technical_knowledge, $experience, $organisation, $payment_slip, $photo, $entry_date, $status);
$st->execute();
$st->store_result();
while($st->fetch()){
    $excel[]=array(
        'Application No'=>$app_no,
        'UTR'=>$utr_no,
        'STATE'=>get_state($conn,$state),
        'POST'=>get_post($conn,$post),
        'NAME'=>$name,
        'FATHER'=>$father,
        'REFERENCE'=>$reference,
        'REFERENCE NAME'=>$reference_name,
        'AADHAR'=>$aadhar_no,
        'PAN'=>$pan_no,
        'DOB'=>date("d-m-Y",strtotime($dob)),
        'EMAIL'=>$email,
        'GENDER'=>$gender,
        'CATEGORY'=>$category,
        'WHATSAPP'=>$whatsapp,
        'MOBILE'=>$mobile,
        'VILLAGE'=>$village,
        'PANCHAYAT'=>$panchayat,
        'BLOCK'=>$block,
        'DISTRICT'=>$district,
        'PIN'=>$pin,
        'COUNTRY'=>$country,
        'QUALIFICATION'=>$qualification,
        'COLLEGE'=>$college,
        'PASSING YEAR'=>$passing_year,
        'TECHNIKAL KNOWLEDGE'=>$technical_knowledge,
        'EXPERIENCE'=>$experience,
        'ORGANISATION'=>$organisation,
        'PAYMENT SLIP'=>$url.'payment_slip/'.$payment_slip,
        'PHOTO'=>$url.'photo/'.$photo,
        'ENTRY DATE'=>date('d-m-Y',strtotime($entry_date)),
        'STATUS'=>$status,
        

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