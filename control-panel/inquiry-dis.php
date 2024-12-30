<?php session_start();

include './include/connection.php';

require_once './include/isLogin.php';

require_once './common/getDate.php';

require_once './common/getAdminName.php';

/* page info */

$form_title="Inquiry";

$module="Inquiry";

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
  <link rel="stylesheet" href="./assets/cssbundle/dataTables.min.css">
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
           <button class="btn btn-danger" onClick="Trush('inquiry')"><i class="fa fa-trash"></i></button>
			
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
			  
              <div class="card-body">
                <div class="table-responsive">
				<table id="myTable" class="table display dataTable table-hover" style="width:100%">
                  <thead>



                <tr>

                  <th>Sno</th>
				  
				  <th>Name</th>

                  <th>Phone</th>
				  
				  <th>Email</th>
          <th>Message</th>
				
				  
                  <th>Entry Date</th>



                </tr>



              </thead>



              <tbody>

                 <?php 
				 $i=1;
				 $sql="SELECT `id`, `Name`, `mobile`, `Email`, `Details`, `subject`, `entry_time` FROM `inquiry`";

                 $s=$conn->prepare($sql);

                 $s->bind_result($id,$name,$mobile,$email,$details,$subject,$entry_time);

                 if($s->execute()){
				 
				 $s->store_result();

				   while($s->fetch()){

					 

                 ?>

                <tr class="gradeX" id="row<?php echo $id; ?>">   
                <td><?php echo $i;?> <input type="checkbox" name="mycheck" value="<?php echo $id; ?>" /></td>
                  

                    <td><?php echo $name; ?></td>
					
                    <td><?php echo $mobile; ?></td>
                    
                    <td><?php echo $email; ?></td>
                    <td><?php echo $details; ?></td>
					        
                    <td><?php echo date('d-m-Y h:i:s',strtotime($entry_time)); ?></td>

                </tr>

                <?php   $i++;   

                     }
					 
					 $s->close();

                 } ?>

              </tbody>
                  
                </table>
				 </div>
				</div>  
               
			  
			  
            </div>
          </div>
          
        </div> 
        
      </div>
    </div>
    <?php include './include/footer.php'; ?>
	<script src="./assets/js/bundle/dataTables.bundle.js"></script>
	<script>
  $('.menu-inquiry').addClass("active");


</script>
 <script>
    
    // DataTable
    $(function() {
      $('#myTable')
        .addClass( 'nowrap' )
        .dataTable( {
            responsive: true,
        });
    });
  </script>

<script src="./assets/js/master-killer.js" type="text/javascript"></script>