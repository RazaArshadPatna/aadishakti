<?php session_start();
include './include/connection.php';
require_once './include/isLogin.php';
/* page info */
$form_title="Gallery";
$module="Web Pages";
$auto_Fill=false;
$meta_title=$meta_description=$meta_keywords=$cid=$image=$status="";
if(isset($_GET['id'])){
    $auto_Fill=true;    
    $id=$_GET['id'];
    $sql="SELECT `id`, `cid`,`heading`,`url`, `image`, `cdate`, `cby`,`status` FROM `manage_gallery` where id=?";
	 $s=$conn->prepare($sql);
	 $s->bind_param("s",$id);
	 $s->bind_result($edit_id,$cid,$heading,$url,$image,$entry_time,$entry_by,$status);
	 if($s->execute()){
		 $s->fetch();
		 $s->close();
	 }
    
}

/* page info end */
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
                        <a class="btn btn-primary" href="gallery-dis.php"><i
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
                            <form id="myForm" role="form" action="action/gallery.php" method="post"
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


                                        <div class="col-md-12" style="display:none;">
                                            <label for="exampleInputEmail1">Category<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <?php if($auto_Fill){ ?>
                                            <input type="hidden" value="<?php echo $edit_id; ?>"
                                                class="form-control col-md-4 " name="Edit_id" id="Edit_id">
                                            <?php } ?>
                                            <select class="form-control" name="cid" id="cid">
                                                <option <?php if(!empty($cid)&& $cid=='image'){ echo 'selected';}?>
                                                    value="image">Image</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12" style="display:none;">
                                            <label for="exampleInputEmail1">Heading<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" name="heading" class="form-control"
                                                value="<?php if(!empty($heading)){ echo $heading; }?>">
                                        </div>
                                        <div class="col-md-12" id="url" style="display:none">
                                            <label for="exampleInputEmail1">Video Url<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" name="url" class="form-control"
                                                value="<?php if(!empty($url)){ echo $url; }?>">
                                        </div>
                                        <div class="col-md-12">

                                            <label for="exampleInputEmail1">Upload Image<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="file" class="form-control" name="media" id="media">
                                            <!-- <span>(Choose 370 X 370 size for image)</span> -->

                                        </div>

                                        <?php if($auto_Fill){ ?>
                                        <div class="col-md-12">
                                            <img height="70" width="70" src="../upload/gallery/<?php echo $image; ?>" />
                                        </div>

                                        <input type="hidden" class="form-control" value="<?php echo $image; ?>"
                                            name="old_media" id="old_media" />
                                        <?php } ?>


                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Status<span class="label label-danger" id="pf_error"></span></label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="1" <?php if($status==1){ echo 'selected'; } ?> >Publish</option>
                                                <option value="0" <?php if($status==0){ echo 'selected'; } ?>>Hide</option>
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
        <?php include './include/footer.php'; ?>
        <script>
        $('.menu-web').addClass("active");
        $('#menu-web').addClass("show");
        $('.menu-web-gallery').addClass("active");
        </script>
        <script>
        $('#cid').on('change', function() {
            check();
        }).change();

        check();

        function check() {

            var cid = $('#cid').val();

            if (cid == 'video') {
                $('#url').show();
                $('#image').hide();
            } else if (cid == 'image') {
                $('#url').hide();
                $('#image').show();
            }

        }
        </script>