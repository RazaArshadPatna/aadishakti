<?php
session_start();
include '../include/connection.php';
require_once '../common/Image-Uploads.php';
require_once '../common/test-input.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];


function save($conn,$why_id,$name,$details,$media,$cby,$cdate,$status){
    $sql="INSERT INTO `why`(`why_id`, `name`, `details`,`media`, `cby`, `cdate`, `status`) VALUES(?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssss",$why_id,$name,$details,$media,$cby,$cdate,$status);
    if($s->execute()){
        return true;
    } else {
		return FALSE;
    }
}


function update($conn,$name,$details,$media,$id){
    $sql="update  `why` set `name`=?, `details`=?, `media`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssss",$name,$details,$media,$id);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}
        
        $path="../../upload/why";
        //$goto=$_SERVER['HTTP_REFERER'];
        $img=addImg($path, "file");
		
		$width=4; $table_name="why";$prefix="WH";
		
		$why_id= getLastID($conn, $width, $table_name, $prefix);
		
		
		//$img=$_POST['image_name'];
		
        $name= test_input($_POST['Name']);
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
            
            $p= update($conn,$name,$details,$img,$id);
        }else{
            $p= save($conn,$why_id,$name,$details,$img,$cby,$cdate,$status);
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


