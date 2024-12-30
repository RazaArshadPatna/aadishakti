 <?php

 $sql="SELECT `avtar` FROM `admin_member` WHERE `admin_id`=?";

    $s=$conn->prepare($sql);

    $s->bind_param("s", $_SESSION['id_mart_admin']);

	$s->bind_result($usermedia);

	if($s->execute()){

       $s->fetch();

		$s->close();

		

    }

$sql="SELECT name,logo,fav_icon FROM `website_data`";
$s=$conn->prepare($sql);
$s->bind_result($webname,$logo,$fav_icon);
$s->execute();
$s->fetch();
$s->close();


	?>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="../upload/fav/<?php echo $fav_icon;?>" type="image/x-icon">
 <!-- Application vendor css url -->
  <link rel="stylesheet" href="./assets/cssbundle/dataTables.min.css">
  <link rel="stylesheet" href="./assets/cssbundle/daterangepicker.min.css">
  <!-- project css file  -->
  <link rel="stylesheet" href="./assets/css/theme.css">
  <!-- Jquery Core Js -->
  <script src="./assets/js/plugins.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/brands.min.css" integrity="sha512-DJLNx+VLY4aEiEQFjiawXaiceujj5GA7lIY8CHCIGQCBPfsEG0nGz1edb4Jvw1LR7q031zS5PpPqFuPA8ihlRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />