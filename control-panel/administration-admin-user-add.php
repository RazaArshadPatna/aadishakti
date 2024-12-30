<?php session_start();

include './include/connection.php';

require_once './include/isLogin.php';

/* page info */

$form_title="Add Admin User";

$module="Administration";

$autoFill=false;

$email=$color=$mobile=$dob=$username=$roll=$serial=$shop_id=$avtar=$reg=$aadhaar="";

if(isset($_GET['id'])){

    $autoFill=true;

    $id=$_GET['id'];

    $sql="SELECT `id`, `admin_id`, `email`, `color`, `mobile`, `last_login`, `dob`, `username`, `roll`, `serial`, `shop_id`, `avtar`, `reg`,`gender`,`address`,`status`,`aadhaar` FROM `admin_member` WHERE id=?";

    $s=$conn->prepare($sql);

    $s->bind_param("s",$id);

    $s->bind_result($id,$admin_id,$email,$color,$mobile,$last_login,$dob,$username,$roll,$serial,$shop_id,$avtar,$reg,$gender1,$address1,$status1,$aadhaar);

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
            <a class="btn btn-primary" href="administration-admin-user-dis.php"><i class="fa fa-long-arrow-left me-2"></i>View</a>
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
			  <form id="myForm" role="form" action="action/adminstration-admin-user.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
			  
			  	<?php if(!empty($_SESSION['msg'])){ ?>
				<div role="alert" class="alert alert-success text-center"><?php echo $_SESSION['msg']; ?></div>
				<?php unset($_SESSION['msg']); } ?>
				<?php if(!empty($_SESSION['error'])){ ?>
				<div role="alert" class="alert alert-danger  text-center"><?php echo $_SESSION['error']; ?></div>
				<?php unset($_SESSION['error']); } ?>
                
				<div class="row">
                 
				 
				 
				  <?php if($autoFill){ ?>

                  <div class="col-md-4">

                    <label for="TextInput" class="form-label">Change Password<span class="label label-danger" id="pf_error"></span></label>

                    <select class="form-control" name="change_pwd" id="change_pwd">

                        <option>No</option>

                        <option>Yes</option>

                    </select>

                  </div>

                 <?php } ?>

                

                <div class="col-md-4">

                    <label for="TextInput" class="form-label">Name<span class="label label-danger" id="pf_error"></span></label>

                    <input type="text" required="" value="<?php echo $username; ?>" class="form-control" name="Name" id="Name" />  

                </div>

                <div class="col-md-4">

                    <label for="TextInput" class="form-label">Email<span class="label label-danger" id="pf_error"></span></label>

                    <input type="text" class="form-control" value="<?php echo $email; ?>" name="Email" id="Email" />  

                </div>

                <div class="col-md-4">

                    <label for="TextInput" class="form-label">Mobile<span class="label label-danger" id="pf_error"></span></label>

                     <input type="text" class="form-control" value="<?php echo $mobile; ?>" name="Mobile" id="Mobile" />  

                </div>

                <div class="col-md-4">

                    <label for="TextInput" class="form-label">Aadhaar<span class="label label-danger" id="pf_error"></span></label>

                     <input type="text" class="form-control" value="<?php echo $aadhaar; ?>" name="aadhaar" id="aadhaar" />  

                </div>

                  <div class="col-md-4">

                    <label for="TextInput" class="form-label">Date of Birth<span class="label label-danger" id="pf_error"></span></label>

                    <input type="date" class="form-control" name="Dob" value="<?php echo $dob; ?>" id="datepicker" />  

                  </div>

                  <div class="col-md-4">

                    <label for="TextInput" class="form-label">Gender<span class="label label-danger" id=""></span></label>

                    <select class="form-control" name="gender">

                      <option <?php if(!empty($gender1) && $gender1=='Male'){ echo 'selected';}?> value="Male">Male</option>

                      <option <?php if(!empty($gender1) && $gender1=='Female'){ echo 'selected';}?> value="Female">Female</option>

                    </select>

                  </div>

                  <div class="col-md-4">

                    <label for="TextInput" class="form-label">Address<span class="label label-danger" id=""></span></label>

                    <input type="text" class="form-control" name="address" value="<?php if(!empty($address1)){ echo $address1;} ?>" id="datepicker" />  

                  </div>

                  

                  <div class="col-md-4">

                    <label for="TextInput" class="form-label">Password<span class="label label-danger" id="pf_error"></span></label>

                    <input type="text" name="password" class="form-control" />

                    <?php if($autoFill){ ?>

                    <input type="hidden" name="color" value="<?php echo $color; ?>" />

                    <input type="hidden" name="edit_id" value="<?php echo $id; ?>" />

                    <?php } ?>

                  </div>

                <div class="col-md-4">

                    <label for="TextInput" class="form-label">Role<span class="label label-danger" id="pf_error"></span></label>

                    <select class="form-control" name="Role" id="Role">

                        <option>Super Admin</option>
						
						<option>Admin</option>
						
                        <option>Employee</option>
                        

                    </select>

                </div>

				 <div class="col-md-4">

                  <label for="TextInput" class="form-label">Upload Photo<span class="label label-danger" id="pf_error"></span></label>

                  <input type="file" class="form-control" name="photo" id="photo"   >
				  

                </div>

                <div class="col-md-4">

                    <label for="TextInput" class="form-label">Status<span class="label label-danger" id="pf_error"></span></label>

                    <select class="form-control" name="status" id="status">

                        <option value="1">Approved</option>

                        <option value="0">Not Approve</option>

                    </select>

                </div>

                  <?php if($autoFill){ ?>

                  <div class="col-md-4">

                      <img width="25%" src="../upload/admin/<?php echo $avtar; ?>" />

                  </div>

                  <input type="hidden" class="form-control" value="<?php echo $avtar; ?>" name="old_photo" id="old_photo"  />

                  <?php } ?>
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 
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
	
	
	
    <?php include './include/footer.php'; ?>
<script>
$('.menu-administration').addClass("active");
$('#menu-administration').addClass("show");
$('.menu-administration-admin').addClass("active");
</script>
