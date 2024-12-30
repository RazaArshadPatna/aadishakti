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
                <li>Gallery</li>
            </ul>
            <h2>Gallery</h2>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--Gallery Page Start-->
<section class="gallery-page" style="background-image:url(assets/images/back1.jpg);background-size:contain;background-position:top">
    <div class="container">
        <div class="row">

        <?php 
            $sql="SELECT `image` from `manage_gallery` where `status`=1";
            $s=$conn->prepare($sql);
            $s->bind_result($gallery_img);
            if($s->execute()){
            while(   $s->fetch()){
        ?>
            <div class="col-xl-4 col-lg-6 col-md-6 col-6 wow fadeInUp" data-wow-delay="100ms">
                <div class="gallery-page__single">
                    <div class="gallery-page__img">
                        <img src="upload/gallery/<?php echo $gallery_img; ?>" alt="">
                        <div class="gallery-page__icon">
                            <a class="img-popup" href="upload/gallery/<?php echo $gallery_img; ?>"><span
                                    class="icon-plus-symbol"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php
            }
            }
            $s->close();
        ?>
                    
        </div>
    </div>
</section>
<!--Gallery Page End-->


<?php include 'config/footer.php'; ?>