<?php include 'config/header.php'; ?>

<style>

.abt-content li::marker {
  content: "✔ ";
  color:red;
  padding:3px;
}
</style>
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
                <li>About</li>
            </ul>
            <h2>About us</h2>
        </div>
    </div>
</section>
<!--Page Header End-->

<?php 
   $sql="SELECT `page_menu`,`media`,`content` from `static_page` where `id`=4";
   $s=$conn->prepare($sql);
   $s->bind_result($about_page_head,$about_page_img,$about_page_content);
   $s->execute();
   $s->store_result();
   $s->fetch();
   $s->close();
?>


<!--About Start-->
<section class="about-six"
    style="background-image:url(assets/images/back2.jpg);background-size:cover;background-position:top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 wow slideInLeft mobile-hidden">
                <div class="about-six__image">
                    <img src="upload/static/<?php echo $about_page_img; ?>" alt="" style="width:100%;">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-six__content">
                    <div class="section-title section-title--two text-left">
                        <span class="section-title__tagline">about our company</span>
                        <h2 class="section-title__title">
                            <?php echo $about_page_head; ?>
                        </h2>
                    </div>
                    <div class="about-six__content__bar"></div>
                    <span class="abt-content">
                      <?php echo html_entity_decode($about_page_content); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
<!--About End-->





<?php include 'config/footer.php'; ?>