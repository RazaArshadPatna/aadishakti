<?php 
session_start();
include 'config/header.php'; ?>

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
                <li>Contact</li>
            </ul>
            <h2>Contact</h2>
        </div>
    </div>
</section>
<!--Page Header End-->


<?php 
   $sql="SELECT `page_menu`,`media`,`content` from `static_page` where `id`=7";
   $s=$conn->prepare($sql);
   $s->bind_result($contact_page_head,$contact_page_img,$contact_page_content);
   $s->execute();
   $s->store_result();
   $s->fetch();
   $s->close();
?>

<!--Contact Page Start-->
<section class="contact-page"
    style="background-image: linear-gradient(45deg, rgb(253 253 253 / 90%), rgb(255 255 255)), url(assets/images/contact.jpg);background-size:cover;background-position:top">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="contact-page__left">
                    <div class="section-title text-left">
                        <span class="section-title__tagline">contact with us</span>
                        <h2 class="section-title__title"><?php echo $contact_page_head; ?></h2>
                    </div>
                    <p class="contact-page__text"><?php echo html_entity_decode($contact_page_content); ?>
                    </p>
                    <ul class="list-unstyled contact-page__contact-list">
                        <li>
                            <div class="icon">
                                <span class="icon-phone-call"></span>
                            </div>
                            <div class="content">
                                <p>Have any question?</p>
                                <h4><a href="tel:<?php echo $mobile1; ?>"><?php echo $mobile1; ?></a></h4>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="icon-message"></span>
                            </div>
                            <div class="content">
                                <p>Write email</p>
                                <h4><a href="mailto:<?php echo $email1; ?>"><?php echo $email1; ?></a></h4>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="icon-placeholder"></span>
                            </div>
                            <div class="content">
                                <p>Visit anytime</p>
                                <h4><?php echo $address1; ?></h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="contact-page__right">
                    <div class="contact-page__content">
                        <div class="contact-page__content-inner">
                            <div class="contact-page-shape-1 float-bob-x">
                                <img src="assets/images/shapes/contact-page-shape-1.png" alt="">
                            </div>
                            <div class="section-title text-left">
                                <span class="section-title__tagline">contact us</span>
                                <h2 class="section-title__title">Write a message</h2>
                                <?php 
                                   if(isset($_SESSION['inquiry'])){
                                ?>
                                    <div class="alert alert-success" role="alert">
                                        Contact You Soon!
                                    </div>
                                <?php
                                  unset($_SESSION['inquiry']); }
                                ?>
                                
                            </div>
                            <form action="form-action.php" method="post" class="contact-page__form">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="contact-page__form-input-box">
                                            <input type="text" placeholder="Your name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="contact-page__form-input-box">
                                            <input type="email" placeholder="Email address" name="email">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="contact-page__form-input-box">
                                            <input type="text" placeholder="Phone number" name="phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="contact-page__form-input-box text-message-box">
                                        <textarea placeholder="Write a message" name="message"></textarea>
                                    </div>
                                    <div class="contact-page__btn-box">
                                        <button type="submit" name="submit" class="thm-btn contact-page__btn">Send a
                                            message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Contact Page End-->

<!--Google Map Start-->
<section class="google-map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3597.864720935052!2d85.13953577531804!3d25.60941111488132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ed585ea1038d43%3A0xf82ac97ce38fa54a!2sAadishakti%20Films%20Pvt.%20Ltd.!5e0!3m2!1sen!2sin!4v1734934974085!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

</section>
<!--Google Map End-->

<?php include 'config/footer.php'; ?>