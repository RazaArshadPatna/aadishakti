<?php
$folderPath="../../upload/team/";
$image_parts = explode(";base64,", $_POST['image']);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$file_name=uniqid() . '.png';
$file = $folderPath . $file_name;
file_put_contents($file, $image_base64);
echo json_encode($file_name);
?>