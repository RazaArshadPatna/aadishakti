<?php
  session_start();
  include 'control-panel/include/connection.php'; 

  if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $message=$_POST['message'];
    $cdate=date("Y-m-d H:i:s");

    $sql="INSERT INTO `inquiry`(`Name`,`mobile`, `Email`, `Details`,`entry_time`) VALUES(?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssss",$name,$phone,$email,$message,$cdate);
    if($s->execute()){
        $_SESSION['inquiry']="successfull";
    }
    $s->close();
  }
?>
  <script>window.location.href="contact.php";</script>