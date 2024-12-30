<?php 
   include './control-panel/include/connection.php'; 
   $url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$canonical_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );


   $sql="SELECT `logo`,`facebook`,`twitter`,`youtube`,`linkdin`,`whatsapp`,`instagram`,`address_1`,`address_2`,`email_1`,`mobile_1`,`mobile_2`,`email_2`,`fav_icon`,`loginban`,`meta_title`,`meta_keywords`,`meta_description` from `website_data`";
   $s=$conn->prepare($sql);
   $s->bind_result($logo,$facebook,$twitter,$youtube,$linkdin,$watsapp,$instagram,$address1,$address2,$email1,$mobile1,$mobile2,$email2,$favicon,$loginban,$meta_title,$meta_keywords,$meta_description);
   $s->execute();
   $s->store_result();
   $s->fetch();
   $s->close();
?>

<?php 
if(isset($_GET['sid'])){
    $service_id=$_GET['sid'];
    $sql="SELECT `meta_title`,`meta_keywords`,`meta_description` from `product` where `id`=$service_id";
    $s=$conn->prepare($sql);
    $s->bind_result($meta_title,$meta_keywords,$meta_description);
    $s->execute();
    $s->fetch();
    $s->close();
}
?>

<!DOCTYPE html>
<html lang="en">



<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AdiShakti</title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="./upload/logo/<?php echo $logo; ?>" />
    <link rel="icon" type="image/png" sizes="32x32" href="./upload/logo/<?php echo $logo; ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="./upload/logo/<?php echo $logo; ?>" />
    <link rel="manifest" href="./upload/logo/<?php echo $logo; ?>" />

    <meta name="title" content="<?php echo $meta_title; ?>">
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta name="keywords" content="<?php echo $meta_keywords; ?>">
    <link rel="canonical" href="<?php echo $canonical_url;?>" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/custom-animate.css" />
    <!-- <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.pips.css" />
    <link rel="stylesheet" href="assets/vendors/odometer/odometer.min.css" />
    <link rel="stylesheet" href="assets/vendors/swiper/swiper.min.css" />
    <link rel="stylesheet" href="assets/vendors/zeinet-icons/style.css">
    <link rel="stylesheet" href="assets/vendors/zeinet-icons-two/style.css">
    <link rel="stylesheet" href="assets/vendors/tiny-slider/tiny-slider.min.css" />
    <link rel="stylesheet" href="assets/vendors/reey-font/stylesheet.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.theme.default.min.css" />
    <link rel="stylesheet" href="assets/vendors/bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-select/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="assets/vendors/vegas/vegas.min.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="assets/vendors/timepicker/timePicker.css" />

    <!--  styles -->
    <link rel="stylesheet" href="assets/css/zeinet.css" />
    <link rel="stylesheet" href="assets/css/zeinet-color-2.css" />
</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="preloader">
        <div class="preloader__image"></div>
    </div>
    <!-- /.preloader -->


    <div class="page-wrapper">
        <section class="main-header-topbar">
            <div class="main-header-topbar__right"></div>
            <div class="container">
                <div class="main-header-topbar__wrapper">
                    <ul class="main-header-topbar__info">
                        <li>
                            <span class="main-header-topbar__info__icon"><i class="zeinet-icons-two-phone"></i></span>
                            <a href="tel:<?php echo $mobile1; ?>"><?php echo $mobile1; ?></a>
                        </li>
                        <li>
                            <span class="main-header-topbar__info__icon"><i
                                    class="zeinet-icons-two-envelope"></i></span>
                            <a href="mailto:<?php echo $email1; ?>"><?php echo $email1; ?></a>
                        </li>
                        <li>
                            <span class="main-header-topbar__info__icon"><i
                                    class="zeinet-icons-two-location"></i></span>
                            <a href="#"> <?php echo $address1; ?></a>
                        </li>
                    </ul>
                    <div class="main-header-topbar__social">
                        <h5 class="main-header-topbar__social__title">Follow Us:</h5>
                        <a href="<?php echo $facebook; ?>">
                            <i class="fa-brands fa-square-facebook"></i>
                        </a>
                        <a href="<?php echo $twitter; ?>">
                            <i class="fa-brands fa-square-x-twitter"></i>
                        </a>
                        <a href="<?php echo $youtube; ?>">
                        <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="<?php echo $instagram; ?>">
                            <i class="fab fa-instagram" aria-hidden="true"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <header class="main-header-five top">
            <nav class="main-menu" style="background:linear-gradient(313deg, rgb(0 0 0 / 0%), rgb(223 221 221 / 0%)), url(assets/images/head.jpg);">
                <div class="container">
                    <div class="main-menu__wrapper clearfix">
                        <div class="main-menu__left">
                            <div class="main-menu__logo">
                                <a href="index.php"><img src="./upload/logo/<?php echo $logo; ?>" alt="" style="width:81px;"></a>
                            </div>
                        </div>
                        <div class="main-menu__main-menu-box">
                            <ul class="main-menu__list">
                                <li class="">
                                    <a href="index.php">Home</a>
                                  
                                </li>
                                <li>
                                    <a href="about.php">About</a>
                                    
                                </li>
                                <li>
                                    <a href="services.php">Services</a>
                                    
                                </li>

                                <li>
                                    <a href="news.php">News</a>
                                </li>

                                <li>
                                    <a href="gallery.php">Gallery</a>
                                </li>
                               
                                <li>
                                    <a href="contact.php">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="main-header-five__right">
                            <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                        
                            <a class="thm-btn thm-btn--two" href="tel:<?php echo $mobile1; ?>"><i class="fa fa-phone"></i> Call Now<span></span></a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="stricky-header stricked-menu main-menu main-header-five">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->