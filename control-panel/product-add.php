<?php session_start();
include './include/connection.php';
require_once './include/isLogin.php';
/* page info */
$form_title="Services";
$module="Web Pages";
$auto_Fill=false;
$meta_description=$meta_keywords=$meta_title="";
if(isset($_GET['id'])){
    $auto_Fill=true;
    $id=$_GET['id'];
	$edit_id=$_GET['id'];
    $sql="SELECT `id`,`cat_id`,`name`, `mrp`, `price`, `details`,`media`,`meta_title`,`meta_keywords`,`meta_description` FROM `product` where id=?";
	 $s=$conn->prepare($sql);
	 $s->bind_param("s",$id);
	 $s->bind_result($id,$cat_id,$name,$mrp,$price,$details,$image,$meta_title,$meta_keywords,$meta_description);
	 if($s->execute()){
		$s->fetch();
		$s->close();
}}

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
                        <a class="btn btn-primary" href="product-dis.php"><i
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
                            <form id="myForm" role="form" action="action/product.php" method="post"
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
                                            <label for="exampleInputEmail1">Select Category <span
                                                    class="label label-danger" id="pf_error"></span></label>
                                            <select class="form-control" name="category">
                                                <option value="">--Select Category--</option>
                                                <?php  
                                            $sql = "SELECT `heading1`,`cat_id` FROM `master_category` WHERE `status`='Publish'";
                                            $st=$conn->prepare($sql);
                                            $st->bind_result($sname,$cid);
                                            $st->execute();
                                            $st->store_result();
                                            while($st->fetch()){
                                              ?>

                                                <option <?php if(!empty($cat_id) && $cat_id==$cid){ echo 'selected';}?> value="<?php echo $cid;?>"><?php echo $sname;?></option>
                                                <?php  }?>
                                            </select>

                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Upload Image<span class="label label-danger"
                                                    id="pf_error">(Choose 770 X 527 size for image)</span></label>
                                            <input type="file" class="form-control" name="file" id="file_chack">
                                          
                                        </div>

                                        <?php if($auto_Fill){ ?>
                                        <div class="col-md-12">
                                            <img class="img-table" src="../upload/product/<?php echo $image; ?>"
                                                width="50" height="50" />
                                            <input type="hidden" name="old_img" value="<?php echo $image; ?>" />
                                            <input type="hidden" name="uid" value="<?php echo $id; ?>" />
                                        </div>
                                        <?php } ?>

                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Name <span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <?php if($auto_Fill){ ?>
                                            <input type="hidden" value="<?php echo $edit_id; ?>"
                                                class="form-control col-md-4 " name="Edit_id" id="Edit_id">
                                            <?php } ?>
                                            <input type="text" required="" name="Name"
                                                value="<?php if(!empty($name)){echo $name;} ?>" id="Name"
                                                class="form-control" />

                                        </div>
                                        <div class="col-md-12" style="display:none;">
                                            <label for="exampleInputEmail1">MRP<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text"  name="mrp"
                                                value="<?php if(!empty($mrp)){echo $mrp;}?>" class="form-control" />

                                        </div>
                                        <div class="col-md-12" style="display:none;">
                                            <label for="exampleInputEmail1">Price<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text"  name="price"
                                                value="<?php if(!empty($price)){echo $price;}?>" class="form-control" />

                                        </div>


                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Content<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <textarea name="content1"
                                                class="form-control"><?php if(!empty($details)){ echo html_entity_decode($details);} ?></textarea>
                                        </div>


                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Meta Title<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <textarea class="form-control"
                                                name="meta_title"><?php echo $meta_title; ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Meta Keywords<span
                                                    class="label label-danger" id="pf_error"></span></label>
                                            <textarea class="form-control"
                                                name="meta_keywords"><?php echo $meta_keywords; ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Meta Description<span
                                                    class="label label-danger" id="pf_error"></span></label>
                                            <textarea class="form-control"
                                                name="meta_description"><?php echo $meta_description; ?></textarea>
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
        $('.menu-web').addClass("active");
        $('#menu-web').addClass("show");
        $('.menu-web-product').addClass("active");
        </script>
        <script src="./ckeditor/ckeditor.js" type="text/javascript"></script>
        <script>
        CKEDITOR.replace('content1');
        CKEDITOR.add;
        </script>
       