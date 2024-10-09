<?php
get_header(); ?>

<section class="swiper-container video-slider">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <video class="home_video" id="home_video" autoplay muted loop playsinline>
                <source src="<?php echo get_field('video_url'); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="video-overlay"></div>
        </div>
        <div class="play_pause_btn clickable-video">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/video_pause_icon.svg" width="36" height="36" alt="Pause" class="img-fluid">
        </div>
    </div>
    <!-- <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div> -->
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.play_pause_btn img').on('click', function() {
                var video = $('.home_video').get(0);
                var $icon = $(this);

                if (video.paused) {
                    video.play();
                    $icon.attr('src', '<?php echo get_stylesheet_directory_uri() ?>/images/video_pause_icon.svg');
                } else {
                    video.pause();
                    $icon.attr('src', '<?php echo get_stylesheet_directory_uri() ?>/images/video_play_icon.svg');
                }
            });
        });
    </script>
</section>

<?php
if (have_posts()) {
    while (have_posts()) : the_post();
        if (have_rows('content_blocks')) {
            $count = 1;
            while (have_rows('content_blocks')): the_row(); ?>
                <section id="content_block_<?php echo esc_attr($count); ?>" class="content_blocks_lists content_block_<?php echo esc_attr($count); ?>">
                    <?php
                        echo $sub_content_block = get_sub_field('content_block');
                    ?>
                </section><?php
                    $count++;
            endwhile;
        } else { ?>
            <div class="page_contents_section about-section">
                <div class="auto-container"><?php
                    if (get_the_content()) {
                        the_content();
                    } else {
                        echo "<h5 style='font-weight: bold'>" . esc_html__('No Contents Found.', 'text-domain') . "</h5>";
                    } ?>
                </div>
            </div><?php
        }
    endwhile;
} else {
    echo "<h3>" . esc_html__('No Contents Found.', 'text-domain') . "</h3>";
} ?>

<section class="why-choose-us-section" id="why-choose-us-section">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-6 col-sm-6 col-12 why-choose-us-left-section">
                <h2 class="text-danger">Why Choose Us</h2>
                <h3>The Perfect Blend of Care, <br />Comfort And Expertise</h3>
                <div class="col-lg-12">
                    <div class="info-box">
                        <div class="image-overlay">
                            <img src="http://localhost/pawsuniverse/wp-content/uploads/2024/10/Leading-Veterinary-Hospital-in-Ahmedabad.webp" class="img-fluid" alt="Leading Veterinary Hospital" width="590" height="310">
                            <div class="overlay-text">
                                <h4>Leading Veterinary <br />Hospital In Ahmedabad</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12 why-choose-us-right-section">
                <div class="row">
                    <div class="col-6 col-md-4">
                        <div class="emergency-box">
                            <h2>24/7</h2>
                            <p>Emergency Services</p>
                        </div>

                        <div class="stats-box">
                            <h2>50,000+</h2>
                            <p>Pets Served</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="info-box">
                            <div class="image-overlay">
                                <img src="http://localhost/pawsuniverse/wp-content/uploads/2024/10/In-House.webp" class="img-fluid" alt="In-House Pharmacy & Laboratory" width="492" height="358">
                                <div class="overlay-text">
                                    <h4>In-House <br />Pharmacy & Laboratory</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-lg-12">
                    <div class="doctor-box">
                        <img src="http://localhost/pawsuniverse/wp-content/uploads/2024/10/Specialist-Doctors.webp" class="img-fluid" alt="Specialist Doctors" width="753" height="181"/>
                        <div class="overlay">
                            <h2>150+</h2>
                            <p>Specialist <br />Doctors</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><php

<?php get_footer();
