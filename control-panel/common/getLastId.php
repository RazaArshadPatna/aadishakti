<?php
            function getLastID($conn,$width,$table_name,$prefix){
               $sql="SELECT id FROM $table_name ORDER BY id DESC LIMIT 1";
    $stmt2=$conn->prepare($sql);
    $stmt2->execute() or trigger_error($stmt2->error, E_USER_ERROR);
    $stmt2->bind_result($id);
    if($stmt2){
     $stmt2->fetch(); 
	 $stmt2->close();
}
//$width =4;
if(empty($id)){
	$id=0;
}
$padded=str_pad((string)$id+1, $width, "0", STR_PAD_LEFT);



return $prefix.$padded;
}

function getCode($conn){
   $sqlc = "SELECT `scode`,`city` FROM `website_data` WHERE 1";
   $p = $conn->prepare($sqlc);
   $p->bind_result($scode,$city);
   $p->execute();
   $p->fetch();
   $p->close();
   $city = substr($city,0,3);
   return $scode.$city;
}

function getLastadmid($conn, $width, $table_name, $prefix1){
   $sql1="SELECT id FROM $table_name where `adm_id`!='' ORDER BY id DESC LIMIT 1";
   $stmt=$conn->prepare($sql1);
   $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
   $stmt->bind_result($id);
   if($stmt){
    $stmt->fetch(); 
   $stmt->close();
}
//$width =4;
if(empty($id)){
  $id=0;
}
$padded1=str_pad((string)$id+1, $width, "0", STR_PAD_LEFT);

return $prefix1.$padded1;
}

?>
