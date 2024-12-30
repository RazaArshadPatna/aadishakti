<?php
session_start();
include '../include/connection.php';
require_once '../common/Image-Uploads.php';
require_once '../common/test-input.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];


function update($conn, $farmer_grp_id, $grp_name, $consultant_name, $consultant_code, $product_details,$status,$id){ 
    $sql="update `farmer_group` set `farmer_grp_id`=?,`grp_name`=?,`consultant_name`=?,`consultant_code`=?,`product_details`=?,`status`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssss",$farmer_grp_id, $grp_name, $consultant_name, $consultant_code, $product_details,$status,$id);
    if($s->execute()){
        return true;
    }else{
        return FALSE;
    }
}



if(isset($_POST['Edit_id'])){
        $id = $_POST['Edit_id'];
        $grp_name=$_POST['grp_name'];
        $farmer_grp_id=$_POST['farmer_grp_id'];
        $consultant_name=$_POST['consultant_name'];
        $consultant_code=$_POST['consultant_code'];
        $product_details=$_POST['product_details'];
        $status = $_POST['status'];
       
            $p= update($conn, $farmer_grp_id, $grp_name, $consultant_name, $consultant_code, $product_details,$status,$id);
      
        
        if($p){
            $_SESSION['msg']="Group Updated!!";
            
            ?>
           <script>window.location.href="<?php echo $goto;?>";</script>
       <?php }else{
            $_SESSION['error']="error";
            ?>
          <script>window.location.href="<?php echo $goto;?>";</script>
       <?php } }



