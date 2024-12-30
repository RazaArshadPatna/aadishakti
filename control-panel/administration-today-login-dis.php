<?php session_start();

include './include/connection.php';

require_once './include/isLogin.php';

require_once './common/getDate.php';

/* page info */

$form_title="Admins";

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
           
			<button class="btn btn-danger" onClick="Trush('login_log')"><i class="fa fa-trash"></i></button>
			
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

                  <th>ALL<input id="checkAll"  name="Parent" type="checkbox" /></th>

                  <th>User Id</th>  

                  <th>Date</th>

                  <th>IP</th>

                  <th>OS</th>

                  <th>Browser</th>

                  <th>Logout</th>				  

                </tr>

                </thead>

                <tbody>

                 <?php

                 $i=1;

                 $sql="SELECT `id`, `user_id`, `date`, `logout`, `mac`, `ip`, `os`, `browser`, `logout_date`, `key_word` FROM `login_log` order by id DESC";

                 $s=$conn->prepare($sql);

                 $s->bind_result($id,$user_id,$date,$logout,$mac,$ip,$os,$browser,$logout_date,$key_word);

                 if($s->execute()){

                     while($s->fetch()){

                    

                 

                 ?>

                <tr class="gradeX" id="row<?php echo $id; ?>">   

                    <td><?php echo $i.".";$i++;  ?> <input type="checkbox" name="mycheck" value="<?php echo $id; ?>" /></td>   

                    <td><?php echo $user_id; ?></td>

                    <td><?php echo CusDate($date); ?></td>

                    <td><?php echo $ip; ?></td>

                    <td><?php echo $os; ?></td>

                    <td><?php echo $browser; ?></td>

                    <td><?php echo $logout_date; ?></td>                    

                </tr>

                <?php      

                     }

					 $s->close();

                 } ?>

              </tbody>

                <tfoot>

                  <th>ALL<input id="checkAll"  name="Parent" type="checkbox" /></th>

                  <th>User Id</th>  

                  <th>Date</th>

                  <th>IP</th>

                  <th>Os</th>

                  <th>Browser</th>

                  <th>Logout</th>

                </tfoot>
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
$('.menu-administration').addClass("active");
$('#menu-administration').addClass("show");
$('.menu-administration-today').addClass("active");
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