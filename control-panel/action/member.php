<?php
session_start();
include '../include/connection.php';
require_once '../common/Image-Uploads.php';
require_once '../common/test-input.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];



function update($conn,$utr_number, $apply_for,$grp_id, $applicant_name, $father, $dob,$age,$category,$village,$post,$panchayat,$police,$block,$subdivision,$district,$state,$pin,$mobile,$whatsapp,$aadhar,$pan,$nominee,$nominee_age,$relation,$kcc,$kcc_number,$land_village,$land_type,$area,$irrigated_land,$source_irrigation,$equipment,$crop_details,$other_agriculture,$spices,$village_industry,$more_info,$status,$ward,$photo,$password,$id){ 
    $sql="update `farmer_registration` set `utr_number`=?, `apply_for`=?, `grp_id`=?, `applicant_name`=?, `father`=?, `dob`=?, `age`=?, `category`=?, `village`=?,`post`=?,`panchayat`=?,`police`=?, `block`=?, `subdivision`=?, `district`=?, `state`=?, `pin`=?, `mobile`=?, `whatsapp`=?, `aadhar`=?, `pan`=?, `nominee`=?,`nominee_age`=?,`relation`=?, `kcc`=?, `kcc_number`=?, `land_village`=?, `land_type`=?, `area`=?, `irrigated_land`=?, `source_irrigation`=?, `equipment`=?, `types_of_farming`=?, `other_agriculture`=?, `spices`=?, `village_industry`=?, `more_info`=?, `status`=?,`ward`=?,`photo`=?,`password`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssssssssssssssssssssssssssssssssssssssss",$utr_number, $apply_for,$grp_id, $applicant_name, $father, $dob,$age,$category,$village,$post,$panchayat,$police,$block,$subdivision,$district,$state,$pin,$mobile,$whatsapp,$aadhar,$pan,$nominee,$nominee_age,$relation,$kcc,$kcc_number,$land_village,$land_type,$area,$irrigated_land,$source_irrigation,$equipment,$crop_details,$other_agriculture,$spices,$village_industry,$more_info,$status,$ward,$photo,$password,$id);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

if(isset($_POST['edit_id'])){
        $path1="../../upload/farmer_photo";
        $photo=addImg($path1, 'photo');
        $width=3; $table_name="farmer_registration";$prefix="FRM".date('Y');
        $farmer_app_no= getLastID($conn, $width, $table_name, $prefix);
        $utr_number=$_POST['utr_number'];
        $apply_for=$_POST['apply_for'];
        $grp_id=$_POST['grp_id'];
        $applicant_name=$_POST['applicant_name'];
        $father=$_POST['father'];
        $dob=$_POST['dob'];
        $age=$_POST['age'];
        $category=$_POST['category'];
        $village=$_POST['village'];
        $post=$_POST['post'];
        $panchayat=$_POST['panchayat'];
        $police=$_POST['police'];
        $block=$_POST['block'];
        $subdivision=$_POST['subdivision'];
        $district=$_POST['district'];
        $state=$_POST['state'];
        $pin=$_POST['pin'];
        $mobile=$_POST['mobile'];
        $whatsapp=$_POST['whatsapp'];
        $aadhar=$_POST['aadhar'];
        $pan=$_POST['pan'];
        $nominee=$_POST['nominee'];
        $nominee_age=$_POST['nominee_age'];
        $relation=$_POST['relation'];
        $kcc=$_POST['kcc'];
        $kcc_number=$_POST['kcc_number'];
        $land_village=$_POST['land_village'];
        $land_type=$_POST['land_type'];
        $area=$_POST['area'];
        $irrigated_land=$_POST['irrigated_land'];
        $source_irrigation=$_POST['source_irrigation'];
        $equipment=$_POST['equipment'];
        $types_of_farming=$_POST['crop_details'];
        $crop_details='';
        $ward = $_POST['ward'];
        for($i=0;$i<sizeof($types_of_farming);$i++){
            $crop_details.=$types_of_farming[$i].',';
        }
        
        $other_agriculture=$_POST['other_agriculture'];
        $spices=$_POST['spice'];
        $village_industry=$_POST['village_industry'];
        $status = $_POST['status'];
        $more_info = $_POST['more_info'];
        $entry_by = $_SESSION['emp_code'];
        $entry_time=date("YmdHis");
        $password = $_POST['password'];
        $id = $_POST['edit_id'];
        $old_img=$_POST['old_img'];
            if($photo==""){
             $photo=$old_img;
            }else{
                $img_path=$path1."/$old_img";
                if (!file_exists("$img_path")) {
                unlink($img_path);
                }
            }
           
            $p= update($conn,$utr_number, $apply_for,$grp_id, $applicant_name, $father, $dob,$age,$category,$village,$post,$panchayat,$police,$block,$subdivision,$district,$state,$pin,$mobile,$whatsapp,$aadhar,$pan,$nominee,$nominee_age,$relation,$kcc,$kcc_number,$land_village,$land_type,$area,$irrigated_land,$source_irrigation,$equipment,$crop_details,$other_agriculture,$spices,$village_industry,$more_info,$status,$ward,$photo,$password,$id);
            }
        if($p){
            $_SESSION['msg']="Farmer Details Updated Successfully!!";
            
            ?>
           <script>window.location.href="<?php echo $goto?>";</script>
       <?php }else{
            $_SESSION['error']="error";
            ?>
          <script>window.location.href="<?php echo $goto;?>";</script>
       <?php } 



