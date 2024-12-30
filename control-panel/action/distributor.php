<?php
session_start();
include '../include/connection.php';
require_once '../common/test-input.php';
require_once '../common/Image-Uploads.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];

function save($conn, $dst_code, $logo_70,$name, $email, $phone, $dob, $state, $district, $city, $block,$address,$password,$status,$entry_time,$entry_by){
    $sql="INSERT INTO `distributor_data`(`dst_code`,`photo`,`name`,`email`,`phone`,`dob`,`state`,`district`,`city`,`block`,`address`,`password`,`status`,`entry_time`,`entry_by`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssssssssssss",$dst_code, $logo_70,$name, $email, $phone, $dob, $state, $district, $city, $block,$address,$password,$status,$entry_time,$entry_by);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

function update($conn,$utr_no, $photo,$name, $father, $proprietor, $center,$village,$post,$police,$panchayat,$block,$district,$state,$pin,$mobile_1,$mobile_2,$whatsapp,$aadhar,$voter,$pan,$company,$reg_no,$gst,$seed_no,$fertilizer_no,$pesticide_no,$other_no,$apply_lic,$password,$entry_date,$status,$id){ 
    $sql="update `distributor_registration` set `utr_no`=?, `photo`=?, `name`=?, `father`=?, `proprietor`=?, `center`=?, `village`=?, `post`=?, `police`=?, `panchayat`=?, `block`=?, `district`=?, `state`=?, `pin`=?, `mobile_1`=?, `mobile_2`=?, `whatsapp`=?, `aadhar`=?, `voter`=?, `pan`=?, `company`=?, `reg_no`=?, `gst`=?, `seed_no`=?, `fertilizer_no`=?, `pesticide_no`=?, `other_no`=?, `apply_lic`=?, `password`=?, `entry_date`=?, `status`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssssssssssssssssssssssssssssss",$utr_no, $photo,$name, $father, $proprietor, $center,$village,$post,$police,$panchayat,$block,$district,$state,$pin,$mobile_1,$mobile_2,$whatsapp,$aadhar,$voter,$pan,$company,$reg_no,$gst,$seed_no,$fertilizer_no,$pesticide_no,$other_no,$apply_lic,$password,$entry_date,$status,$id);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

if(isset($_POST['name'])){
                $path="../../upload/distributor_photo";
                $photo= addImg($path, 'photo');
				
                $utr_no=$_POST['utr_no'];
        $name=$_POST['name'];
        $father=$_POST['father'];
        $proprietor=$_POST['proprietor'];
        $center=$_POST['center'];
        $village=$_POST['village'];
        $post=$_POST['post'];
        $police=$_POST['police'];
        $panchayat=$_POST['panchayat'];
        $block=$_POST['block'];
        $district=$_POST['district'];
        $state=$_POST['state'];
        $pin=$_POST['pin'];
        $mobile_1=$_POST['mobile_1'];
        $mobile_2=$_POST['mobile_2'];
        $whatsapp=$_POST['whatsapp'];
        $aadhar=$_POST['aadhar'];
        $voter=$_POST['voter'];
        $pan=$_POST['pan'];
        $company=$_POST['company'];
        $reg_no=$_POST['reg_no'];
        $gst=$_POST['gst'];
        $seed_no=$_POST['seed_no'];
        $fertilizer_no=$_POST['fertilizer_no'];
        $pesticide_no=$_POST['pesticide_no'];
        $other_no=$_POST['other_no'];
        $apply_lic=$_POST['apply_lic'];
        $password=$_POST['password'];
        $entry_date=date("YmdHis");
        $status = $_POST['status'];
                
        if(isset($_POST['Edit_id'])){            
            $id= test_input($_POST['Edit_id']);
            $old_img=$_POST['old_img'];
        if($photo==""){
            $photo=$old_img;
        }else{
              $img_path_70=$path."/$old_img";
              if (file_exists("$img_path_70")){
              unlink($img_path_70);
              }
        }   
             $p= update($conn,$utr_no, $photo,$name, $father, $proprietor, $center,$village,$post,$police,$panchayat,$block,$district,$state,$pin,$mobile_1,$mobile_2,$whatsapp,$aadhar,$voter,$pan,$company,$reg_no,$gst,$seed_no,$fertilizer_no,$pesticide_no,$other_no,$apply_lic,$password,$entry_date,$status,$id);
        }else{
            //$p= save($conn, $dst_code, $logo_70,$name, $email, $phone, $dob, $state, $district, $city, $block,$address,$password,$status,$entry_time,$entry_by);
        }
        
        if($p){
            $_SESSION['msg']="success";
            ?>
           <script>window.location.href="<?php echo $goto;?>";</script>
       <?php }else{
            $_SESSION['error']="error";
            ?>
          <script>window.location.href="<?php echo $goto;?>";</script>
       <?php } }



