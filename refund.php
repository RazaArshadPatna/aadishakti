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
                <li>Refund Policy</li>
            </ul>
            <h2>Refund Policy</h2>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--About Start-->
<section class="about-six"
    style="background-image:url(assets/images/back2.jpg);background-size:cover;background-position:top">
    <div class="container">
        <div class="row">
        <?php 
            $sql="SELECT `content` from `static_page` where `id`=25";
            $s=$conn->prepare($sql);
            $s->bind_result($privacy_content);
            $s->execute();
            $s->store_result();
            $s->fetch();
            $s->close();
        ?>
            <?php echo html_entity_decode($privacy_content); ?>
        </div>
    </div>
</section>
<!--About End-->





<?php include 'config/footer.php'; ?>