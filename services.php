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
                <li>Services</li>
            </ul>
            <h2>Services</h2>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--Service Start-->
<section class="service-five" style="background-image:url(assets/images/back.jpg);background-size:cover;background-position:top">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="section-title section-title--two text-left">
                    <span class="section-title__tagline">OUR SERVICES</span>
                    <h2 class="section-title__title">
                        Services We Provide
                    </h2>
                </div>
            </div>
            
        </div>
        <div class="row gutter-y-30">

            <?php 
                $sql="SELECT `id`,`name`,`media`,`details` from `product`";
                $s=$conn->prepare($sql);
                $s->bind_result($id,$service_name,$service_img,$service_dtl);
                if($s->execute()){
                while(   $s->fetch()){
            ?>

            <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="00ms">
                <div class="service-five__item">
                    <div class="service-five__item__thumb">
                        <img src="upload/product/<?php echo $service_img; ?>" alt="zeinet">
                    </div>
                    <div class="service-five__item__content">
                        <div class="service-five__item__icon">
                            <div class="service-five__item__icon__inner"><i class="fa-solid fa-clapperboard"></i></div>
                        </div>
                        <h3 class="service-five__item__title"><a href="service-detail.php?sid=<?php echo $id; ?>"><?php echo $service_name; ?></a></h3>
                        <p class="service-five__item__text">
                             <?php echo html_entity_decode(substr($service_dtl,0,80)); ?>
                        </p>
                        <a href="service-detail.php?sid=<?php echo $id; ?>" class="thm-btn thm-btn--two">View Details<span></span></a>
                        <div class="service-five__item__shape"></div>
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
<!--Service End-->





<?php include 'config/footer.php'; ?>