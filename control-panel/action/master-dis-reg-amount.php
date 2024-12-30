<?php
session_start();
include '../include/connection.php';
require_once '../common/test-input.php';
require_once '../common/Image-Uploads.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];

function save($conn,$cat_id,$heading1,$amount,$status,$entry_time,$entry_by,$media){
    //echo $amount;exit;
    $sql="INSERT INTO `master_dis_reg_amount`(`cat_id`,`heading1`,`amount`,`status`,`entry_time`,`entry_by`,`media`) VALUES (?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssss",$cat_id,$heading1,$amount,$status,$entry_time,$entry_by,$media);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

function update($conn,$heading1,$amount,$status,$entry_time,$entry_by,$media,$id){ 
    //echo $amount;exit;
    $sql="update `master_dis_reg_amount` set `heading1`=?,`amount`=?,`status`=?,`entry_time`=?,`entry_by`=?,`media`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssss",$heading1,$amount,$status,$entry_time,$entry_by,$media,$id);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}

if(isset($_POST['head1'])){
                $width=4; $table_name="master_dis_reg_amount";$prefix="REG";
		
		        $cat_id= getLastID($conn, $width, $table_name, $prefix);
                $path="../../upload/category";
                $media="";
                $heading1=$_POST['head1'];
                $amount=$_POST['amount'];
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
             $p= update($conn,$heading1,$amount,$status,$entry_time,$entry_by,$media,$id);
        }else{
            $p= save($conn,$cat_id,$heading1,$amount,$status,$entry_time,$entry_by,$media);
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


