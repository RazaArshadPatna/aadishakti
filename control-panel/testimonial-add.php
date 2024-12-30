<?php session_start();
include './include/connection.php';
require_once './include/isLogin.php';
/* page info */
$form_title="Testimonial";
$module="Web Pages";
$auto_Fill=false;
if(isset($_GET['id'])){
    $auto_Fill=true;
    $id=$_GET['id'];
	$edit_id=$_GET['id'];
    $sql="SELECT `id`, `name`, `profession`, `date_of_speak`, `content`, `img`, `entry_time`, `entry_by` FROM `testimonial` where id=?";
	 $s=$conn->prepare($sql);
	 $s->bind_param("s",$id);
	 $s->bind_result($id,$name,$profession,$date_of_speak,$content,$image,$entry_time,$entry_by);
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
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"  />
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
            <a class="btn btn-primary" href="testimonial-dis.php"><i class="fa fa-long-arrow-left me-2"></i>View</a>
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
			  <form id="myForm" role="form" action="action/testimonial.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
			  
			  	<?php if(!empty($_SESSION['msg'])){ ?>
				<div role="alert" class="alert alert-success text-center"><?php echo $_SESSION['msg']; ?></div>
				<?php unset($_SESSION['msg']); } ?>
				<?php if(!empty($_SESSION['error'])){ ?>
				<div role="alert" class="alert alert-danger  text-center"><?php echo $_SESSION['error']; ?></div>
				<?php unset($_SESSION['error']); } ?>
                
				<div class="row">
                 
                <div class="col-md-12">
                  <label for="exampleInputEmail1">File upload input<span class="label label-danger" id="pf_error"></span></label>
                  <input type="file" class="form-control"   name="file" id="file_chack" >
				  
				   <input type="hidden" name="image_name" id="image_name" />
                </div>
                  
                  <?php if($auto_Fill){ ?>
                  <div class="col-md-12">
                      <img class="img-table" src="../upload/testimonial/<?php echo $image; ?>" width="50" height="50" />
                  <input type="hidden" name="old_img" value="<?php echo $image; ?>" />
                  <input type="hidden" name="uid" value="<?php echo $id; ?>" />
                  </div>
                  <?php } ?> 
                    
                <div class="col-md-12">
                  <label for="exampleInputEmail1">Name <span class="label label-danger" id="pf_error"></span></label>
				   <?php if($auto_Fill){ ?>
                    <input type="hidden" value="<?php echo $edit_id; ?>" class="form-control col-md-4 " name="Edit_id" id="Edit_id" >
                   <?php } ?>
                  <input type="text"  required="" name="Name" value="<?php if(!empty($name)){echo $name;} ?>" id="Name" class="form-control" />
            
                </div>
                  <div class="col-md-12">
                  <label for="exampleInputEmail1">Profession<span class="label label-danger" id="pf_error"></span></label>
                  <input type="text"  required="" name="Profession" value="<?php if(!empty($profession)){echo $profession;}?>"  class="form-control" />
            
                </div>
                <div class="col-md-12" style="display:none;">
                  <label for="exampleInputEmail1">Date of Speak <span class="label label-danger" id="pf_error"></span></label>
                  <input type="date" id="DateofSpeak"  name="DateofSpeak"  value="<?php if(!empty($date_of_speak)){ echo date('Y-m-d',strtotime($date_of_speak));}else{ echo date("Y-m-d");} ?>" class="form-control" />
                </div>
                
                <div class="col-md-12">
                  <label for="exampleInputEmail1">Content<span class="label label-danger" id="pf_error"></span></label>
                  <textarea name="content1" class="form-control"><?php if(!empty($content)){ echo html_entity_decode($content);} ?></textarea>
                </div>
                 
                
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 </div>
				 
				  
                  
                
              </div>
			  
			  <div class="card-footer">

                  <button type="submit"  class="btn lift btn-lg btn-primary">Submit</button>

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
                                    <img id="imagecan">
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close_button" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>
	
	
	
	<!--End of Image Cropper pop-->
    <?php include './include/footer.php'; ?>
	<script>
$('.menu-web').addClass("active");
$('#menu-web').addClass("show");
$('.menu-web-testimonial').addClass("active");
</script>
	<script src="./ckeditor/ckeditor.js" type="text/javascript"></script>
<script>   
    CKEDITOR.replace('content1');
    CKEDITOR.add;
  
</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script> -->
