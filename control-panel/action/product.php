<?php
session_start();
include '../include/connection.php';
require_once '../common/Image-Uploads.php';
require_once '../common/test-input.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];


function save($conn,$pro_id,$category,$name,$mrp,$price,$details,$media,$cby,$cdate,$meta_title,$meta_keywords,$meta_description,$status){
    $sql="INSERT INTO `product`(`pro_id`,`cat_id`, `name`, `mrp`, `price`, `details`,`media`, `cby`, `cdate`,`meta_title`,`meta_keywords`,`meta_description`, `status`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssssssssss",$pro_id,$category,$name,$mrp,$price,$details,$media,$cby,$cdate,$meta_title,$meta_keywords,$meta_description,$status);
    if($s->execute()){
        return true;
    } else {
		return FALSE;
    }
}


function update($conn,$category,$name,$mrp,$price,$details,$media,$cby,$cdate,$meta_title,$meta_keywords,$meta_description,$id){
    $sql="update  `product` set `cat_id`=?,`name`=?, `mrp`=?, `price`=?, `details`=?, `media`=?,`cby`=?,`cdate`=?,`meta_title`=?,`meta_keywords`=?,`meta_description`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssssssssss",$category,$name,$mrp,$price,$details,$media,$cby,$cdate,$meta_title,$meta_keywords,$meta_description,$id);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}
        
        $path="../../upload/product";
        
        $img=addImg($path, "file");
		
		$width=4; $table_name="product";$prefix="PR";
		
		$pro_id= getLastID($conn, $width, $table_name, $prefix);
		
		
        $name= test_input($_POST['Name']);
                $price=test_input($_POST['price']);
				$mrp=test_input($_POST['mrp']);
                $details=test_input($_POST['content1']);
                $cdate=date("Y-m-d H:i:s");
                $cby=$_SESSION['id_mart_admin'];
				$status='Active';
                $category = test_input($_POST['category']);
              
                $meta_title = $_POST['meta_title'];
                $meta_keywords = $_POST['meta_keywords'];
                $meta_description = $_POST['meta_description'];
                

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
            
            $p= update($conn,$category,$name,$mrp,$price,$details,$img,$cby,$cdate,$meta_title,$meta_keywords,$meta_description,$id);
        }else{
            $p= save($conn,$pro_id,$category,$name,$mrp,$price,$details,$img,$cby,$cdate,$meta_title,$meta_keywords,$meta_description,$status);
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


