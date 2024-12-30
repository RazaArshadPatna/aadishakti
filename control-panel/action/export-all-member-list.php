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
$filename='All_Members_Lists'.$file_ending;
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename");  
header("Pragma: no-cache"); 
header("Expires: 0");

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
  function get_app_name($conn,$apply_for){
    $sql = "SELECT `heading1` FROM `master_reg_amount` WHERE `cat_id`='".$apply_for."'";
    $st = $conn->prepare($sql);
    $st->bind_result($heading);
    $st->execute();
    $st->fetch();
    $st->close();
    return $heading;
  }
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
$sql = "SELECT `id`, `farmer_app_no`, `utr_number`, `apply_for`, `grp_id`, `applicant_name`, `father`, `dob`, `age`, `category`, `village`, `post`, `panchayat`, `police`, `block`, `subdivision`, `district`, `state`, `pin`, `mobile`, `whatsapp`, `aadhar`, `pan`, `nominee`, `nominee_age`, `relation`, `kcc`, `kcc_number`, `land_village`, `land_type`, `area`, `irrigated_land`, `source_irrigation`, `equipment`, `types_of_farming`, `other_agriculture`, `spices`, `village_industry`, `more_info`, `ward`, `photo`, `password`, `status`, `entry_by`, `entry_date` FROM `farmer_registration` WHERE 1";
$st=$conn->prepare($sql);
$i=0;
$st->bind_result($id, $farmer_app_no, $utr_number, $apply_for, $grp_id, $applicant_name, $father, $dob, $age, $category, $village, $post, $panchayat, $police, $block, $subdivision, $district, $state, $pin, $mobile, $whatsapp, $aadhar, $pan, $nominee, $nominee_age, $relation, $kcc, $kcc_number, $land_village, $land_type, $area, $irrigated_land, $source_irrigation, $equipment, $types_of_farming, $other_agriculture, $spices, $village_industry, $more_info, $ward, $photo, $password, $status, $entry_by, $entry_date);
$st->execute();
$st->store_result();
while($st->fetch()){
    $excel[]=array(
        'Farmer Code'=>$farmer_app_no,
        'UTR'=>$utr_number,
        'APPLY FOR'=>get_app_name($conn,$apply_for),
        'NAME'=>$applicant_name,
        'FATHER'=>$father,
        'DOB'=>date('d-m-Y',strtotime($dob)),
        'AGE'=>$age,
        'CATEGORY'=>$category,
        'WARD'=>$ward,
        'PHOTO'=>$url.'farmer_photo/'.$photo,
        'VILLAGE'=>$village,
        'POST'=>get_post($conn,$post),
        'PANCHAYAT'=>$panchayat,
        'POLICE'=>$police,
        'BLOCK'=>$block,
        'SUBDIVISION'=>$subdivision,
        'DISTRICT'=>$district,
        'STATE'=>get_state($conn,$state),
        'PIN'=>$pin,
        'MOBILE'=>$mobile,
        'WHATSAPP'=>$whatsapp,
        'AADHAR'=>$aadhar,
        'PAN'=>$pan,
        'NOMINEE'=>$nominee,
        'NOMINEE AGE'=>$nominee_age,
        'RELATION'=>$relation,
        'KCC'=>$kcc,
        'KCC NO'=>$kcc_number,
      
        'LAND VILLAGE'=>$land_village,
        'LAND TYPE'=>$land_type,
        'AREA'=>$area,
        'IRRIGATED LAND'=>$irrigated_land,
        'SOURCE IRRIGATION'=>$source_irrigation,
        'EQUIPMENT'=>$equipment,
        'TYPES OF FARMING'=>$types_of_farming,
        'OTHER AGRICULTURE'=>$other_agriculture,
        'SPICE'=>$spices,
        'VILLAGE INDUSTRY'=>$village_industry,
        
        'PASSWORD'=>$password,
        'STATUS'=>$status,
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