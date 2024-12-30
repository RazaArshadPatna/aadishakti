<!--Site Footer Start-->
<footer class="site-footer-two site-footer-two--home-five"
    style="background-image: url(assets/images/backgrounds/footer-bg.jpg);">
    <div class="site-footer-two__shape" style="background-image: url(assets/images/shapes/footer-two-shape-1.png);">
    </div>
    <div class="container">
        <div class="site-footer-two__top" style="background-image: url(assets/images/shapes/footer-two-shape-2.png);">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                    <div class="footer-widget__column site-footer-two__about">
                        <div class="site-footer-two__about__logo">
                            <a href="index.php"><img src="./upload/logo/<?php echo $logo; ?>" alt="" style="width:91px;"></a>
                        </div>

                        <?php 
                            $sql="SELECT `content` from `static_page` where `id`=18";
                            $s=$conn->prepare($sql);
                            $s->bind_result($footer_content);
                            $s->execute();
                            $s->store_result();
                            $s->fetch();
                            $s->close();
                        ?>

                        <p class="site-footer-two__about__text">
                            <?php echo html_entity_decode($footer_content); ?><a href="about.php" style="color:#1d0f15;">Read More</a>
                        </p>
                       
                    </div>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp col-6" data-wow-delay="200ms">
                    <div class="footer-widget__column footer-widget__links clearfix">
                        <h3 class="footer-widget__title">Quick Links</h3>
                        <ul class="footer-widget__links-list list-unstyled clearfix">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About us</a></li>
                            
                            <li><a href="services.php">Our services</a></li>
                            <li><a href="gallery.php">Gallery</a></li>
                            <li><a href="news.php">Latest News</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp col-6" data-wow-delay="300ms">
                    <div class="footer-widget__column footer-widget__links clearfix">
                        <h3 class="footer-widget__title">Quick Links</h3>
                        <ul class="footer-widget__links-list list-unstyled clearfix">
                             <li><a href="contact.php">Contact Us</a></li>
                            <li><a href="privacy.php">Privacy & Policy</a></li>
                            <li><a href="terms-conditions.php">Terms & Conditions</a></li>
                            <li><a href="refund.php">Refund Policy</a></li>
                            <li><a href="#">Sitemap</a></li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                    <div class="footer-widget__column site-footer-two__mailchimp">
                        <h3 class="footer-widget__title">Our Contacts</h3>
                        <p><i class="fa-solid fa-location-dot"></i><?php echo $address1; ?></p>
                        <p><i class="fa-solid fa-phone"></i><a href="tel:<?php echo $mobile2; ?>"><?php echo $mobile2; ?></a></p>
                        <p><i class="fa-solid fa-envelope"></i><a href="mailto:<?php echo $email2; ?>"><?php echo $email2; ?></a></p>
                    </div>
                    <div class="site-footer-two__about__social mt-3">
                            <a href="<?php echo $facebook; ?>" target="_blank">
                                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                <span class="sr-only">Facebook</span>
                            </a>
                            <a href="<?php echo $twitter; ?>" target="_blank">
                            <i class="fa-brands fa-square-x-twitter"></i>
                            </a>
                            <a href="<?php echo $youtube; ?>" target="_blank">
                            <i class="fa-brands fa-youtube"></i>
                            </a>
                            <a href="<?php echo $instagram; ?>" target="_blank">
                                <i class="fab fa-instagram" aria-hidden="true"></i>
                                <span class="sr-only">Instagram</span>
                            </a>
                        </div>
                </div>
            </div>
        </div>
        <div class="site-footer-two__copyright">© All Copyright 2024 by <a href="index.php">AdiShakti</a>
        </div>
    </div>
</footer>
<!--Site Footer End-->


</div><!-- /.page-wrapper -->


<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <!-- /.mobile-nav__overlay -->
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

        <div class="logo-box">
            <a href="index.php" aria-label="logo image"><img src="./upload/logo/<?php echo $logo; ?>" width="125px" alt="" /></a>
        </div>
        <!-- /.logo-box -->
        <div class="mobile-nav__container"></div>
        <!-- /.mobile-nav__container -->

        <ul class="mobile-nav__contact list-unstyled">
            <li>
                <i class="fa fa-envelope"></i>
                <a href="mailto:<?php echo $email2; ?>"><?php echo $email2; ?></a>
            </li>
            <li>
                <i class="fa fa-phone-alt"></i>
                <a href="tel:<?php echo $mobile2; ?>"><?php echo $mobile2; ?></a>
            </li>
        </ul><!-- /.mobile-nav__contact -->
        <div class="mobile-nav__top">
            <div class="mobile-nav__social">
                <a href="<?php echo $twitter; ?>">  <i class="fa-brands fa-square-x-twitter"></i></a>
                <a href="<?php echo $facebook; ?>" class="fab fa-facebook-square"></a>
                <a href="<?php echo $youtube; ?>">   <i class="fa-brands fa-youtube"></i></a>
                <a href="<?php echo $instagram; ?>" class="fab fa-instagram"></a>
            </div><!-- /.mobile-nav__social -->
        </div><!-- /.mobile-nav__top -->



    </div>
    <!-- /.mobile-nav__content -->
</div>
<!-- /.mobile-nav__wrapper -->

<div class="search-popup">
    <div class="search-popup__overlay search-toggler"></div>
    <!-- /.search-popup__overlay -->
    <div class="search-popup__content">
        <form action="#">
            <label for="search" class="sr-only">search here</label><!-- /.sr-only -->
            <input type="text" id="search" placeholder="Search Here..." />
            <button type="submit" aria-label="search submit" class="thm-btn">
                <i class="icon-magnifying-glass"></i>
            </button>
        </form>
    </div>
    <!-- /.search-popup__content -->
</div>
<!-- /.search-popup -->

<a href="#" data-target="html" class="scroll-to-target scroll-to-target--home-five scroll-to-top"><i
        class="zeinet-icons-two-arrow-up"></i></a>


<script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendors/jarallax/jarallax.min.js"></script>
<script src="assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
<script src="assets/vendors/jquery-appear/jquery.appear.min.js"></script>
<script src="assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
<script src="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="assets/vendors/jquery-validate/jquery.validate.min.js"></script>
<script src="assets/vendors/nouislider/nouislider.min.js"></script>
<script src="assets/vendors/odometer/odometer.min.js"></script>
<script src="assets/vendors/swiper/swiper.min.js"></script>
<script src="assets/vendors/tiny-slider/tiny-slider.min.js"></script>
<script src="assets/vendors/wnumb/wNumb.min.js"></script>
<script src="assets/vendors/wow/wow.js"></script>
<script src="assets/vendors/isotope/isotope.js"></script>
<script src="assets/vendors/countdown/countdown.min.js"></script>
<script src="assets/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="assets/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="assets/vendors/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="assets/vendors/vegas/vegas.min.js"></script>
<script src="assets/vendors/jquery-ui/jquery-ui.js"></script>
<script src="assets/vendors/timepicker/timePicker.js"></script>
<script src="assets/vendors/circleType/jquery.circleType.js"></script>
<script src="assets/vendors/circleType/jquery.lettering.min.js"></script>
<!--  js -->
<script src="assets/js/zeinet.js"></script>
</body>
</html>