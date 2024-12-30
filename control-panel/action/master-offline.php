<?php
session_start();
include '../include/connection.php';
require_once '../common/test-input.php';
require_once '../common/File-Uploads.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];

function save_course($conn,$loan_id,$heading1,$status,$entry_time,$entry_by,$media){
    $sql="INSERT INTO `master_offline_course`(`loan_id`,`heading1`,`status`,`entry_time`,`entry_by`,`media`) VALUES (?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssss",$loan_id,$heading1,$status,$entry_time,$entry_by,$media);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

function update_course($conn,$heading1,$status,$entry_time,$entry_by,$media,$id){ 
    $sql="update `master_offline_course` set `heading1`=?,`status`=?,`entry_time`=?,`entry_by`=?,`media`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssss",$heading1,$status,$entry_time,$entry_by,$media,$id);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

if(isset($_POST['head1'])){
                $width=4; $table_name="master_offline_course";$prefix="OFL";
		
		        $loan_id= getLastID($conn, $width, $table_name, $prefix);
                $path="../../upload/icon";
                $media=$_POST['image_name'];
                $heading1=$_POST['head1'];
                
                $entry_time=date("YmdHis");
                $entry_by=$_SESSION['id_mart_admin'];
                $status=$_POST['status'];
                
        if(isset($_POST['Edit_id'])){            
            $id= test_input($_POST['Edit_id']);
            $old_media=$_POST['old_media'];
        if($media==""){
            $media=$old_media;
        }else{
              $img_path_70=$path."/$old_media";
              if (file_exists("$img_path_70")){
              unlink($img_path_70);
              }
        }   
            //echo "<br>".$media;exit;
             $p= update_course($conn,$heading1,$status,$entry_time,$entry_by,$media,$id);
        }else{
            $p= save_course($conn,$loan_id,$heading1,$status,$entry_time,$entry_by,$media);
        }
        
        if($p){
            $_SESSION['msg']="success";
            ?>
           <script>window.location.href="<?php echo $goto;?>";</script>
       <?php }else{
            $_SESSION['error']="error";
            ?>
          <script>window.location.href="<?php echo $goto;?>";</script>
       <?php } 
}


