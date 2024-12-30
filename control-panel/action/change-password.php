<?php

session_start();

include '../include/connection.php';

include '../include/isLogin.php';



date_default_timezone_set('Asia/Kolkata');

function test_input($data) 

               {

                                       $data = trim($data);

                                       $data = stripslashes($data);

                                       $data = htmlspecialchars($data);

                                       return $data;

                }

                

function MakeColor($pass)



{    $first="Zp%9";



    $mid=$pass;



    $last="#9%pZ";



    $color=$first.$mid.$last;



    return sha1($color);    



}



               function getUserPassword($conn,$email){

                    $sql="SELECT `color` FROM `admin_member` WHERE `admin_id`=?";

                    $stmt1=$conn->prepare($sql);   

                    //$status="Active";

                    $stmt1->bind_param("s",$email);

                    $stmt1->execute(); 

                    $stmt1->bind_result($color);

                           if($stmt1){

                                    while($stmt1->fetch()){ 

                                    }

                            }

                    return $color;

             }

                    

 $email=$_SESSION['id_mart_admin'];

 $goto=$_SERVER['HTTP_REFERER'];

 $old_password=MakeColor($_POST["old_password"]);

 $new_password=MakeColor($_POST["new_password"]);

 $c_new_password=MakeColor($_POST["c_new_password"]);

 

 if($new_password==$c_new_password){

     $color= getUserPassword($conn, $email);

     

    

     if($color==$old_password){

         $sql="UPDATE admin_member SET color=? WHERE admin_id=?";

                    $stmt1=$conn->prepare($sql);   

                    

                    $stmt1->bind_param("ss",$new_password,$email);

                    $p=$stmt1->execute(); 

                    

                    if($p){

                        $_SESSION['msg']="Password Changed";

                       // echo 'successs';

                       header("Location:$goto");

                    }

                    else{

                        //echo 'error';

                         $_SESSION['error']="Sorry ! something went wrong.";

                         header("Location:$goto");

                    }

     }

     else{

         

        //echo 'password wrong';

        $_SESSION['error']="Password wrong";

        header("Location:$goto");

     }

     

 }

 else{

     $_SESSION['error']="Password do not matched";

        header("Location:$goto");

     //echo 'password not matched';

 }
?>