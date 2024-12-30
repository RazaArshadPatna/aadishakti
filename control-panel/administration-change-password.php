<?php session_start();

include './include/connection.php';

require_once './include/isLogin.php';



/* page info */

$form_title="Change Password";

$module="Administration";



/* page info end */

?>
<!doctype html>
<html class="no-js " lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $form_title; ?></title>

<?php include './include/head.php'; ?>
  
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
			  <form id="myForm" role="form" action="#" method="post">
              <div class="card-body">
			  
			  	<?php if(!empty($_SESSION['msg'])){ ?>
				<div role="alert" class="alert alert-success text-center"><?php echo $_SESSION['msg']; ?></div>
				<?php unset($_SESSION['msg']); } ?>
				<?php if(!empty($_SESSION['error'])){ ?>
				<div role="alert" class="alert alert-danger  text-center"><?php echo $_SESSION['error']; ?></div>
				<?php unset($_SESSION['error']); } ?>
                
				<div class="row">
                 
				 
				 

                  <div class="col-md-4">

                    <label for="TextInput" class="form-label">Old Password <span class="badge bg-danger" id="old_error"></span></label>

                    <input type="password"  class="form-control" name="old_password" id="old_password" required/>

                  </div>


                

                <div class="col-md-4">

                    <label for="TextInput" class="form-label">New Password <span class="badge bg-danger" id="new_error"></span></label>

                    <input type="password" class="form-control" name="new_password" id="new_password" required />

                </div>

                <div class="col-md-4">

                    <label for="TextInput" class="form-label">Re-Type New Password <span class="badge bg-danger" id="re_type_error"></span></label>

                    <input type="password" class="form-control" name="c_new_password" id="c_new_password" required />  

                </div>

                                
				 
				 
				 </div>
				 
				  
                  
                
              </div>
			  
			  <div class="card-footer">

                  
				  <button type="button" onClick="isReady()" class="btn lift btn-lg btn-primary">Submit</button>

              </div>
			  </form>
            </div>
          </div>
          
        </div> 
        
      </div>
    </div>
    <?php include './include/footer.php'; ?>
	<script>    

    $('#administration').addClass("active");

    

    function form_submit(){

        $('#myForm').attr('action','action/change-password.php');

        $('#myForm').submit();

    }

    function reset(){

        $("#myForm")[0].reset();

       $('#new_error').text("");

       $('#re_type_error').text(""); 

       $('#old_error').text(""); 

    }
	
	function isEmpty(data){
	
		if(data.length==0){
			return true;
		}else{
			return false;
		}
			
	}

    

    $('#old_password').keyup(function(){

         var old_pass=$('#old_password').val();

          

         if(isEmpty(old_pass)){            

           $('#old_error').text("This is required field"); 

        }else{

           $('#old_error').text(""); 

        }

    });

    $('#new_password').keyup(function(){

        var new_pass=$('#new_password').val();

        if(isEmpty(new_pass)){

           

           $('#new_error').text("This is required field"); 

        }else{

           $('#new_error').text(""); 

        }

    });

    $('#c_new_password').keyup(function(){

        var new_pass=$('#c_new_password').val();

        if(isEmpty(new_pass)){           

           $('#re_type_error').text("This is required field"); 

        }else{

           $('#re_type_error').text(""); 

        }

    });

    

    

    

    function isReady(){

        var error=0;

          var old_pass=$('#old_password').val();

          var new_pass=$('#new_password').val();

          var re_new_pass=$('#c_new_password').val();

        

        if(isEmpty(old_pass)){

            error++;

           $('#old_error').text("This is required field"); 

        }else{

           $('#old_error').text(""); 

        }

        if(isEmpty(new_pass))

        {

            error++;

            $('#new_error').text("This is required field"); 

        }

        else{

           $('#new_error').text(""); 

        }

        if(isEmpty(re_new_pass)){

            error++;

            $('#re_type_error').text("This is required field"); 

        }else{

           $('#re_type_error').text(""); 

        }

        

        

        if(error==0){

           form_submit(); 

        }else{

            return false;

        }
  

    }

  

</script>