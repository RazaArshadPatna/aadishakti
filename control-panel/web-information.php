<?php session_start();
include './include/connection.php';
include './include/isLogin.php';
require_once './common/Image-Uploads.php';

$form_title="Website Information";

$module="Master Data";
$auto_Fill=false;
$title="Website Information";
$sql="SELECT id,`domain`, `facebook`, `twitter`, `youtube`, `linkdin`, `whatsapp`, `instagram`, `address_1`, `address_2`, `email_1`, `mobile_1`, `mobile_2`,email_2,`name`,`logo`,`fav_icon`,`loginban`,`meta_title`,`meta_keywords`,`meta_description` FROM `website_data`";
$s=$conn->prepare($sql);
$s->bind_result($id,$domain,$facebook,$twitter,$youtube,$linkdin,$whatsapp,$instagram,$address_1,$address_2,$email_1,$mobile_1,$mobile_2,$email_2,$webname,$logo,$fav_icon,$loginban,$meta_title,$meta_keywords,$meta_description);
$s->execute();
$s->fetch();
$s->close();


function update($conn,$domain,$facebook,$twitter,$youtube,$linkdin,$whatsapp,$address_1,$address_2,$email_1,$mobile_1,$mobile_2,$email_2,$instagram,$name,$media,$fav_icon,$loginban,$meta_title,$meta_keywords,$meta_description,$id){
$sql="update website_data set `domain`=?, `facebook`=?, `twitter`=?, `youtube`=?, `linkdin`=?, `whatsapp`=?,`address_1`=?, `address_2`=?, `email_1`=?, `mobile_1`=?, `mobile_2`=?, `email_2`=?, `instagram`=?, `name`=?, `logo`=?, `fav_icon`=?, `loginban`=?,`meta_title`=?,`meta_keywords`=?,`meta_description`=?  WHERE `id`=?";    
$s=$conn->prepare($sql);
$s->bind_param("sssssssssssssssssssss",$domain,$facebook,$twitter,$youtube,$linkdin,$whatsapp,$address_1,$address_2,$email_1,$mobile_1,$mobile_2,$email_2,$instagram,$name,$media,$fav_icon,$loginban,$meta_title,$meta_keywords,$meta_description,$id);
if($s->execute()){
    return true;
}else{
    return false;
}



}
$p=false;
if(isset($_POST['PageLink'])){   
   
           $domain=$_POST['domain'];
           $facebook=$_POST['facebook'];
           $twitter=$_POST['twitter'];
           $youtube=$_POST['youtube'];
           $linkdin=$_POST['linkdin'];
		   $instagram=$_POST['instagram'];
           $whatsapp=$_POST['whatsapp'];
           $address_1=$_POST['mainAddress'];
           $address_2=$_POST['branchAddress'];
           $email_1=$_POST['email_1'];
           $mobile_1=$_POST['mobile1'];
           $mobile_2=$_POST['mobile2'];
           $email_2=$_POST['email_2'];
		   $name=$_POST['name'];
           $id=$_POST['PageLink'];
		   $path="../upload/logo";
		   $media= addImg($path, 'image');
		   $meta_title = $_POST['meta_title'];
           $meta_keywords = $_POST['meta_keywords'];
           $meta_description = $_POST['meta_description'];
		   
		   
		   $old_media=$_POST['old_media'];
		   
			if($media==""){
				$media=$old_media;
			}else{
				if(!($old_media=="")){
				  $img_path_med=$path."/$old_media";
				  if (file_exists("$img_path_med")){
				  unlink($img_path_med);
				  }
				}
			}
			
			
			$path1="../upload/fav";
		   $fav_icon= addImg($path1, 'imagefav');
		   
		  
		   
		   $old_mediafav=$_POST['old_mediafav'];
		   
			if($fav_icon==""){
				$fav_icon=$old_mediafav;
			}else{
				if(!($old_mediafav=="")){
				  $img_path_medfav=$path1."/$old_mediafav";
				  if (file_exists("$img_path_medfav")){
				  unlink($img_path_medfav);
				  }
				}
			}
			
			
			$path2="../upload/loginban";
		   $loginban= addImg($path2, 'imagelogin');
		  
		   
		   $old_medialoginban=$_POST['old_medialoginban'];
		   
			if($loginban==""){
				$loginban=$old_medialoginban;
			}else{
				if(!($old_media=="")){
				  $img_path_medloginban=$path."/$old_medialoginban";
				  if (file_exists("$img_path_medloginban")){
				  unlink($img_path_medloginban);
				  }
				}
			}
		   
		   
		   
           $p=update($conn,$domain,$facebook,$twitter,$youtube,$linkdin,$whatsapp,$address_1,$address_2,$email_1,$mobile_1,$mobile_2, $email_2,$instagram,$name,$media,$fav_icon,$loginban,$meta_title,$meta_keywords,$meta_description, $id);
           if($p){
		   
		   	$logo=$media;
               $_SESSION['msg']="success";
           }
           
           
    
}


?>
<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $form_title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
    <?php include './include/head.php'; ?>
    <style type="text/css">
    img {
        display: block;
        /*max-width: 100%;*/
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }
    </style>

</head>

