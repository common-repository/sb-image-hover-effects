<div class="sa-el-learn-dash-course sa-el-course-layout-3 card-style">
    <div class="sa-el-learn-dash-course-inner">
        <?php if($image): ?>
        <a class="card-thumb" href="<?php echo esc_url(get_permalink($course->ID)); ?>">
            <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo $image_alt; ?>" />
        </a>
        <?php endif; ?>

        <?php if($settings['show_price'] == 'true') : ?>
            <div class="card-price"><?php echo $legacy_meta['sfwd-courses_course_price'] ? $legacy_meta['sfwd-courses_course_price'] : __('Free', SA_EL_ADDONS_TEXTDOMAIN); ?></div>
        <?php endif; ?>
        <div class="card-body">

            <<?php echo $settings['title_tag']; ?> class="course-card-title">
            <a href="<?php echo esc_url(get_permalink($course->ID)); ?>"><?php echo $course->post_title; ?></a>
            </<?php echo $settings['title_tag']; ?>>

            <?php if($settings['show_course_meta'] === 'true') : ?>
            <div class="sa-el-learn-dash-course-meta-card">
<?php if($access_list) : ?><span class="enrolled-count"><i class="far fa-user" aria-hidden="true"></i><?php echo $access_list; ?></span><?php endif; ?>
                <span class="course-date"><i class="far fa-clock" aria-hidden="true"></i><?php echo get_the_date('j M y', $course->ID); ?></span>
            </div>
            <?php endif; ?>

            <?php if($settings['show_content'] === 'true') : ?> 
            <div class="sa-el-learn-dash-course-short-desc">
                <?php echo wpautop($this->get_controlled_short_desc($short_desc, $excerpt_length)); ?>
            </div><?php endif; ?>

            <?php
                if($settings['show_progress_bar'] === 'true') {
                    echo do_shortcode( '[learndash_course_progress course_id="' . $course->ID . '" user_id="' . get_current_user_id() . '"]' );
                }
            ?>

            <?php if($settings['show_button'] === 'true') : ?>
                <div class="layout-button-wrap">
                    <a href="<?php echo esc_url(get_permalink($course->ID)); ?>" class="sa-el-course-button"><?php echo empty($button_text) ? __( 'See More', SA_EL_ADDONS_TEXTDOMAIN ) : $button_text; ?></a>
                </div>
            <?php endif; ?>
        </div>

        

    </div>
</div>