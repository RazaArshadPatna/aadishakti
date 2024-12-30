<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
if(isset($_SESSION['ip_blocked'])){
    header("Location:login.php");
    exit();
}
include './include/connection.php';
include './common/getOS.php';
function MakeColor($pass)
{   $first="Zp%9";
    $mid=$pass;
    $last="#9%pZ";
    $color=$first.$mid.$last;
    return sha1($color);    
}
function userLog($conn,$user_id,$date,$logout,$mac,$ip,$os,$browser,$logout_date,$key_word){
    $sql="INSERT INTO `login_log`(`user_id`, `date`,`logout`, `mac`, `ip`, `os`, `browser`, `logout_date`, `key_word`) VALUES (?,?,?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssssss",$user_id,$date,$logout,$mac,$ip,$os,$browser,$logout_date,$key_word);
    $s->execute();
	$s->close();
}

function add_value_to_session($mail,$conn){
$stmt1=$conn->prepare('SELECT email,admin_id,mobile,username,serial,avtar,roll,reg,shop_id FROM admin_member WHERE email=?');
$stmt1->bind_param("s",$mail);
$stmt1->bind_result($email,$admin_id,$mobile,$username,$serial,$avtar,$roll,$reg,$shop_id);
if($stmt1->execute())
{   
    $stmt1->fetch(); 
	$stmt1->close();  
}
   
    $_SESSION['id_mart_admin']=$admin_id;
    $_SESSION['email_admin']=$email;
    $_SESSION['name_admin']=$username;
    $_SESSION['mobile']=$mobile;
    $_SESSION['avtar']=$avtar;
    $_SESSION['key']=$serial;
    $_SESSION['roll']=$roll;
    $_SESSION['reg']=$reg;
    
}
function updateHashSt($conn,$key,$st){
   $sql="update login_page_visit set `status`=? WHERE `key_word`=?";
   $s=$conn->prepare($sql);
   $s->bind_param("ss",$st,$key); 
   $s->execute();
   $s->close();
   
}
function getHashSt($conn,$key){
   $sql="SELECT `status` FROM `login_page_visit` WHERE `key_word`=?";
   $s=$conn->prepare($sql);
   $s->bind_param("s",$key);
   $s->bind_result($status);
   if($s->execute()){
       $s->fetch();
	   $s->close();
   }
   return $status;
}
function make_form_color($word){
    $first="&&^^%9";
    $mid=$word;
    $last="%^^@@~XX";
    $color=$first.$mid.$last;
    return sha1($color);
}
function ChackInput($input){
    $chackedInput=htmlspecialchars($input);    
    return $chackedInput;    
}
function getUser($conn,$e){    
$stmt1=$conn->prepare("SELECT email FROM admin_member WHERE email=? AND status=1 AND (roll='Super Admin' OR roll='Admin')");
$stmt1->bind_param("s",$e);
$stmt1->bind_result($email);
if($stmt1->execute())
{   
    $stmt1->fetch(); 
	$stmt1->close();   
} 
return $email;
}
function getColor($conn,$c){    
$stmt1=$conn->prepare("SELECT color FROM admin_member WHERE email=? AND status=1 AND (roll='Super Admin' OR roll='Admin')");
$stmt1->bind_param("s",$c);
$stmt1->bind_result($color);
if($stmt1->execute())
{   
    $stmt1->fetch();
	$stmt1->close();   
} 
return $color;
}


if(isset($_POST['hash'])){
$form_post_hash=$_POST['hash'];
}else{
 
}
$key=$_SESSION['hash_key'];
$real_hash=make_form_color($key);
$hash_status=getHashSt($conn,$key);
if($real_hash===$form_post_hash and $hash_status==="New"){
    $st="Used";
    updateHashSt($conn,$key,$st);
    // "You will be tested for login";

$Form_name=ChackInput($_POST['user']);
$error=md5($Form_name);
$FormPassword=ChackInput($_POST['pass']);
$Formuser_color=MakeColor($FormPassword);
     //checking the validity of username
         $FetchUser=getUser($conn,$Form_name);
         $FetchCcolor=getColor($conn,$Form_name);
         if($Form_name===$FetchUser and $Formuser_color===$FetchCcolor){
                 add_value_to_session($FetchUser,$conn);
                 $user_id=$FetchUser;
                         $date=date("YmdHis");
                         $logout="-";
                         $mac="-";
                         $ip=$_SERVER['REMOTE_ADDR'];
                         $os=getOS();
                         $browser=getBrowser();
                         $logout_date="-";
                         $key_word=$key;                 
             userLog($conn,$user_id,$date,$logout,$mac,$ip,$os,$browser,$logout_date,$key_word);
             header("Location:index.php");
         }else{
             
             header("Location:login.php?error=");
         }
}else{  
    //echo "here";
    header("Location:error.php?ip=");
}




































