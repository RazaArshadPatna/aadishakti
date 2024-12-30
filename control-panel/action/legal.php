<?php
session_start();
include '../include/connection.php';
require_once '../common/test-input.php';
require_once '../common/Image-Uploads.php';
$goto=$_SERVER['HTTP_REFERER'];

function save_static($conn,$cid,$heading,$url,$image,$entry_time,$entry_by,$status){
    $sql="INSERT INTO `manage_legal`(`cid`,`heading`,`url`,`image`, `cdate`, `cby`, `status`) VALUES (?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssss",$cid,$heading,$url,$image,$entry_time,$entry_by,$status);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}


function update_static($conn, $cid,$heading,$url,$image,$id){ 
   
    $sql="update `manage_legal` set `cid`=?,`heading`=?,`url`=?,`image`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("sssss",$cid,$heading,$url,$image,$id);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}


    
				$path="../../upload/gallery";
				//$image= addImg($path, 'media');
				
				$image=$_POST['image_name'];
				
                $heading = test_input($_POST['heading']);
                $url = test_input($_POST['url']);
                $cid= test_input($_POST['cid']);
                $entry_time=date("Y-m-d H:i:s");
                $entry_by =$_SESSION['id_mart_admin'];
                $status=1;
     
        if(isset($_POST['Edit_id'])){
            $id= test_input($_POST['Edit_id']);
			
			
			$old_media=$_POST['old_media'];
			if($image==""){
				$image=$old_media;
			}else{
				if(!($old_media=="")){
				  $img_path_med=$path."/$old_media";
				  if (file_exists("$img_path_med")){
				  unlink($img_path_med);
				  }
				}
			}
			
			$p=update_static($conn, $cid,$heading,$url,$image,$id);
        }else{
            $p=save_static($conn,$cid,$heading,$url,$image,$entry_time,$entry_by,$status);
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



