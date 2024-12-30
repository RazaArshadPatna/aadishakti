<?php include 'config/header.php'; ?>
<style>

.abt-content li::marker {
  content: "✔ ";
  color:red;
  padding:3px;
}
</style>

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

    <?php 
        $j=0;
        $sql="SELECT `image` from `banner` where `status`='Publish'";
        $s=$conn->prepare($sql);
        $s->bind_result($slider_img);
        if($s->execute()){
        while(   $s->fetch()){
    ?>
        <div class="carousel-item <?php if($j==0){ echo 'active'; } ?>">
            <img src="upload/banner/<?php echo $slider_img; ?>" class="d-block w-100" alt="...">
        </div>
        <?php
       $j++; }
        }
        $s->close();
    ?>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<?php 
   $feature=array();
   $feature_con=array();
   $i=0;
   $sql="SELECT `page_menu`,`content` from `static_page` where `id` in('1','2','3')";
   $s=$conn->prepare($sql);
   $s->bind_result($feature_heading,$feature_content);
   if($s->execute()){
      $s->store_result();
      while($s->fetch()){
        $feature[$i]=$feature_heading;
        $feature_con[$i]=$feature_content;
        $i++;
      }
   }
   $s->close();
?>

<!--Feature Start-->
<section class="feature-four">
    <div class="feature-four__shape" style="background-image: url(assets/images/shapes/feature-four-bg.png);">
    </div>
    <div class="container">
        <div class="feature-four__shape-two"
            style="background-image: url(assets/images/shapes/feature-four-shape.png);"></div>
        <div class="row gutter-y-30">
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="00ms">
                <div class="feature-four__single">
                    <div class="feature-four__single__shape"
                        style="background-image: url(assets/images/shapes/feature-item-bg.png);"></div>
                    <div class="feature-four__single__icon">
                        <span class="icon-router"></span>
                    </div>
                    <h3 class="feature-four__single__title"><a href="#"><?php echo $feature[0]; ?></a>
                    </h3>
                    <p class="feature-four__single__text">
                        <?php echo strip_tags(html_entity_decode($feature_con[0])); ?>
                    </p>
                </div>
            </div>
            <!--Feature-->
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                <div class="feature-four__single">
                    <div class="feature-four__single__shape"
                        style="background-image: url(assets/images/shapes/feature-item-bg.png);"></div>
                    <div class="feature-four__single__icon">
                        <span class="zeinet-icons-two-satelite"></span>
                    </div>
                    <h3 class="feature-four__single__title"><a href="#"><?php echo $feature[1]; ?></a></h3>
                    <p class="feature-four__single__text">
                        <?php echo strip_tags(html_entity_decode($feature_con[1])); ?>
                    </p>
                </div>
            </div>
            <!--Feature-->
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                <div class="feature-four__single">
                    <div class="feature-four__single__shape"
                        style="background-image: url(assets/images/shapes/feature-item-bg.png);"></div>
                    <div class="feature-four__single__icon">
                        <span class="zeinet-icons-two-wifi-two"></span>
                    </div>
                    <h3 class="feature-four__single__title"><a href="#"><?php echo $feature[2]; ?></a></h3>
                    <p class="feature-four__single__text">
                        <?php echo strip_tags(html_entity_decode($feature_con[2])); ?>
                    </p>
                </div>
            </div>
            <!--Feature-->
        </div>
    </div>
</section>
<!--Feature End-->


<?php 
   $sql="SELECT `page_menu`,`media`,`content` from `static_page` where `id`=4";
   $s=$conn->prepare($sql);
   $s->bind_result($about_heading,$about_img,$about_content);
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
                    <img src="upload/static/<?php echo $about_img; ?>" alt="" style="width:100%;">

                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-six__content">
                    <div class="section-title section-title--two text-left">
                        <span class="section-title__tagline">about our company</span>
                        <h2 class="section-title__title">
                            <?php echo $about_heading; ?>
                        </h2>
                    </div>
                    <div class="about-six__content__bar"></div>
                    <span class="abt-content">
                        <?php echo html_entity_decode(substr($about_content,0,900)); ?>
                    </span>
                   
                    <a href="about.php" class="thm-btn thm-btn--two">More About US<span></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--About End-->