<body class="layout-1" data-luno="theme-blue">
    <?php include './include/left-side.php'; ?>

    <div class="wrapper">
        <?php include './include/header.php'; ?>
        <!-- start: page toolbar -->
        <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
            <div class="container">
                <div class="row g-3 mb-3 align-items-center">
                    <div class="col">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a class="text-secondary" href="./index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $form_title; ?></li>
                        </ol>
                    </div>
                    <div class="col text-md-end">

                    </div>
                </div>
            </div>
        </div>
        <!-- start: page body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container">
                <div class="row g-3 clearfix row-deck">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header py-3 bg-transparent border-bottom-0">
                                <h6 class="card-title mb-0"><?php echo $form_title; ?></h6>
                            </div>
                            <form id="myForm" role="form" action="" method="post" enctype="multipart/form-data">
                                <div class="card-body">

                                    <?php if(!empty($_SESSION['msg'])){ ?>
                                    <div role="alert" class="alert alert-success text-center">
                                        <?php echo $_SESSION['msg']; ?></div>
                                    <?php unset($_SESSION['msg']); } ?>
                                    <?php if(!empty($_SESSION['error'])){ ?>
                                    <div role="alert" class="alert alert-danger  text-center">
                                        <?php echo $_SESSION['error']; ?></div>
                                    <?php unset($_SESSION['error']); } ?>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Id<span class="label label-danger"
                                                    id="pf_error"></span></label>

                                            <input type="text" required="" readonly="" value="1" name="PageLink"
                                                class="form-control" />
                                        </div>

                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Name<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input class="form-control" type="text" value="<?php echo $webname; ?>"
                                                name="name">
                                        </div>


                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Domain<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input class="form-control" type="text" value="<?php echo $domain; ?>"
                                                name="domain">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1">Logo<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input class="form-control" type="file" name="image" id="logo">
                                            

                                            <input type="hidden" value="<?php echo $logo; ?>" name="old_media" />
                                            <?php if(!empty($logo)){ ?>
                                            <img src="../upload/logo/<?php echo $logo;?>" width="100px" />
                                            <?php } ?>

                                        </div>

                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1">Favicon Icon<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input class="form-control" type="file" name="imagefav" id="imagefav">

                                            

                                            <input type="hidden" value="<?php echo $fav_icon; ?>" name="old_mediafav" />
                                            <?php if(!empty($fav_icon)){ ?>
                                            <img src="../upload/fav/<?php echo $fav_icon;?>" width="100px" />
                                            <?php } ?>

                                        </div>

                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1">Login Banner<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input class="form-control" type="file" name="imagelogin" id="imagelogin">

                                            

                                            <input type="hidden" value="<?php echo $loginban; ?>"
                                                name="old_medialoginban" />
                                            <?php if(!empty($loginban)){ ?>
                                            <img src="../upload/loginban/<?php echo $loginban;?>" width="100px" />
                                            <?php } ?>

                                        </div>


                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Facebook<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" class="form-control" value="<?php echo $facebook; ?>"
                                                name="facebook" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Twitter<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" class="form-control" value="<?php echo $twitter; ?>"
                                                name="twitter" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">YouTube<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" class="form-control" value="<?php echo $youtube; ?>"
                                                name="youtube" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Instagram<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" class="form-control" value="<?php echo $instagram; ?>"
                                                name="instagram" />
                                        </div>

                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Linkdin<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" class="form-control" value="<?php echo $linkdin; ?>"
                                                name="linkdin" />
                                        </div>


                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Main Address<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <textarea name="mainAddress"
                                                class="form-control"><?php echo $address_1;  ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Office Hours<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <textarea name="branchAddress"
                                                class="form-control"><?php echo $address_2;  ?></textarea>
                                        </div>




                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Mobile1<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" class="form-control" value="<?php echo $mobile_1; ?>"
                                                name="mobile1" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Mobile2<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" class="form-control" value="<?php echo $mobile_2; ?>"
                                                name="mobile2" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">WhatsApp<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" class="form-control" value="<?php echo $whatsapp; ?>"
                                                name="whatsapp" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Email 1 :<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" class="form-control" value="<?php echo $email_1; ?>"
                                                name="email_1" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Email 2:<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" class="form-control" value="<?php echo $email_2; ?>"
                                                name="email_2" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Meta Title<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <textarea class="form-control"
                                                name="meta_title" /><?php echo $meta_title; ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Meta Keywords<span
                                                    class="label label-danger" id="pf_error"></span></label>
                                            <textarea class="form-control"
                                                name="meta_keywords" /><?php echo $meta_keywords; ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Meta Description<span
                                                    class="label label-danger" id="pf_error"></span></label>
                                            <textarea class="form-control"
                                                name="meta_description" /><?php echo $meta_description; ?></textarea>
                                        </div>











                                    </div>




                                </div>

                                <div class="card-footer">

                                    <button type="submit" class="btn lift btn-lg btn-primary">Submit</button>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--For image Cropper POP-->

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Crop image</h5>
                        <button type="button" class="close close_button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <!--  default image where we will set the src via jquery-->
                                    <img id="image">
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close_button"
                            data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" style="display:none;" id="crop_logo">Crop</button>
                        <button type="button" class="btn btn-primary" style="display:none;" id="crop_fav">Crop</button>
                        <button type="button" class="btn btn-primary" style="display:none;"
                            id="crop_login">Crop</button>
                    </div>
                </div>
            </div>
        </div>



        <!--End of Image Cropper pop-->
        <?php include './include/footer.php'; ?>
        <script>
        $('.menu-web').addClass("active");
        $('#menu-web').addClass("show");
        $('.menu-web-information').addClass("active");
        </script>
        
        