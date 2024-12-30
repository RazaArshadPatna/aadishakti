<?php
session_start();
include '../include/connection.php';
require_once '../common/test-input.php';
require_once '../common/Image-Uploads.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];

function save($conn, $emp_code, $logo_70,$name, $email, $phone, $dob, $state, $district, $city, $block,$address,$password,$status,$entry_time,$entry_by){
    $sql="INSERT INTO `employee_data`(`emp_code`,`photo`,`name`,`email`,`phone`,`dob`,`state`,`district`,`city`,`block`,`address`,`password`,`status`,`entry_time`,`entry_by`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssssssssssss",$emp_code, $logo_70,$name, $email, $phone, $dob, $state, $district, $city, $block,$address,$password,$status,$entry_time,$entry_by);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

function update($conn,$logo_70,$name, $email, $phone, $dob, $state, $district, $city, $block,$address,$password,$status,$entry_time,$entry_by,$id){ 
    $sql="update `employee_data` set `photo`=?,`name`=?,`email`=?,`phone`=?,`dob`=?,`state`=?,`district`=?,`city`=?,`block`=?,`address`=?,`password`=?,`status`=?,`entry_time`=?,`entry_by`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssssssssssss",$logo_70,$name, $email, $phone, $dob, $state, $district, $city, $block,$address,$password,$status,$entry_time,$entry_by,$id);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

if(isset($_POST['name'])){
                $path="../../upload/photo";
                $logo_70= addImg($path, 'logo_70');
				$width=3; $table_name="employee_data";$prefix="EMP".date('Y');
		
		        $emp_code= getLastID($conn, $width, $table_name, $prefix);
                $name=$_POST['name'];
                $email=$_POST['email'];
                $phone=$_POST['phone'];
                $dob=$_POST['dob'];
                $state=$_POST['state'];
                $district=$_POST['district'];
                $city=$_POST['city'];
                $block=$_POST['block'];
                $address=$_POST['address'];
                $password=$_POST['password'];
                $status=$_POST['status'];
                $entry_time=date("YmdHis");
                $entry_by=$_SESSION['id_mart_admin'];
                
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
             $p= update($conn,$logo_70,$name, $email, $phone, $dob, $state, $district, $city, $block,$address,$password,$status,$entry_time,$entry_by,$id);
        }else{
            $p= save($conn, $emp_code, $logo_70,$name, $email, $phone, $dob, $state, $district, $city, $block,$address,$password,$status,$entry_time,$entry_by);
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



