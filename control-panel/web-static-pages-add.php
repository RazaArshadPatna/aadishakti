<?php session_start();
include './include/connection.php';
require_once './include/isLogin.php';
/* page info */
$form_title="Static Pages";
$module="Web Pages";
$auto_Fill=false;
$meta_title=$meta_description=$meta_keywords=$content=$media1=$status="";
if(isset($_GET['id'])){
    $auto_Fill=true;    
    $id=$_GET['id'];
    $sql="SELECT `id`, `page_menu`, `content`,`meta_title`, `meta_description`, `meta_keywords`, `entry_time`, `entry_by`, `media`, `status` FROM `static_page` where id=?";
	 $s=$conn->prepare($sql);
	 $s->bind_param("s",$id);
	 $s->bind_result($edit_id,$page_menu,$content,$meta_title,$meta_description,$meta_keywords,$entry_time,$entry_by,$media1,$status);
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
                        <a class="btn btn-primary" href="web-static-pages-dis.php"><i
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
                            <form id="myForm" role="form" action="action/web-static-page.php" method="post"
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

                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Upload Image<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="file" class="form-control" name="media" id="media">
                                            
                                        </div>

                                        <?php if($auto_Fill){ ?>
                                        <div class="col-md-12">
                                            <img height="70" width="70" src="../upload/static/<?php echo $media1; ?>" />
                                        </div>

                                        <input type="hidden" class="form-control" value="<?php echo $media1; ?>"
                                            name="old_media" id="old_media" />

                                        <?php } ?>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Page Menu<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <?php if($auto_Fill){ ?>
                                            <input type="hidden" value="<?php echo $edit_id; ?>"
                                                class="form-control col-md-4 " name="Edit_id" id="Edit_id">
                                            <?php } ?>
                                            <input type="text" required="" name="PageMenu" id="PageMenu"
                                                class="form-control"
                                                value="<?php if(!empty($page_menu)){ echo $page_menu; }?>" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Content <span class="label label-danger"
                                                    id="auto_gender_error"></span></label>
                                            <textarea name="content"><?php echo $content; ?></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Meta Title<span class="label label-danger"
                                                    id="pf_error"></span></label>

                                            <input type="text" name="meta_title" class="form-control"
                                                value="<?php if(!empty($meta_title)){ echo $meta_title; }?>" />
                                        </div>

                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Meta Keyword<span class="label label-danger"
                                                    id="pf_error"></span></label>

                                            <input type="text" name="meta_keywords" class="form-control"
                                                value="<?php if(!empty($meta_keywords)){ echo $meta_keywords; }?>" />
                                        </div>

                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Meta Description<span
                                                    class="label label-danger" id="pf_error"></span></label>

                                            <textarea name="meta_description"
                                                class="form-control"><?php if(!empty($meta_description)){ echo $meta_description; }?></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Status </label>
                                            <select class="form-control" name="status">
                                                <option value="1"
                                                    <?php if(!empty($status) && $status==1){ echo 'selected';}?>>Show
                                                </option>
                                                <option value="2"
                                                    <?php if(!empty($status) && $status==2){ echo 'selected';}?>>Hide
                                                </option>
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
        <script src="./ckeditor/ckeditor.js" type="text/javascript"></script>
        <script>
        CKEDITOR.replace('content');
        CKEDITOR.add;
        </script>
        <script>
        $('.menu-web').addClass("active");
        $('#menu-web').addClass("show");
        $('.menu-web-static').addClass("active");
        </script>
      