<?php
session_start();
include '../include/connection.php';
require_once '../common/test-input.php';
require_once '../common/Image-Uploads.php';
$goto=$_SERVER['HTTP_REFERER'];

function save_job($conn, $heading, $content,$title,$entry_time, $entry_by,$media,$status){
    $sql="INSERT INTO `manage_job`(`heading`, `content`,`title`, `entry_time`, `entry_by`, `media`, `status`) VALUES (?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssss",$heading, $content,$title,$entry_time, $entry_by,$media,$status);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}


function update_job($conn, $heading, $content,$title,$entry_time, $entry_by,$media,$status,$id){ 
    $sql="update `manage_job` set `heading`=?, `content`=?,`title`=?, `entry_time`=?, `entry_by`=?, `media`=?, `status`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssssss",$heading, $content,$title,$entry_time, $entry_by,$media,$status,$id);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}

if(isset($_POST['PageMenu']) and isset($_POST['content'])){
    
				$path="../../upload/job";
				$media= addImg($path, 'media');
				
				//$media=$_POST['image_name'];
				
                $heading= test_input($_POST['PageMenu']);
                $content=test_input($_POST['content']);
                $title = test_input($_POST['title']);
                $entry_time=date("YmdHis");
                $entry_by =$_SESSION['id_mart_admin'];
                $status=test_input($_POST['status']);
				
     
        if(isset($_POST['Edit_id'])){
            $id= test_input($_POST['Edit_id']);
			
			
			
			$old_media=$_POST['old_media'];
			if($media==""){
				$media=$old_media;
			}else{
				if(!($old_media=="")){
				  $img_path_med=$path."/$old_media";
				  if (file_exists("$img_path_med")){
				  unlink($img_path_med);
				  }
				}
			}
			
			$p=update_job($conn, $heading, $content,$title,$entry_time, $entry_by,$media,$status,$id);
        }else{
            $p=save_job($conn, $heading, $content,$title,$entry_time, $entry_by,$media,$status);
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



