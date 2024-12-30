<?php session_start();
include './include/connection.php';
require_once './include/isLogin.php';
/* page info */
$form_title="Master Offline Course";
$module="Master";
$auto_Fill=false;
$image=$heading1=$heading2=$heading3=$show_button=$url=$status=$entry_by=$entry_time=$city_id1="";
if(isset($_GET['id'])){
     $auto_Fill=true;    
     $id=$_GET['id'];
     $sql="SELECT `id`,`heading1`,`entry_time`,`entry_by`,`status`,`media` FROM `master_offline_course` WHERE id=?";
     $s=$conn->prepare($sql);
     $s->bind_param("s",$id);
     $s->bind_result($edit_id,$heading1,$entry_time,$entry_by,$status,$media1);
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
                        <a class="btn btn-primary" href="master-offline-course-dis.php"><i
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
                            <form id="myForm" role="form" action="action/master-offline.php" method="post"
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
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Upload Icon<span class="label label-danger" id="pf_error">(Upload 200X200 Image Size)</span></label>
                                            <input type="file" class="form-control" name="media" id="media"   >
                                            <input type="hidden" name="image_name" id="image_name" />
                                            </div>
                                            
                                            <?php if($auto_Fill){ ?>
                                            <div class="col-md-12">
                                                <img height="70" width="70" src="../upload/icon/<?php echo $media1; ?>" />
                                            </div>
                                            
                                            <input type="hidden" class="form-control" value="<?php echo $media1; ?>" name="old_media" id="old_media"  />
                                            
                                            <?php } ?>
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Heading<span class="label label-danger"
                                                    id="pf_error"></span></label>
                                            <input type="text" name="head1" id="head1" value="<?php echo $heading1; ?>"
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
                        <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>
        <!--For image Cropper POP-->

       


        <!--End of Image Cropper pop-->
        <?php include './include/footer.php'; ?>
        <script>
        $('.menu-master').addClass("active");
        $('#menu-master').addClass("show");
        $('.menu-web-master-loan').addClass("active");
        </script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
        <script>
        var bs_modal = $('#modal');
        var image = document.getElementById('image');
        var cropper, reader, file;


        $("#media").change(function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                bs_modal.modal('show');
            };


            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        bs_modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,

                preview: '.preview',

            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    //alert(base64data);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "./action/crop_image_icon.php",
                        data: {
                            image: base64data
                        },
                        beforeSend: function(msg) {
                            $("#crop").button("disable");
                            $("#crop").html('Uploading...');
                        },
                        success: function(data) {
                            bs_modal.modal('hide');

                            $('#image_name').val(data);

                            // alert("success upload image");
                        }
                    });
                };
            });
        });

        $('.close_button').click(function() {
            bs_modal.modal('hide');
        });
        </script>
       