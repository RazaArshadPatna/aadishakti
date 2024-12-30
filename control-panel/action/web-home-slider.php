<?php
session_start();
include '../include/connection.php';
require_once '../common/test-input.php';
require_once '../common/Image-Uploads.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];

function save_homeSlider($conn,$image,$heading1,$heading2,$heading3,$show_button,$url,$status,$entry_by,$entry_time,$city_id){
    $sql="INSERT INTO `banner`(`image`, `heading1`, `heading2`, `heading3`, `show_button`, `url`, `status`, `entry_by`, `entry_time`, `city_id`) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssssssss",$image,$heading1,$heading2,$heading3,$show_button,$url,$status,$entry_by,$entry_time,$city_id);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

function update_homeSlider($conn,$image,$heading1,$heading2,$heading3,$show_button,$url,$status,$entry_by,$entry_time,$city_id,$id){ 
    $sql="update `banner` set `image`=?, `heading1`=?, `heading2`=?, `heading3`=?, `show_button`=?, `url`=?, `status`=?, `entry_by`=?, `entry_time`=?, `city_id`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssssssss",$image,$heading1,$heading2,$heading3,$show_button,$url,$status,$entry_by,$entry_time,$city_id,$id);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

if(isset($_POST['head1'])){
                $path="../../upload/banner";
               $logo_70= addImg($path, 'logo_70');
                $heading1=$_POST['head1'];
                $heading2=$_POST['head2'];
                $heading3=$_POST['head3'];
                $show_button=$_POST['button'];
                $url=$_POST['Url'];
                $entry_time=date("YmdHis");
                $entry_by=$_SESSION['id_mart_admin'];
                $status=$_POST['status'];
                //$city_id=$_POST['city'];
				$city_id='';
        if(isset($_POST['Edit_id'])){            
            $id= test_input($_POST['Edit_id']);
            $old_logo_70=$_POST['old_70'];
        if($logo_70==""){
            $logo_70=$old_logo_70;
        }else{
              $img_path_70=$path."/$old_logo_70";
              if (file_exists("$img_path_70")){
              unlink($img_path_70);
              }
        }   
             $p= update_homeSlider($conn, $logo_70, $heading1, $heading2, $heading3, $show_button, $url, $status, $entry_by, $entry_time, $city_id,$id);
        }else{
            $p= save_homeSlider($conn, $logo_70, $heading1, $heading2, $heading3, $show_button, $url, $status, $entry_by, $entry_time, $city_id);
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



