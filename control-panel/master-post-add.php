<?php session_start();
include './include/connection.php';
require_once './include/isLogin.php';
/* page info */
$form_title="Master Posts";
$module="Master";
$auto_Fill=false;
if(isset($_GET['id'])){
     $auto_Fill=true;    
     $id=$_GET['id'];
     $sql="SELECT `id`,`heading1`,`title`,`entry_time`,`entry_by`,`status`,`media` FROM `master_post` WHERE id=?";
     $s=$conn->prepare($sql);
     $s->bind_param("s",$id);
     $s->bind_result($edit_id,$heading1,$title,$entry_time,$entry_by,$status,$media1);
     if($s->execute()){
	 	
        // $s->store_result();
      $s->fetch();
	  $s->close();
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
        max-width: 100%;
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
                        <a class="btn btn-primary" href="master-post.php"><i
                                class="fa fa-long-arrow-left me-2"></i>View</a>
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
                            <form id="myForm" role="form" action="action/master-state.php" method="post"
                                enctype="multipart/form-data">
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

                                        <?php if($auto_Fill){ ?>
                                        <input type="hidden" value="<?php echo $edit_id; ?>"
                                            class="form-control col-md-4" name="Edit_id" id="Edit_id">
                                        <?php } ?>
                                        <div class="col-md-12" style="display:none;">
                                            <label for="exampleInputEmail1">Upload Icon<span class="label label-danger" id="pf_error">(Upload 200X200 Image Size)</span></label>
                                            <input type="file" class="form-control" name="media" id="media">
                                            </div>
                                            
                                            <?php if($auto_Fill){ ?>
                                            <div class="col-md-12" style="display:none;">
                                                <img height="70" width="70" src="../upload/category/<?php echo $media1; ?>" />
                                            </div>
                                            
                                            <input type="hidden" class="form-control" value="<?php echo $media1; ?>" name="old_media" id="old_media"  />
                                            
                                            <?php } ?>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Name<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" name="head1" value="<?php if(!empty($heading1)){ echo $heading1;} ?>"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-6" style="display:none;">
                                            <label for="exampleInputEmail1">Title<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" name="title" value="<?php if(!empty($title)){ echo $title;} ?>"
                                                class="form-control" />
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Status<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <select class="form-control" name="status" id="status">
                                                <option <?php if(!empty($status) && $status=='Publish'){ echo 'selected';}?>>Publish</option>
                                                <option <?php if(!empty($status) && $status=='Hide'){ echo 'selected';}?>>Hide</option>
                                            </select>
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
        

       


        <!--End of Image Cropper pop-->
        <?php include './include/footer.php'; ?>
        <script>
        $('.menu-master').addClass("active");
        $('#menu-master').addClass("show");
        $('.menu-web-master-post').addClass("active");
        </script>
        
       