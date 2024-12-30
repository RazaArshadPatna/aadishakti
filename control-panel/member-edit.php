<?php session_start();
include './include/connection.php';
include './include/function_db.php';
require_once './include/isLogin.php';
/* page info */
$form_title="Members Update";
$module="Web Pages";
$auto_Fill=false;
if(isset($_GET['id'])){
     $auto_Fill=true;    
     $id=$_GET['id'];
     $sql="SELECT `id`,`utr_number`,`apply_for`,`grp_id`,`applicant_name`,`father`,`dob`,`age`,`category`,`village`,`post`,`panchayat`,`police`,`block`,`subdivision`,`district`,`state`,`pin`,`mobile`,`whatsapp`,`aadhar`,`pan`,`nominee`,`nominee_age`,`relation`,`kcc`,`kcc_number`,`land_village`,`land_type`,`area`,`irrigated_land`,`source_irrigation`,`equipment`,`types_of_farming`,`other_agriculture`,`spices`,`village_industry`,`more_info`,`ward`,`photo`,`password`,`status` FROM `farmer_registration` WHERE id=?";
     $s=$conn->prepare($sql);
     $s->bind_param("s",$id);
     $s->bind_result($edit_id,$utr_number,$apply_for,$grp_id,$applicant_name,$father,$dob,$age,$category,$village,$post,$panchayat,$police,$block,$subdivision,$district,$state,$pin,$mobile,$whatsapp,$aadhar,$pan,$nominee,$nominee_age,$relation,$kcc,$kcc_number,$land_village,$land_type,$area,$irrigated_land,$source_irrigation,$equipment,$types_of_farming,$other_agriculture,$spices,$village_industry,$more_info,$ward,$photo,$password,$status);
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
                        <a class="btn btn-primary" href="employee-group-dis.php"><i
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
                            <form method="post" action="action/member.php" enctype='multipart/form-data'>
                                <div class="container-fluid" style="padding-bottom:30px;">


                                  


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
                                            <h4>Personal Details</h4>
                                        </div>
                                        <div class="col-lg-1"></div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">UTR No*</label>
                                                    <input type="text" required="" class="form-control"
                                                        id="exampleFormControlInput1" name="utr_number" value="<?php if(!empty($utr_number)){ echo $utr_number;}?>">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Apply For*</label>
                                                    <select class="form-control" name="apply_for">
                                                        <option value="">--Select--</option>
                                                        <?php 
                                                            record_set($conn,'amount',"SELECT `cat_id`,`heading1`,`amount` FROM `master_reg_amount` WHERE `status`='Publish'");
                                                            while($row_amount= mysqli_fetch_assoc($amount)){
                                                            ?>
                                                        <option <?php if(!empty($apply_for) && $apply_for==$row_amount['cat_id']){ echo 'selected';}?> value="<?php echo $row_amount['cat_id'];?>">
                                                            <?php echo $row_amount['heading1'];?>(<?php echo 'Rs.'.$row_amount['amount'];?>)
                                                        </option>
                                                        <?php }?>

                                                    </select>
                                                </div>
                                                <input type="hidden" name="edit_id" value="<?php echo $edit_id;?>">
                                                <div class="col-lg-4 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Group*</label>
                                                    <select class="form-control" name="grp_id" required>
                                                        <option value="">--Select Group--</option>
                                                        <?php 
                                                            record_set($conn,'group',"SELECT `grp_id`,`grp_name` FROM `farmer_group` WHERE `status`='Active'");
                                                            while($row_group= mysqli_fetch_assoc($group)){
                                                            ?>
                                                        <option <?php if(!empty($grp_id) && $grp_id==$row_group['grp_id']){ echo 'selected';}?>  value="<?php echo $row_group['grp_id']?>">
                                                            <?php echo $row_group['grp_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Applicant
                                                        Name*</label>
                                                    <input type="text" required="" class="form-control"
                                                        id="exampleFormControlInput1" name="applicant_name" value="<?php if(!empty($applicant_name)){ echo $applicant_name;}?>">
                                                </div>

                                                <div class="col-lg-4 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Father/Husband
                                                        Name*</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" id="father" name="father"
                                                        required value="<?php if(!empty($father)){ echo $father;}?>">
                                                </div>


                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Date Of
                                                        Birth*</label>
                                                    <input placeholder="Select your DOB" type="date" id="datepicker"
                                                        class="form-control" name="dob" value="<?php if(!empty($dob)){ echo date('Y-m-d',strtotime($dob));}?>">
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Age*</label>
                                                    <input type="number" class="form-control"
                                                        id="exampleFormControlInput1" required name="age" value="<?php if(!empty($age)){ echo $age;}?>">
                                                </div>
                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Photo*</label>
                                                    <input type="file" class="form-control"
                                                        id="exampleFormControlInput1" name="photo">
                                                        <a download href="../upload/farmer_photo/<?php echo $photo;?>"><img src="../upload/farmer_photo/<?php echo $photo;?>" style="width:100px;"></a>
                                                        <input type="hidden" name="old_img" value="<?php echo $photo;?>">
                                                </div>

                                                <div class="col-lg-3 mb-3" style="padding-top:8px;">
                                                    <p style="font-size:13px;">Category*</p>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="category"
                                                            id="inlineRadio1000" value="APL" <?php if(!empty($category) && $category=='APL'){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio1000"
                                                            style="font-size:13px;">APL</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="category"
                                                            id="inlineRadio2000" value="BPL" <?php if(!empty($category) && $category=='BPL'){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio2000"
                                                            style="font-size:13px;">BPL</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" <?php if(!empty($category) && $category=='No'){ echo 'checked';}?>
                                                            name="category" id="inlineRadio20000" value="No">
                                                        <label class="form-check-label" for="inlineRadio20000"
                                                            style="font-size:13px;">No</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-1"></div>
                                    </div>





                                    <div class="row">
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-10">
                                            <h4>Address Details</h4>
                                        </div>
                                        <div class="col-lg-1"></div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Village
                                                        Name*</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="village" value="<?php if(!empty($village)){ echo $village;}?>" required>
                                                </div>


                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Post*</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="post" required value="<?php if(!empty($post)){ echo $post;}?>">
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Panchayat*</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="panchayat" required value="<?php if(!empty($panchayat)){ echo $panchayat;}?>">
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Police
                                                        Station*</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="police" required value="<?php if(!empty($police)){ echo $police;}?>">
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Block*</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="block" required value="<?php if(!empty($block)){ echo $block;}?>">
                                                </div>
                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Ward No*</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="ward" required value="<?php if(!empty($ward)){ echo $ward;}?>">
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Subdivision*</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="subdivision" required value="<?php if(!empty($subdivision)){ echo $subdivision;}?>">
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">District/Province*</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="district" required value="<?php if(!empty($district)){ echo $district;}?>">
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <div class="main">
                                                        <label style="font-size:13px;padding-bottom:6px;">State*</label>
                                                        <select name="state" class="form-select">
                                                            <?php 
                                record_set($conn,'state',"SELECT `cat_id`,`heading1` FROM `master_state` WHERE `status`='Publish'");
                                while($row_state= mysqli_fetch_assoc($state)){
                                ?>
                                                            <option <?php if(!empty($state)&& $state==$row_state['cat_id']){ echo 'selected';}?> value="<?php echo $row_state['cat_id'];?>">
                                                                <?php echo $row_state['heading1'];?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Pin Code /
                                                        Postal Code*</label>
                                                    <input type="number" class="form-control"
                                                        id="exampleFormControlInput1" name="pin" required value="<?php if(!empty($pin)){ echo $pin;}?>">
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Mobile
                                                        Number*</label>
                                                    <input type="number" class="form-control"
                                                        id="exampleFormControlInput1" name="mobile" maxLength="10"
                                                        required value="<?php if(!empty($mobile)){ echo $mobile;}?>">
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Watsapp
                                                        Number</label>
                                                    <input type="number" class="form-control"
                                                        id="exampleFormControlInput1" maxLength="10" name="whatsapp" value="<?php if(!empty($whatsapp)){ echo $whatsapp;}?>">
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Adhar
                                                        Number*</label>
                                                    <input type="text" class="form-control" id="aadhar" name="aadhar"
                                                        data-type="adhaar-number" maxLength="14" required value="<?php if(!empty($aadhar)){ echo $aadhar;}?>">
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Pan Card
                                                        Number*</label>
                                                    <input type="text" class="form-control" id="pan_no" name="pan"
                                                        maxLength="10" required value="<?php if(!empty($pan)){ echo $pan;}?>">
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Nominee
                                                        Name*</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="nominee" required value="<?php if(!empty($nominee)){ echo $nominee;}?>">
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Relation*</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="relation" required value="<?php if(!empty($relation)){ echo $relation;}?>">
                                                </div>

                                                <div class="col-lg-4 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Nominee
                                                        Age*</label>
                                                    <input type="number" class="form-control"
                                                        id="exampleFormControlInput1" name="nominee_age" required value="<?php if(!empty($nominee_age)){ echo $nominee_age;}?>">
                                                </div>

                                                <div class="col-lg-2 mb-3" style="padding-top:8px;">
                                                    <p style="font-size:13px;">Kisan credit card*</p>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="kcc"
                                                            id="inlineRadio100" value="yes" <?php if(!empty($kcc) && $kcc='yes'){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio100"
                                                            style="font-size:13px;">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="kcc"
                                                            id="inlineRadio200" value="no" <?php if(!empty($kcc) && $kcc='no'){ echo 'checked';}?>>
                                                        <label class="form-check-label" checked for="inlineRadio200"
                                                            style="font-size:13px;">No</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">KCC
                                                        Number</label>
                                                    <input type="number" class="form-control"
                                                        id="exampleFormControlInput1" name="kcc_number" value="<?php if(!empty($kcc_number)){ echo $kcc_number;}?>">
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-1"></div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-9">
                                            <h4>Details Of Land Holding</h4>
                                        </div>
                                        <!-- <div class="col-lg-2"><a href="javascript:void(0)" class="extra-fields-customer text-center btn btn-success"><i class="fas fa-plus"></i></a></div> -->
                                    </div>

                                    <div class="row customer_records">

                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-10">
                                            <div class="row">



                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Village
                                                        Name*</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="land_village" requuired value="<?php if(!empty($land_village)){ echo $land_village;}?>">
                                                </div>


                                                <div class="col-lg-3 mb-3">
                                                    <div class="main">
                                                        <label style="font-size:13px;padding-bottom:6px;">Land
                                                            Type*</label>
                                                        <select name="land_type" class="form-select">
                                                            <option <?php if(!empty($land_type) && $land_type=='Personal'){ echo 'selected';}?> value="Personal">Personal</option>
                                                            <option <?php if(!empty($land_type) && $land_type=='Partnership'){ echo 'selected';}?> value="Partnership">Partnership</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Area(In
                                                        Acer)*</label>
                                                    <input type="number" name="area" id="" class="form-control"
                                                        required value="<?php if(!empty($area)){ echo $area;}?>">
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Irrigated
                                                        Land</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="irrigated_land" value="<?php if(!empty($irrigated_land)){ echo $irrigated_land;}?>">
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Source Of
                                                        Irrigation</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="source_irrigation" value="<?php if(!empty($source_irrigation)){ echo $source_irrigation;}?>">
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label style="font-size:13px;" for="exampleFormControlInput1"
                                                        class="form-label">Agricultural
                                                        Equipment Detail(if any)</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="equipment" value="<?php if(!empty($equipment)){ echo $equipment;}?>">
                                                </div>

                                                    <?php 
                                                    $types_of_farming = explode(",",$types_of_farming);
                                                    
                                                    ?>
                                                <div class="col-lg-12 mb-3" style="padding-top:8px;">
                                                    <p style="font-size:13px;">Crop Details(What Kind of farming you
                                                        do?)*</p>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="crop_details[]" id="inlineRadio1" value="Fruits" <?php if(in_array("Fruits",$types_of_farming)){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio1"
                                                            style="font-size:13px;">Fruits</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="crop_details[]" id="inlineRadio2" value="Flowers" <?php if(in_array("Flowers",$types_of_farming)){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio2"
                                                            style="font-size:13px;">Flowers</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="crop_details[]" id="inlineRadio3" value="Vegetables" <?php if(in_array("Vegetables",$types_of_farming)){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio3"
                                                            style="font-size:13px;">Vegetables</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="crop_details[]" id="inlineRadio4" value="Rice" <?php if(in_array("Rice",$types_of_farming)){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio4"
                                                            style="font-size:13px;">Rice</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="crop_details[]" id="inlineRadio5" value="Wheat" <?php if(in_array("Wheat",$types_of_farming)){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio5"
                                                            style="font-size:13px;">Wheat</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="crop_details[]" id="inlineRadio6" value="Corn" <?php if(in_array("Corn",$types_of_farming)){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio6"
                                                            style="font-size:13px;">Corn</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="crop_details[]" id="inlineRadio7" value="Oil Seeds" <?php if(in_array("Oil Seeds",$types_of_farming)){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio7"
                                                            style="font-size:13px;">Oil Seeds</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="crop_details[]" id="inlineRadio8" value="Pulses" <?php if(in_array("Pulses",$types_of_farming)){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio8"
                                                            style="font-size:13px;">Pulses</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="crop_details[]" id="inlineRadio9" value="Mushroom" <?php if(in_array("Mushroom",$types_of_farming)){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio9"
                                                            style="font-size:13px;">Mushroom</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="crop_details[]" id="inlineRadio10"
                                                            value="pharmaceutical" <?php if(in_array("pharmaceutical",$types_of_farming)){ echo 'checked';}?>>
                                                        <label class="form-check-label" for="inlineRadio10"
                                                            style="font-size:13px;">pharmaceutical</label>
                                                    </div>

                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-4 mb-3">
                                                        <label style="font-size:13px;" for="exampleFormControlInput1"
                                                            class="form-label">Other Agricultural Products</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleFormControlInput1" name="other_agriculture"  value="<?php if(!empty($other_agriculture)){ echo $other_agriculture;}?>">
                                                    </div>
                                                    <div class="col-lg-4 mb-3">
                                                        <label style="font-size:13px;" for="exampleFormControlInput1"
                                                            class="form-label">Spices Factory</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleFormControlInput1" name="spice"  value="<?php if(!empty($spices)){ echo $spices;}?>">
                                                    </div>

                                                    <div class="col-lg-4 mb-3">
                                                        <label style="font-size:13px;" for="exampleFormControlInput1"
                                                            class="form-label">Village Industry Business</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleFormControlInput1" name="village_industry" value="<?php if(!empty($village_industry)){ echo $village_industry;}?>">
                                                        
                                                    </div>
                                                    <div class="col-lg-4 mb-3">
                                                        <label style="font-size:13px;" for="exampleFormControlInput1"
                                                            class="form-label">Password</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleFormControlInput1" name="password" value="<?php if(!empty($password)){ echo $password;}?>">
                                                        
                                                    </div>
                                                </div>


                                            </div>

                                        </div>

                                        <div class="col-lg-1 remove_btn"></div>


                                    </div>



                                    <div class="customer_records_dynamic"></div>


                                    <div class="row mb-3">
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-10">
                                            <label for="exampleFormControlTextarea1" class="form-label">Any More
                                                Info..</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                name="more_info"><?php if(!empty($more_info)){ echo $more_info;}?></textarea>
                                        </div>
                                        <div class="col-lg-1"></div>


                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-10">
                                            <label for="exampleFormControlTextarea1" class="form-label">Status</label>
                                            <select class="form-control" name="status" required>
                                                <option <?php if(!empty($status)&& $status=='Pending'){ echo 'selected';}?> value="Pending">Pending</option>
                                                <option <?php if(!empty($status)&& $status=='Approved'){ echo 'selected';}?> value="Approved">Approved</option>
                                                <option <?php if(!empty($status)&& $status=='Reject'){ echo 'selected';}?> value="Reject">Reject</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-1"></div>


                                    </div>

                                    <div class="row">
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                        <div class="col-lg-1"></div>
                                    </div>




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
        $('.menu-group').addClass("active");
        </script>
        <script>
        function makeid(length) {
            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const charactersLength = characters.length;
            let counter = 0;
            while (counter < length) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
                counter += 1;
            }
            return result;
        }
        $("#pass").val(makeid(5) + '<?php echo time();?>');
        //alert(makeid(8));
        </script>