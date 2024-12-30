<?php
session_start();
include '../include/connection.php';
require_once '../common/Image-Uploads.php';
require_once '../common/test-input.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];


function save($conn,$loan_id,$name,$bdate,$details,$media,$cby,$cdate,$status,$meta_title,$meta_keywords,$meta_description,$course_timing,$course_duration,$class_duration,$class_location,$course_feature){
    $sql="INSERT INTO `offline_course`(`loan_id`, `name`, `bdate`, `details`,`media`, `cby`, `cdate`, `status`,`meta_title`,`meta_keywords`,`meta_description`,`course_timing`,`course_duration`,`class_duration`,`class_location`,`course_feature`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssssssssssssss",$loan_id,$name,$bdate,$details,$media,$cby,$cdate,$status,$meta_title,$meta_keywords,$meta_description,$course_timing,$course_duration,$class_duration,$class_location,$course_feature);
    if($s->execute()){
        return true;
    } else {
		return FALSE;
    }
}


function update($conn,$name,$bdate,$details,$media,$status,$meta_title,$meta_keywords,$meta_description,$course_timing,$course_duration,$class_duration,$class_location,$course_feature,$id){
    
    $sql="update  `offline_course` set `name`=?, `bdate`=?, `details`=?, `media`=?,`status`=?,`meta_title`=?,`meta_keywords`=?,`meta_description`=?,`course_timing`=?,`course_duration`=?,`class_duration`=?,`class_location`=?,`course_feature`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssssssssssss",$name,$bdate,$details,$media,$status,$meta_title,$meta_keywords,$meta_description,$course_timing,$course_duration,$class_duration,$class_location,$course_feature,$id);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}
        
        $path="../../upload/loan";
        //$goto=$_SERVER['HTTP_REFERER'];
        //$img=addImg($path, "file");
		
		$width=4; $table_name="offline_course";$prefix="OFC";
		
		$loan_id= getLastID($conn, $width, $table_name, $prefix);
		
		
		$img=$_POST['image_name'];
		
        $name= test_input($_POST['Name']);
                $bdate=test_input($_POST['bdate']);
                $details=test_input($_POST['content1']);
                $cdate=date("Y-m-d H:i:s");
                $cby=$_SESSION['id_mart_admin'];
				$status=test_input($_POST['status']);
                $meta_title=$_POST['meta_title'];
                $meta_description=$_POST['meta_description'];
                $meta_keywords=$_POST['meta_keywords'];
                $course_timing =$_POST['course_timing'];
                $course_duration =$_POST['course_duration'];
                $course_feature =$_POST['course_feature'];
                $class_duration =$_POST['class_duration'];
                $class_location =$_POST['class_location'];


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
//echo "<br>".$img;exit;
            $p= update($conn,$name,$bdate,$details,$img,$status,$meta_title,$meta_keywords,$meta_description,$course_timing,$course_duration,$class_duration,$class_location,$course_feature,$id);
        }else{
            $p= save($conn,$loan_id,$name,$bdate,$details,$img,$cby,$cdate,$status,$meta_title,$meta_keywords,$meta_description,$course_timing,$course_duration,$class_duration,$class_location,$course_feature);
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


