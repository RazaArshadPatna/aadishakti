<?php session_start();

date_default_timezone_set("Asia/Calcutta");

include "./include/connection.php";

include './common/getOS.php';

function make_form_color($word){

    $first="&&^^%9";

    $mid=$word;

    $last="%^^@@~XX";

    $color=$first.$mid.$last;

    return sha1($color);

}

function login_page_visit($conn,$key_word,$hash,$security_info){

    $sql="INSERT INTO `login_page_visit`(`key_word`, `hash`, `security_info`) VALUES (?,?,?)";

    $s=$conn->prepare($sql);

    $s->bind_param("sss",$key_word,$hash,$security_info);

    if($s->execute()){

        return true;

    }else{

        return false;

    }

}

$key=uniqid();

$hash=make_form_color($key);

$_SESSION['hash_key']=$key;

$date=date("YmdHis");

$os=getOS();

$browser= getBrowser();

$logout_date="-";

$mac="-";

$ip=$_SERVER['REMOTE_ADDR'];

$security_details['date']=$date;

$security_details['os']=$os;

$security_details['ip']=$ip;

$security_details['browser']=$browser;

$security_info= json_encode($security_details);

login_page_visit($conn,$key,$hash,$security_info);

$status=0;

$sql="SELECT `status` FROM `blocked_ip` WHERE `ip_address`=? order by id desc limit 1";

$s=$conn->prepare($sql);

$s->bind_param("s",$ip);

$s->bind_result($status);

if($s->execute()){

   $s->fetch();

   $s->close();

}

$ip_blocked=false;

if($status==""){

    

}else{

    if($status<=date("YmdHis")){

        unset($_SESSION['ip_blocked']);

    }else{

        $_SESSION['ip_blocked']=true;

        $ip_blocked=true;

    }

}


$sql="SELECT name,logo,fav_icon,loginban FROM `website_data`";
$s=$conn->prepare($sql);
$s->bind_result($webname,$logo,$fav_icon,$loginban);
$s->execute();
$s->fetch();
$s->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="icon" href="../upload/fav/<?php echo $fav_icon;?>" type="image/x-icon">
  <title>Welcome To <?php echo $webname; ?></title>
  <!-- Application vendor css url -->
  <!-- project css file  -->
  <?php include './include/head.php'; ?>
</head>

<body id="layout-1" data-luno="theme-blue">
  <!-- start: body area -->
  <div class="wrapper">
    <!-- Sign In version 1 -->
    <!-- start: page body -->
    <div class="page-body auth px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
      <div class="container-fluid">
        <div class="row g-0">
          <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center">
            <div>
            <img src="../upload/loginban/<?php echo $loginban; ?>" style="width:100%"/>
            </div>
          </div>
          <div class="col-lg-6 d-flex justify-content-center align-items-center">
            <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">
              <!-- Form -->
              
                <div class="col-12 text-center mb-5">
                  <h1>Sign in</h1>
                </div>
                <div class="col-12 text-center mb-4">
                  
                    <span class="d-flex justify-content-center align-items-center">
                    <img src="../upload/logo/<?php echo $logo; ?>" alt="" style="width:35%"/></span>
                  
                  
                  <?php if(isset($_GET['error'])){ ?>

                  <?php if($_GET['error']==md5(1)){ ?>

                  <?php }else{ ?>

                  <p class="text-center" style="color:red;font-weight:900;">Wrong User Name of Password</p>

                  <?php }
                  } ?>
                </div>
            <form action="secure-login.php" method="post">
                <input type="hidden" name="hash" value="<?php echo $hash; ?>">
                <div class="col-12">
                  <div class="mb-2">
                    <label class="form-label">Email address</label>
                    <input type="email" name="user" class="form-control form-control-lg" required placeholder="Enter User Email">
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-2">
                    <div class="form-label">
                      <span class="d-flex justify-content-between align-items-center"> Password 
                      </span>
                    </div>
                    <input class="form-control form-control-lg" type="password"  required name="pass" placeholder="Enter the password">
                  </div>
                </div>
                
                <div class="col-12 text-center mt-4">
                  <button class="btn btn-lg btn-block btn-dark lift text-uppercase" type="submit">SIGN IN</button>
                </div>
              </form>
              <!-- End Form -->
            </div>
          </div>
        </div> <!-- End Row -->
      </div>
    </div>

  </div>
  <!-- Modal: Setting -->


 <script src="assets/js/theme.js"></script>
</body>
</html>