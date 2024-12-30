<?php include 'config/header.php'; ?>
<!--Page Header Start-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url(assets/images/backgrounds/page-header-bg1.jpg)">
    </div>
    <div class="main-slider-border"></div>
    <div class="main-slider-border main-slider-border-two"></div>
    <div class="main-slider-border main-slider-border-three"></div>
    <div class="main-slider-border main-slider-border-four"></div>
    <div class="main-slider-border main-slider-border-five"></div>
    <div class="main-slider-border main-slider-border-six"></div>
    <div class="container">
        <div class="page-header__inner">
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="index.php">Home</a></li>
                <li><span>//</span></li>
                <li><a href="services.php">Services</a></li>
                <li><span>//</span></li>
                <li>Services Detail</li>
            </ul>
            <h2>Services Detail</h2>
        </div>
    </div>
</section>
<!--Page Header End-->

<?php 

if(isset($_GET['sid'])){
    $id=$_GET['sid'];

   $sql="SELECT `name`,`media`,`details` from `product` where `id`=?";
   $s=$conn->prepare($sql);
   $s->bind_param("s",$id);
   $s->bind_result($service_heading,$service_img,$service_dtl);
   $s->execute();
   $s->store_result();
   $s->fetch();
   $s->close();
}
else{?>
<script>
    window.location.href="index.php";
</script>

<?php }
?>
<!--Service Details Start-->
<section class="service-details"  style="background:linear-gradient(45deg, rgb(255 255 255 / 97%), rgb(255 255 255 / 93%)), url(assets/images/div.jpg)">
    <div class="container">
        <div class="row">
            
            <div class="col-xl-8 col-lg-7">
                <div class="service-details__right">
                    <div class="service-details__content-box">
                        <div class="service-details__img">
                            <img src="upload/product/<?php echo $service_img; ?>" alt="">
                        </div>
                        <h3 class="service-details__title"><?php echo $service_heading; ?></h3>
                        <?php echo html_entity_decode($service_dtl); ?>
                    </div>
                    
                    
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="service-details__left">

                    <div class="sidebar__single sidebar__post">
                        <h3 class="sidebar__title">Our Services</h3>
                        <ul class="sidebar__post-list list-unstyled">

                        <?php 
                            $sql="SELECT `id`,`name`,`media` from `product` limit 3";
                            $s=$conn->prepare($sql);
                            $s->bind_result($id_side,$service_side_name,$service_side_img);
                            if($s->execute()){
                            while(   $s->fetch()){
                        ?>

                            <li style="background:aliceblue;">
                                <div class="sidebar__post-image">
                                    <img src="upload/product/<?php echo $service_side_img; ?>" alt="">
                                </div>
                                <div class="sidebar__post-content">
                                    <h3>

                                        <a href="service-detail.php?sid=<?php echo $id_side; ?>"><?php echo $service_side_name; ?></a>
                                    </h3>
                                </div>
                            </li>

                        <?php
                            }
                            }
                            $s->close();
                        ?>

                            
                        </ul>
                    </div>
                    <div class="service-details__need-help">
                        <div class="service-details__need-help-bg"
                            style="background-image: url(assets/images/backgrounds/service-details-need-help-bg.jpg)">
                        </div>
                        <div class="service-details__need-help-icon">
                            <span class="icon-phone-call"></span>
                        </div>
                        <h2 class="service-details__need-help-title">For Song And Movies Shooting And Composing Contact Us
                        </h2>
                        <div class="service-details__need-help-contact">
                            <p>Call anytime</p>
                            <a href="tel:<?php echo $mobile1; ?>"><?php echo $mobile1; ?></a>
                        </div>
                    </div>
                    <div class="service-details__download">
                        <a href="contact.php" class="thm-btn service-details__btn">Contact Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Service Details End-->
<?php include 'config/footer.php'; ?>