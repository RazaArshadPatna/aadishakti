<?php include 'config/header.php'; ?>

<!--Page Header Start-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url(assets/images/backgrounds/page-header-bg1.jpg)"></div>
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
                <li><a href="news.php">News</a></li>
                <li><span>//</span></li>
                <li>News details</li>
            </ul>
            <h2>News details</h2>
        </div>
    </div>
</section>
<!--Page Header End-->

<?php 
if(isset($_GET['id'])){
    
    $id=$_GET['id'];

    $sql="SELECT `name`,`author`,`media`,`details` from `blog` where `id`=?";
    $s=$conn->prepare($sql);
    $s->bind_param("s",$id);
    $s->bind_result($news_heading,$news_author,$news_img,$news_dtl);
    $s->execute();
    $s->store_result();
    $s->fetch();
    $s->close();
}
else{ ?>

<script>
    window.location.href="index.php";
</script>

<?php }  ?>

<!--News Details Start-->
<section class="news-details" style="background:linear-gradient(45deg, rgb(255 255 255 / 97%), rgb(255 255 255 / 93%)), url(assets/images/div.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="news-details__left">
                    <div class="news-details__img">
                        <img src="upload/blog/<?php echo $news_img; ?>" alt="">
                        <div class="news-details__date">
                            <!-- <p>18 may</p> -->
                        </div>
                    </div>
                    <div class="news-details__content">
                        <ul class="list-unstyled news-details__meta">
                            <li><a href="#"><i class="fas fa-user-circle"></i><?php echo$news_author; ?></a>
                            </li>

                        </ul>
                        <h3 class="news-details__title"><?php echo $news_heading; ?></h3>
                        <?php echo html_entity_decode($news_dtl); ?>
                    </div>


                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="sidebar">
                    
                    <div class="sidebar__single sidebar__post">
                        <h3 class="sidebar__title">Latest News</h3>
                        <ul class="sidebar__post-list list-unstyled">

                        <?php 
                            $sql="SELECT `id`,`name`,`author`,`media`,`details` from `blog` where `status`='Active' limit 3";
                            $s=$conn->prepare($sql);
                            $s->bind_result($id_side,$blog_heading,$author,$blog_img,$blog_dtl);
                            if($s->execute()){
                            while(   $s->fetch()){
                        ?>

                            <li style="background:aliceblue;">
                                <div class="sidebar__post-image">
                                    <img src="upload/blog/<?php echo $blog_img; ?>" alt="">
                                </div>
                                <div class="sidebar__post-content">
                                    <h3>
                                        <a href="news-details.php?id=<?php echo $id_side; ?>"><?php echo $blog_heading; ?></a>
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




                </div>
            </div>
        </div>
    </div>
</section>
<!--News Details End-->

<?php include 'config/footer.php'; ?>