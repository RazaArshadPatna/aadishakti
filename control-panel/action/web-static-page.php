<?php
session_start();
include '../include/connection.php';
require_once '../common/test-input.php';
require_once '../common/Image-Uploads.php';
$goto=$_SERVER['HTTP_REFERER'];

function save_static($conn,$page_menu,$content,$meta_title,$meta_description,$meta_keywords,$entry_time,$entry_by,$media,$status){
    $sql="INSERT INTO `static_page`(`page_menu`, `content`,`meta_title`, `meta_description`, `meta_keywords`, `entry_time`, `entry_by`, `media`, `status`) VALUES (?,?,?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssssss",$page_menu,$content,$meta_title,$meta_description,$meta_keywords,$entry_time,$entry_by,$media,$status);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}


function update_static($conn, $page_menu, $content,$meta_title,$meta_description,$meta_keywords,$entry_time, $entry_by,$media,$status,$id){ 
    $sql="update `static_page` set `page_menu`=?, `content`=?,`meta_title`=?, `meta_description`=?, `meta_keywords`=?, `entry_time`=?, `entry_by`=?, `media`=?, `status`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssssssss",$page_menu, $content,$meta_title,$meta_description,$meta_keywords,$entry_time, $entry_by,$media,$status,$id);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}

if(isset($_POST['PageMenu']) and isset($_POST['content'])){
    
				$path="../../upload/static";
				$media= addImg($path, 'media');
				
				//$media=$_POST['image_name'];
				
                $page_menu= test_input($_POST['PageMenu']);
                $content=test_input($_POST['content']);
                $entry_time=date("YmdHis");
                $entry_by =$_SESSION['id_mart_admin'];
                
                $meta_title=$_POST['meta_title'];
                $meta_description=$_POST['meta_description'];
                $meta_keywords=$_POST['meta_keywords'];
				
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
			
			$p=update_static($conn, $page_menu, $content,$meta_title,$meta_description,$meta_keywords, $entry_time, $entry_by,$media,$status,$id);
        }else{
            $p=save_static($conn, $page_menu, $content,$meta_title,$meta_description,$meta_keywords,$entry_time, $entry_by,$media,$status);
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



