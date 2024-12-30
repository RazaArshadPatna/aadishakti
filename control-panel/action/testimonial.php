<?php
session_start();
include '../include/connection.php';
require_once '../common/Image-Uploads.php';
require_once '../common/test-input.php';
$goto=$_SERVER['HTTP_REFERER'];


function save_testimonial($conn,$name,$profession,$date_of_speak,$content,$img,$entry_time,$entry_by){
    $sql="INSERT INTO `testimonial`(`name`, `profession`, `date_of_speak`, `content`, `img`, `entry_time`, `entry_by`) VALUES(?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssss",$name,$profession,$date_of_speak,$content,$img,$entry_time,$entry_by);
    if($s->execute()){
        return true;
    } else {
		return FALSE;
    }
}


function update_testimonial($conn,$name,$profession,$date_of_speak,$content,$img,$entry_time,$entry_by,$id){
    $sql="update  `testimonial` set `name`=?, `profession`=?, `date_of_speak`=?, `content`=?, `img`=?, `entry_time`=?, `entry_by`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssssss",$name,$profession,$date_of_speak,$content,$img,$entry_time,$entry_by,$id);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}
        
        $path="../../upload/testimonial";
        
        $img=addImg($path, "file");
		
		
        $name= test_input($_POST['Name']);
                $profession=test_input($_POST['Profession']);
                $date_of_speak=test_input($_POST['DateofSpeak']);
                $content=test_input($_POST['content1']);
                $entry_time=date("YmdHis");
                $entry_by=$_SESSION['id_mart_admin'];
                
        if(isset($_POST['uid']) and isset($_POST['old_img'])){
            $id=$_POST['uid'];
            $old_img=$_POST['old_img'];
            if($img==""){
             $img=$old_img;
            }else{
                $img_path=$path."/$old_img";
                if (!file_exists("$img_path")) {
                unlink($img_path);
                }
            }
            
            $p= update_testimonial($conn, $name, $profession, $date_of_speak, $content, $img, $entry_time, $entry_by, $id);
        }else{
            $p= save_testimonial($conn, $name, $profession, $date_of_speak, $content, $img, $entry_time, $entry_by);
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

