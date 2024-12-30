<?php

session_start();

include '../include/connection.php';

include '../include/isLogin.php';

require_once '../common/getLastId.php';

require_once 'Image-Uploads.php';

date_default_timezone_set('Asia/Kolkata');

function test_input($data) 

               {

                                       $data = trim($data);

                                       $data = stripslashes($data);

                                       $data = htmlspecialchars($data);

                                       return $data;

                }

function save_user($conn,$admin_id,$email,$color,$mobile,$last_login,$dob,$username,$roll,$serial,$shop_id,$media,$gender,$address,$status,$amount,$tran_id,$entry_by,$aadhaar){

   // echo $address;exit;

    $sql="INSERT INTO `admin_member`(`admin_id`, `email`, `color`, `mobile`, `last_login`, `dob`, `username`, `roll`, `serial`, `shop_id`,`avtar`,`gender`,`address`,`status`,`amount`,`transaction_id`,`entry_by`,`aadhaar`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $s=$conn->prepare($sql);

    $s->bind_param("ssssssssssssssssss",$admin_id,$email,$color,$mobile,$last_login,$dob,$username,$roll,$serial,$shop_id,$media,$gender,$address,$status,$amount,$tran_id,$entry_by,$aadhaar);

    if($s->execute()){

        return true;

    } else {

        return FALSE;

    }

}





function update_user($conn, $email, $color, $mobile, $last_login, $dob, $username, $roll, $serial, $shop_id,$media,$gender,$address,$status,$amount,$tran_id,$entry_by,$aadhaar, $id){

    $sql="update `admin_member` set  `email`=?, `color`=?, `mobile`=?, `last_login`=?, `dob`=?, `username`=?, `roll`=?, `serial`=?, `shop_id`=?, `avtar`=?,`gender`=?,`address`=?,`status`=?,`amount`=?,`transaction_id`=?,`entry_by`=?,`aadhaar`=? where id=?";

    $s=$conn->prepare($sql);

    $s->bind_param("ssssssssssssssssss",$email,$color,$mobile,$last_login,$dob,$username,$roll,$serial,$shop_id,$media,$gender,$address,$status,$amount,$tran_id,$entry_by,$aadhaar,$id);

    if($s->execute()){

        return true;

    } else {

        return FALSE;

    }

} 



function add_wallet_amount($conn,$wamount,$admin_id){

    $sql="update `admin_member` set  `wallet_amount`=? where admin_id=?";

    $s=$conn->prepare($sql);

    $s->bind_param("ss",$wamount,$admin_id);

    if($s->execute()){

        return true;

    } else {

        return FALSE;

    }

}

function MakeColor($pass)

{    $first="Zp%9";



    $mid=$pass;



    $last="#9%pZ";



    $color=$first.$mid.$last;



    return sha1($color);    



}





if(isset($_POST['Email'])){

            $goto=$_SERVER['HTTP_REFERER'];

            

            

            $width=4; $table_name="admin_member";$prefix="BK";

            $admin_id= getLastID($conn, $width, $table_name, $prefix);

            $email= test_input($_POST['Email']);

           

            $color=MakeColor($_POST['password']);

            $mobile= test_input($_POST['Mobile']);

            $last_login="";

            $dob= test_input($_POST['Dob']);

            $username= test_input($_POST['Name']);

            $roll=test_input($_POST['Role']);

            $serial="";

            $shop_id= 'WC0011';  

			$gender = $_POST['gender'];

            $address = $_POST['address'];

            if(isset($_POST['aadhaar'])){

            $aadhaar =$_POST['aadhaar'];

            }else{

              $aadhaar ='';   

                

            }

            $status = $_POST['status'];

            if(isset($_POST['reg_amount'])){

            $amount = $_POST['reg_amount'];

            }else{

                $amount = 0;

            }

            if(isset($_POST['tran_id'])){

            $tran_id = $_POST['tran_id'];

            }else {

                $tran_id=0000;

            }

            $entry_by = $_SESSION['id_mart_admin'];

			$path="../../upload/admin";

			$media= addImg($path, 'photo');

			//$media=$_POST['image_name'];

			

			          

            if(isset($_POST['edit_id'])){

                $id=$_POST['edit_id'];

               if($_POST['change_pwd']=="No"){

                   $color=$_POST['color'];

               }

			   

			   $old_photo=$_POST['old_photo'];

				if($media==""){

					$media=$old_photo;

				}else{

					  $img_path_photo=$path."/".$old_photo;

					  if (file_exists($img_path_photo)){

					  unlink($img_path_photo);

					  }

				} 

						

                $p= update_user($conn, $email, $color, $mobile, $last_login, $dob, $username, $roll, $serial, $shop_id,$media,$gender,$address,$status,$amount,$tran_id,$entry_by,$aadhaar, $id);

                

            }else{

                $p= save_user($conn, $admin_id, $email, $color, $mobile, $last_login, $dob, $username, $roll, $serial, $shop_id,$media,$gender,$address,$status,$amount,$tran_id,$entry_by,$aadhaar);

                if($p){

                    $sqlw = "SELECT `name` FROM `master_wallet` WHERE 1";

                    $st = $conn->prepare($sqlw);

                    $st->bind_result($wamount);

                    $st->execute();

                    $st->fetch();

                    $st->close();

                   $q = add_wallet_amount($conn,$wamount,$admin_id);

                }

            }

            

            require_once '../common/go-back.php';
            ?><script>window.location.href="<?php echo $goto;?>";</script><?php

}
?>