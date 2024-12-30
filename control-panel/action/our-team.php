<?php
session_start();
include '../include/connection.php';
require_once '../common/Image-Uploads.php';
require_once '../common/test-input.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];


function save($conn,$team_id,$name,$media,$post,$details,$cby,$cdate,$bdate,$status){
    $sql="INSERT INTO `our_team`(`team_id`, `name`, `media`, `post`, `details`, `cby`, `cdate`, `rel_date`,`status`) VALUES(?,?,?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssssss",$team_id,$name,$media,$post,$details,$cby,$cdate,$bdate,$status);
    if($s->execute()){
        return true;
    } else {
		return FALSE;
    }
}


function update($conn,$name,$post,$details,$media,$cby,$cdate,$bdate,$id){
    $sql="update  `our_team` set `name`=?, `post`=?, `details`=?, `media`=?,`cby`=?,`cdate`=?,`rel_date`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("ssssssss",$name,$post,$details,$media,$cby,$cdate,$bdate,$id);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}
        
        $path="../../upload/team";
        
        $img=addImg($path, "file");
		
		$width=4; $table_name="our_team";$prefix="OT";
		
		$team_id= getLastID($conn, $width, $table_name, $prefix);
		
		
        $name= test_input($_POST['Name']);
                $post=test_input($_POST['post']);
                $details=test_input($_POST['content1']);
                $bdate=test_input($_POST['bdate']);
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
            
            $p= update($conn,$name,$post,$details,$img,$cby,$cdate,$bdate,$id);
        }else{
            $p= save($conn,$team_id,$name,$img,$post,$details,$cby,$cdate,$bdate,$status);
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


