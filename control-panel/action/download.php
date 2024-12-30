<?php
session_start();
include '../include/connection.php';
require_once '../common/test-input.php';
require_once '../common/File-Uploads.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];

function save_download($conn,$tax_id,$heading1,$status,$entry_time,$entry_by,$media){
    $sql="INSERT INTO `download`(`tax_id`,`heading1`,`status`,`entry_time`,`entry_by`,`media`) VALUES (?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssss",$tax_id,$heading1,$status,$entry_time,$entry_by,$media);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

function update_download($conn,$heading1,$status,$entry_time,$entry_by,$media,$id){ 
    $sql="update `download` set `heading1`=?,`status`=?,`entry_time`=?,`entry_by`=?,`media`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssss",$heading1,$status,$entry_time,$entry_by,$media,$id);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

if(isset($_POST['head1'])){
                $width=4; $table_name="download";$prefix="DWN";
		
		        $tax_id= getLastID($conn, $width, $table_name, $prefix);
                $path="../../upload/doc";
                $media=addFile($path,'media');
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
             $p= update_download($conn,$heading1,$status,$entry_time,$entry_by,$media,$id);
        }else{
            $p= save_download($conn,$tax_id,$heading1,$status,$entry_time,$entry_by,$media);
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


