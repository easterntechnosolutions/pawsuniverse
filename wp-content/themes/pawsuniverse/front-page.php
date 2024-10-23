<?php get_header(); ?>

<section class="swiper-container-section video-slider">
    <div class="swiper-wrapper-section">
        <div class="swiper-slide-section">
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
                <div class="container"><?php
                    if (get_the_content()) {
                        the_content();
                    } else {
                        echo "<h5 style='font-weight: bold'>" . esc_html__('No Contents Found.', 'pawsuniverse') . "</h5>";
                    } ?>
                </div>
            </div><?php
        }
    endwhile;
} else {
    echo "<h3>" . esc_html__('No Contents Found.', 'pawsuniverse') . "</h3>";
} ?>

<?php get_footer();
