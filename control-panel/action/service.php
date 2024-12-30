<?php
session_start();
include '../include/connection.php';
require_once '../common/Image-Uploads.php';
require_once '../common/test-input.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];


function save($conn,$ser_id,$name,$mrp,$price,$details,$media,$cby,$cdate,$status){
    $sql="INSERT INTO `service`(`ser_id`, `name`, `mrp`, `price`, `details`,`media`, `cby`, `cdate`, `status`) VALUES(?,?,?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssssss",$ser_id,$name,$mrp,$price,$details,$media,$cby,$cdate,$status);
    if($s->execute()){
        return true;
    } else {
		return FALSE;
    }
}


function update($conn,$name,$mrp,$price,$details,$media,$id){
    $sql="update  `service` set `name`=?, `mrp`=?, `price`=?, `details`=?, `media`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssss",$name,$mrp,$price,$details,$media,$id);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}
        
        $path="../../upload/service";
        //$goto=$_SERVER['HTTP_REFERER'];
        //$img=addImg($path, "file");
		
		$width=4; $table_name="service";$prefix="SE";
		
		$ser_id= getLastID($conn, $width, $table_name, $prefix);
		
		
		$img=$_POST['image_name'];
		
        $name= test_input($_POST['Name']);
                $price=test_input($_POST['price']);
				$mrp=test_input($_POST['mrp']);
                $details=test_input($_POST['content1']);
                $cdate=date("Y-m-d H:i:s");
                $cby=$_SESSION['id_mart_admin'];
				$status='Active';
                
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
            
            $p= update($conn,$name,$mrp,$price,$details,$img,$id);
        }else{
            $p= save($conn,$ser_id,$name,$mrp,$price,$details,$img,$cby,$cdate,$status);
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

