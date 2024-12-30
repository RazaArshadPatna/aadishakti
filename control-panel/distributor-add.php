<?php session_start();
include './include/connection.php';
require_once './include/isLogin.php';
include './include/function_db.php';
/* page info */
$form_title="Manage Distributor";
$module="Web Pages";
$auto_Fill=false;
if(isset($_GET['id'])){
     $auto_Fill=true;    
     $id=$_GET['id'];
     $sql="SELECT `id`,`dst_code`,`utr_no`, `photo`, `name`, `father`, `proprietor`, `center`, `village`, `post`, `police`, `panchayat`, `block`, `district`, `state`, `pin`, `mobile_1`, `mobile_2`, `whatsapp`, `aadhar`, `voter`, `pan`, `company`, `reg_no`, `gst`, `seed_no`, `fertilizer_no`, `pesticide_no`, `other_no`, `apply_lic`, `password`, `entry_date`, `status` FROM `distributor_registration` WHERE id=?";
     $s=$conn->prepare($sql);
     $s->bind_param("s",$id);
     $s->bind_result($edit_id,$dst_code,$utr_no, $photo,$name, $father, $proprietor, $center,$village,$post,$police,$panchayat,$block,$district,$state,$pin,$mobile_1,$mobile_2,$whatsapp,$aadhar,$voter,$pan,$company,$reg_no,$gst,$seed_no,$fertilizer_no,$pesticide_no,$other_no,$apply_lic,$password,$entry_date,$status);
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
                        <a class="btn btn-primary" href="distributor-dis.php"><i
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

                            <?php if(!empty($_SESSION['msg'])){ ?>
                            <div role="alert" class="alert alert-success text-center"><?php echo $_SESSION['msg']; ?>
                            </div>
                            <?php unset($_SESSION['msg']); } ?>
                            <?php if(!empty($_SESSION['error'])){ ?>
                            <div role="alert" class="alert alert-danger  text-center"><?php echo $_SESSION['error']; ?>
                            </div>
                            <?php unset($_SESSION['error']); } ?>

                            <form method="post" action="action/distributor" enctype='multipart/form-data'>

                                <div class="row">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-10">
                                        <h4>Personal Details</h4>
                                    </div>
                                    <div class="col-lg-1"></div>
                                </div>

                                <div class="row">
                                    <?php if(isset($_SESSION['msg'])){ ?>
                                    <p class="text-success text-center msg">
                                        <?php echo $_SESSION['msg'];unset($_SESSION['msg']); ?></p>
                                    <?php } ?>
                                    <?php if(isset($_SESSION['error'])){ ?>
                                    <p class="text-warning text-center msg">
                                        <?php echo $_SESSION['error'];unset($_SESSION['error']); ?></p>
                                    <?php } ?>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-4 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">UTR
                                                    No*</label>
                                                <input type="text" required="" name="utr_no" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($utr_no)){ echo $utr_no;}?>">
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Name*</label>
                                                <input type="text" required="" name="name" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($name)){ echo $name;}?>">
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Father/Husband
                                                    Name*</label>
                                                <input type="text" required="" name="father" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($father)){ echo $father;}?>">
                                            </div>
                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Photo</label>
                                                <input type="file" name="photo" class="form-control"
                                                    id="exampleFormControlInput1">
                                                <img src="../upload/distributor_photo/<?php echo $photo;?>"
                                                    style="width:150px;">
                                                <input type="hidden" name="old_img" value="<?php echo $photo;?>">
                                                <input type="hidden" name="Edit_id" value="<?php echo $edit_id;?>">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Proprietor
                                                    Name*</label>
                                                <input type="text" required="" name="proprietor" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($proprietor)){ echo $proprietor;}?>">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Center*</label>
                                                <input type="text" required="" name="center" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($center)){ echo $center;}?>">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Village*</label>
                                                <input type="text" required="" name="village" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($village)){ echo $village;}?>">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">PO*</label>
                                                <input type="text" required="" name="post" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($post)){ echo $post;}?>">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">PS*</label>
                                                <input type="text" required="" name="police" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($police)){ echo $police;}?>">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Panchayat*</label>
                                                <input type="text" required="" name="panchayat" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($panchayat)){ echo $panchayat;}?>">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Block*</label>
                                                <input type="text" required="" name="block" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($block)){ echo $block;}?>">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">District*</label>
                                                <input type="text" required="" name="district" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($district)){ echo $district;}?>">
                                            </div>


                                            <div class="col-lg-3 mb-3">
                                                <div class="main">
                                                    <label style="font-size:13px;padding-bottom:6px;">Select
                                                        State*</label>
                                                    <select class="form-select" name="state">
                                                        <?php 
                                                              record_set($conn,'state',"SELECT `cat_id`,`heading1` FROM `master_state` WHERE `status`='Publish'");
                                                              while($row_state= mysqli_fetch_assoc($state)){
                                                              ?>
                                                        <option
                                                            <?php if(!empty($state) && $state==$row_state['cat_id']){ echo 'selected';}?>
                                                            value="<?php echo $row_state['cat_id'];?>">
                                                            <?php echo $row_state['heading1'];?></option>
                                                        <?php }?>
                                                    </select>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Pin
                                                    No.*</label>
                                                <input type="text" required="" name="pin" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($pin)){ echo $pin;}?>">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Mobile
                                                    Number1*</label>
                                                <input type="text" required="" name="mobile_1" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($mobile_1)){ echo $mobile_1;}?>">
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Mobile
                                                    Number2</label>
                                                <input type="text" name="mobile_2" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($mobile_2)){ echo $mobile_2;}?>">
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Watsapp
                                                    Number</label>
                                                <input type="text" name="whatsapp" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($whatsapp)){ echo $whatsapp;}?>">
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Adhaar
                                                    Number*</label>
                                                <input type="text" required="" name="aadhar" class="form-control"
                                                    id="aadhar" data-type="adhaar-number" maxLength="14"
                                                    value="<?php if(!empty($aadhar)){ echo $aadhar;}?>">
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Voter
                                                    Number*</label>
                                                <input type="text" required="" name="voter" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($voter)){ echo $voter;}?>">
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">PAN
                                                    Number*</label>
                                                <input type="text" required="" name="pan" class="form-control"
                                                    id="pan_no" maxLength="10"
                                                    value="<?php if(!empty($pan)){ echo $pan;}?>">
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-1"></div>
                                </div>





                                <div class="row">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-10">
                                        <h4>Organization Details</h4>
                                    </div>
                                    <div class="col-lg-1"></div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-12 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Company/Shop
                                                    Name*</label>
                                                <input type="text" required="" name="company" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($company)){ echo $company;}?>">
                                            </div>


                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Registration
                                                    No.</label>
                                                <input type="text" class="form-control" name="reg_no"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($reg_no)){ echo $reg_no;}?>">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">GST
                                                    No.</label>
                                                <input type="text" class="form-control" name="gst"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($gst)){ echo $gst;}?>">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Seed
                                                    Liscence
                                                    No.</label>
                                                <input type="text" name="seed_no" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($seed_no)){ echo $seed_no;}?>">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Fertilizer
                                                    Liscence No.*</label>
                                                <input type="text" name="fertilizer_no" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($fertilizer_no)){ echo $fertilizer_no;}?>">
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Pesticide
                                                    Liscence No.</label>
                                                <input type="text" class="form-control" name="pesticide_no"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($pesticide_no)){ echo $pesticide_no;}?>">
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Other
                                                    Liscence
                                                    No.</label>
                                                <input type="text" name="other_no" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($other_no)){ echo $other_no;}?>">
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="main">
                                                    <label style="font-size:13px;padding-bottom:6px;">Select LIC
                                                        Plan*</label>
                                                    <select name="apply_lic" class="form-select">
                                                        <?php 
                                                          record_set($conn,'amount',"SELECT `cat_id`,`heading1`,`amount` FROM `master_dis_reg_amount` WHERE `status`='Publish'");
                                                          while($row_amount= mysqli_fetch_assoc($amount)){
                                                          ?>
                                                        <option
                                                            <?php if(!empty($apply_lic)&& $apply_lic==$row_amount['cat_id']){ echo 'selected';}?>
                                                            value="<?php echo $row_amount['cat_id']?>">
                                                            <?php echo $row_amount['heading1'];?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Password</label>
                                                <input type="text" name="password" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    value="<?php if(!empty($password)){ echo $password;}?>">
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label style="font-size:13px;" for="exampleFormControlInput1"
                                                    class="form-label">Status</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="">--Select--</option>
                                                    <option
                                                        <?php if(!empty($status)&& $status=='Pending'){ echo 'selected';}?>
                                                        value="Pending">Pending</option>
                                                    <option
                                                        <?php if(!empty($status)&& $status=='Approved'){ echo 'selected';}?>
                                                        value="Approved">Approved</option>
                                                    <option
                                                        <?php if(!empty($status)&& $status=='Reject'){ echo 'selected';}?>
                                                        value="Reject">Reject</option>
                                                </select>
                                            </div>




                                        </div>

                                    </div>

                                    <div class="col-lg-1"></div>
                                </div>







                                <div class="customer_records_dynamic"></div>




                                <div class="row">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                        <p>Already have an account? <a href="distributor-login.php">Login</a></p>
                                    </div>
                                    <div class="col-lg-1"></div>
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
        $('.menu-web').addClass("active");
        $('#menu-web').addClass("show");
        $('.menu-distributor').addClass("active");
        </script>