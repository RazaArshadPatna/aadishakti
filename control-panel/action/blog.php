<?php
session_start();
include '../include/connection.php';
require_once '../common/Image-Uploads.php';
require_once '../common/test-input.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];


function save($conn,$blog_id,$name,$author,$bdate,$details,$media,$cby,$cdate,$meta_title,$meta_description,$meta_keywords,$status){

    $sql="INSERT INTO `blog`(`blog_id`, `name`,`author`, `bdate`, `details`,`media`, `cby`, `cdate`,`meta_title`, `meta_description`, `meta_keywords`, `status`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssssssssss",$blog_id,$name,$author,$bdate,$details,$media,$cby,$cdate,$meta_title,$meta_description,$meta_keywords,$status);
    if($s->execute()){
        return true;
    } else {
		return FALSE;
    }
}


function update($conn,$name,$author,$bdate,$details,$media,$meta_title,$meta_description,$meta_keywords,$status,$cby,$cdate,$id){

    $sql="update  `blog` set `name`=?,`author`=?, `bdate`=?, `details`=?, `media`=?,`meta_title`=?, `meta_description`=?, `meta_keywords`=?,`status`=?,`cby`=?,`cdate`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssssssssss",$name,$author,$bdate,$details,$media,$meta_title,$meta_description,$meta_keywords,$status,$cby,$cdate,$id);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}
        
        $path="../../upload/blog";
        
        $img=addImg($path, "file");
		
		$width=4; $table_name="blog";$prefix="BL";
		
		$blog_id= getLastID($conn, $width, $table_name, $prefix);
		
		
        
		
        $name= test_input($_POST['Name']);
        $author= test_input($_POST['author']);

                $bdate=test_input($_POST['bdate']);
                $details=test_input($_POST['content1']);
                $cdate=date("Y-m-d H:i:s");
                $cby=$_SESSION['id_mart_admin'];
				$status=$_POST['status'];
                $meta_title=$_POST['meta_title'];
                $meta_description=$_POST['meta_description'];
                $meta_keywords=$_POST['meta_keywords'];
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
            
            $p= update($conn,$name,$author,$bdate,$details,$img,$meta_title,$meta_description,$meta_keywords,$status,$cby,$cdate,$id);
        }else{
            $p= save($conn,$blog_id,$name,$author,$bdate,$details,$img,$cby,$cdate,$meta_title,$meta_description,$meta_keywords,$status);
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


