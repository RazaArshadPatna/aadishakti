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
                <li>Latest News</li>
            </ul>
            <h2>Latest News</h2>
        </div>
    </div>
</section>
<!--Page Header End-->




<!--News One Start-->
<section class="news-four" style="background-image:url(assets/images/back1.jpg);background-size:contain;background-position:top">
    <div class="container">
       
        <div class="row gutter-y-30">
        
            <?php 
                $sql="SELECT `id`,`name`,`author`,`media`,`details` from `blog` where `status`='Active'";
                $s=$conn->prepare($sql);
                $s->bind_result($news_id,$blog_heading,$author,$blog_img,$blog_dtl);
                if($s->execute()){
                while(   $s->fetch()){
            ?>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="00ms">
                <div class="news-four__single">
                    <div class="news-four__single__img">
                        <img src="upload/blog/<?php echo $blog_img; ?>" alt="#">
                        <a href="news-details.php?id=<?php echo $news_id; ?>"><span class="icon-plus-symbol"></span></a>
                    </div>
                    <div class="news-four__single__content">
                        <ul class="news-four__single__meta list-unstyled">
                            <li><i class="far fa-user"></i><a href="news-details.php?id=<?php echo $news_id; ?>"><?php echo $author; ?></a></li>
                        </ul>
                        <h3 class="news-four__single__title"><a href="news-details.php?id=<?php echo $news_id; ?>"><?php echo $blog_heading; ?></a></h3>
                        <p class="news-four__single__text">
                            <?php echo html_entity_decode(substr($blog_dtl,0,150)); ?>
                        </p>
                        <a href="news-details.php?id=<?php echo $news_id; ?>" class="thm-btn thm-btn--two">Read More<span></span></a>
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