<?php 
   $sql="SELECT `page_menu`,`media`,`content` from `static_page` where `id`=5";
   $s=$conn->prepare($sql);
   $s->bind_result($newslater_head,$newslater_img,$newslater_content);
   $s->execute();
   $s->store_result();
   $s->fetch();
   $s->close();
?>

<!--newsletter-two Start-->
<section class="newsletter-two newsletter-two--home-five">
    <div class="newsletter-two__bg" style="background-image: url(assets/images/shapes/mail-bg-3.png);"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 wow fadeInLeft">
                <h4 class="newsletter-two__title"><?php echo $newslater_head; ?></h3>
            </div>
            <div class="col-md-2 wow fadeInRight">
                <form class="newsletter-two__form">

                    <a href="contact.php" class="thm-btn thm-btn--two" style="background:#7e2f00;">Contact
                        Now<span></span></a>
                </form>
            </div>
        </div>
    </div>
</section>
<!--newsletter-two End-->

<!--Service Start-->
<section class="service-five"
    style="background-image:url(assets/images/back.jpg);background-size:cover;background-position:top">
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
            <div class="col-md-4">
                <div class="service-five__btn">
                    <a href="services.php" class="thm-btn thm-btn--two">View All Services<span></span></a>
                </div>
            </div>
        </div>
        <div class="row gutter-y-30">

            <?php 
                $sql="SELECT `id`,`name`,`media`,`details` from `product` limit 4";
                $s=$conn->prepare($sql);
                $s->bind_result($id_serv,$service_name,$service_img,$service_dtl);
                if($s->execute()){
                while(   $s->fetch()){
            ?>

            <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="00ms">
                <div class="service-five__item">
                    <div class="service-five__item__thumb">
                        <img src="upload/product/<?php echo $service_img; ?>" alt="#">
                    </div>
                    <div class="service-five__item__content">
                        <div class="service-five__item__icon">
                            <div class="service-five__item__icon__inner"><i class="fa-solid fa-clapperboard"></i></div>
                        </div>
                        <h3 class="service-five__item__title"><a
                                href="service-detail.php?sid=<?php echo $id_serv; ?>"><?php echo $service_name; ?></a>
                        </h3>
                        <p class="service-five__item__text">
                            <?php echo html_entity_decode(substr($service_dtl,0,90)); ?>
                        </p>
                        <a href="service-detail.php?sid=<?php echo $id_serv; ?>" class="thm-btn thm-btn--two">View
                            Details<span></span></a>
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



<?php 
   $counter=array();
   $counter_num=array();
   $l=0;
   $sql="SELECT `page_menu`,`content` from `static_page` where `id` in('19','20','21','22')";
   $s=$conn->prepare($sql);
   $s->bind_result($counter_heading,$counter_content);
   if($s->execute()){
      $s->store_result();
      while($s->fetch()){
        $counter[$l]=array('heading'=>$counter_heading,'content'=>$counter_content);
       
        $l++;
      }
   }
   $s->close();

?>

<!--Counter Start-->
<section class="counter-four">
    <div class="container">

        <div class="row gutter-y-30">
            <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="00ms">
                <div class="counter-four__single">
                    <div class="counter-four__single__icon"><span class="zeinet-icons-two-service"></span></div>
                    <div class="counter-four__single__number">

                        <span class="odometer"
                            data-count="<?php echo strip_tags(html_entity_decode($counter[0]['content'])); ?>">00</span><span>+</span>
                    </div>
                    <p class="counter-four__single__text"><?php echo strip_tags(html_entity_decode($counter[0]['heading'])); ?></p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                <div class="counter-four__single">
                    <div class="counter-four__single__icon"><span class="zeinet-icons-two-award"></span></div>
                    <div class="counter-four__single__number">
                        <span class="odometer"
                            data-count="<?php echo strip_tags(html_entity_decode($counter[1]['content'])); ?>">00</span><span>+</span>
                    </div>
                    <p class="counter-four__single__text"><?php echo strip_tags(html_entity_decode($counter[1]['heading'])); ?></p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                <div class="counter-four__single">
                    <div class="counter-four__single__icon"><span class="zeinet-icons-two-project"></span></div>
                    <div class="counter-four__single__number">
                        <span class="odometer"
                            data-count="<?php echo strip_tags(html_entity_decode($counter[2]['content'])); ?>">00</span><span>+</span>
                    </div>
                    <p class="counter-four__single__text"><?php echo strip_tags(html_entity_decode($counter[2]['heading'])); ?></p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                <div class="counter-four__single">
                    <div class="counter-four__single__icon"><span class="zeinet-icons-two-review"></span></div>
                    <div class="counter-four__single__number">
                        <span class="odometer"
                            data-count="<?php echo strip_tags(html_entity_decode($counter[3]['content'])); ?>">00</span><span>+</span>
                    </div>
                    <p class="counter-four__single__text"><?php echo strip_tags(html_entity_decode($counter[3]['heading'])); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Counter End-->



<?php 
   $sql="SELECT `media` from `static_page` where `id`=6";
   $s=$conn->prepare($sql);
   $s->bind_result($ads_img);
   $s->execute();
   $s->store_result();
   $s->fetch();
   $s->close();
?>

<!--Brand One Start-->
<section class="brand-three brand-three--home-five" style="background-image: url(assets/images/shapes/brand-bg-2.png);">
    <div class="row">
        <img src="upload/static/<?php echo $ads_img; ?>">
    </div>
</section>
<!--Brand One End-->





<!--Testimonial Five Start-->
<section class="testimonial-five">
    <div class="container">
        <div class="section-title section-title--two text-center">
            <span class="section-title__tagline">Testimonials</span>
            <h2 class="section-title__title">
                What Our Clients Say
            </h2>
        </div>
        <div class="testimonial-five__carousel carousel-dot-style owl-carousel owl-theme thm-owl__carousel"
            data-owl-options='{
                    "loop": true,
                    "autoplay": true,
                    "margin": 30,
                    "dots": false,
                    "items": 1,
                    "smartSpeed": 500,
                    "autoplayTimeout": 10000,
                    "nav": true,
                    "navText": ["<span class=\"zeinet-icons-two-arrow-left\"></span>","<span class=\"zeinet-icons-two-arrow-right\"></span>"]
                    }'>

            <?php 
                $sql="SELECT `name`,`profession`,`img`,`content` from `testimonial`";
                $s=$conn->prepare($sql);
                $s->bind_result($test_name,$test_profession,$test_img,$test_content);
                if($s->execute()){
                while(   $s->fetch()){
            ?>
            <div class="item">
                <!--Testimonial Item Start-->
                <div class="testimonial-five__single">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="testimonial-five__single__content">
                                <div class="testimonial-five__single__bg"></div>
                                <div class="testimonial-five__single__shape-one"
                                    style="background-image: url(assets/images/shapes/testimonial-five-shape-1.png);">
                                </div>
                                <div class="testimonial-five__single__shape-two"
                                    style="background-image: url(assets/images/shapes/testimonial-five-shape-2.png);">
                                </div>
                                <h3 class="testimonial-five__title"><?php echo $test_name; ?></h3>
                                <p class="testimonial-five__designation"><?php echo $test_profession; ?></p>
                                <p class="testimonial-five__text">
                                    <?php echo strip_tags(html_entity_decode($test_content)); ?>
                                </p>

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="testimonial-five__author">
                                <img src="upload/testimonial/<?php echo $test_img; ?>" alt="#">
                            </div>
                        </div>
                    </div>
                </div>
                <!--Testimonial Item End-->
            </div>

            <?php
                }
                }
                $s->close();
            ?>


        </div>
    </div>
</section>
<!--Testimonial Five End-->

<!--Movie Start-->
<section class="movie-four movie-four--home-five" style="background-image: url(assets/images/shapes/movie-bg-2.png);">
    <div class="container">
        <div class="section-title section-title--two text-left">
            <span class="section-title__tagline">Our Videos</span>
            <h2 class="section-title__title">
                Watch Our Videos
            </h2>
        </div>
    </div>
    <div class="container movie-four__container">
        <div class="movie-four__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='{
                    "loop": true,
                    "autoplay": true,
                    "margin": 30,
                    "dots": false,
                    "smartSpeed": 500,
                    "autoplayTimeout": 10000,
                    "nav": true,
                    "navText": ["<span class=\"zeinet-icons-two-arrow-left\"></span>","<span class=\"zeinet-icons-two-arrow-right\"></span>"],
                    "responsive": {
                        "0": {
                            "items": 1
                        },
                        "768": {
                            "items": 2
                        },
                        "992": {
                            "items": 3
                        },
                        "1350": {
                            "items": 4
                        }
                    }
                    }'>

            <?php 
                $sql="SELECT `name`,`media`,`post`,`rel_date` from `our_team`";
                $s=$conn->prepare($sql);
                $s->bind_result($video_heading,$video_img,$video_link,$date);
                if($s->execute()){
                while(   $s->fetch()){
            ?>

            <div class="item">
                <div class="movie-four__single">
                    <div class="movie-four__single__img">
                        <img src="upload/team/<?php echo $video_img; ?>" alt="#">

                        <a href="<?php echo $video_link; ?>" class="video-popup">
                            <span class="zeinet-icons-two-play"></span>
                            <i class="ripple"></i>
                        </a>
                    </div>
                    <div class="movie-four__single__content">
                        <h3 class="movie-four__single__title"><a href="#"><?php echo $video_heading; ?></a></h3>
                        <p class="movie-four__single__date" style="color:white;"><?php echo date("d:F,Y", strtotime($date)); ?></p>
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
<!--Movie End-->



<!--News One Start-->
<section class="news-four"
    style="background-image:url(assets/images/back1.jpg);background-size:cover;background-position:top">
    <div class="container">
        <div class="section-title section-title--two text-center">
            <span class="section-title__tagline">News & Events</span>
            <h2 class="section-title__title">
                Our Daily News & Events
            </h2>
        </div>
        <div class="row gutter-y-30">

            <?php 
                $sql="SELECT `id`,`name`,`author`,`media`,`details` from `blog` limit 3";
                $s=$conn->prepare($sql);
                $s->bind_result($id_news,$blog_heading,$author,$blog_img,$blog_dtl);
                if($s->execute()){
                while(   $s->fetch()){
            ?>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="00ms">
                <div class="news-four__single">
                    <div class="news-four__single__img">
                        <img src="upload/blog/<?php echo $blog_img; ?>" alt="#">
                        <a href="news-details.php?id=<?php echo $id_news; ?>"><span class="icon-plus-symbol"></span></a>
                    </div>
                    <div class="news-four__single__content">
                        <ul class="news-four__single__meta list-unstyled">
                            <li><i class="far fa-user"></i><a
                                    href="news-details.php?id=<?php echo $id_news; ?>"><?php echo $author; ?></a></li>
                        </ul>
                        <h3 class="news-four__single__title"><a
                                href="news-details.php?id=<?php echo $id_news; ?>"><?php echo $blog_heading; ?></a></h3>
                        <p class="news-four__single__text">
                            <?php echo html_entity_decode(substr($blog_dtl,0,150)); ?>
                        </p>
                        <a href="news-details.php?id=<?php echo $id_news; ?>" class="thm-btn thm-btn--two">Read
                            More<span></span></a>
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
<!--News End-->

<?php include 'config/footer.php'; ?>