wp-vs-webinartemplateswebinar-template.php
<?php get_header();
global $socialize; ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php if ($GLOBALS['ghostpool_page_header'] == 'gp-fullwidth-page-header' OR $GLOBALS['ghostpool_page_header'] == 'gp-full-page-page-header') {
        ghostpool_page_header(get_the_ID());
    } ?>

    <div id="gp-content-wrapper" class="gp-container">

        <?php
        if (is_webinar_announce_enabled()) {
            if (need_to_show_webinar_announce()) {
                $activated = need_to_show_webinar_button();
                ?>

                <header class="gp-page-header-vs-webinar">
                    <div class="vs-webinar-announce-box <?php echo $activated ? 'active': ''; ?>">
                        <div class="top-gradient"></div>
                        <div class="vs-webinar-meta-top">
                        <span class="vs-webinar-post-meta meta-avatar">
                                <?php echo get_webinar_announce_speaker_photo(); ?>
                        </span>
                        <span class="vs-webinar-post-meta-rows">
                            <span class="vs-webinar-post-meta-row-1">
                                <span class="meta-date"><?php echo get_webinars_announce_date_only(); ?></span>
                                <span class="meta-time"><?php echo get_webinar_announce_time_only(); ?> (по киевскому времени)</span>
                            </span>

                            <span class="vs-webinar-post-meta-row-2">
                                <span class="vs-webinar-post-meta meta-speaker">
                                    <?php echo get_webinar_announce_speaker(); ?>
                                </span>
                            </span>
                            <span class="vs-webinar-post-meta-row-3">
                              <button onclick="window.location.href='#'" style="
                                border-radius: 30px;
                                background-color: wheat;
                                color: black;
                                    ">Принять участие</button>
                            </span>
                        </span>
                        </div>

                        <img class="announce-img" src="<?php echo get_announce_image_url(); ?>">
                        <div class="announce-img-div" style='background-image: url("<?php echo get_announce_image_url(); ?>");'></div>

                        <div class="bottom-gradient"></div>
                        <div class="vs-webinar-meta-bottom">
                            <div class="title">
                                <span class="meta-webinar-name">Вебинар</span>
                                <span class="meta-topic"><?php echo get_webinar_announce_topic(); ?></span>
                            </div>
                            <?php if ($activated) : ?>
                                <div class="action">
                                    <a href="#" class='show-webinar-button'>
                                        <span class='show-webinar-text'>Смотреть трансляцию</span>
                                        <span class='show-webinar-icon'></span></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="vs-webinar-player-box <?php webinar_chat_position_css(); ?>">
                        <?php if (is_webinar_chat_enabled() && get_webinar_chat_position() === 'left') : ?>
                            <div class="vs-webinar-chat wrapper"><?php echo get_webinar_chat_shortcode(); ?></div>
                        <?php endif; ?>

                        <div class="vs-webinar-player wrapper"><?php echo get_webinar_player_code(); ?></div>

                        <?php if (is_webinar_chat_enabled()) : ?>
                            <div class="vs-webinar-chat wrapper"><?php echo get_webinar_chat_shortcode(); ?></div>
                        <?php endif; ?>
                    </div>
                </header>

                <?php
            } else {
                $webinar_ads_url = get_webinar_ads_url();
                if ($webinar_ads_url) {
                    ?>
                    <header class="gp-page-header-vs-webinar ads">
                        <div class="vs-webinar-announce-box">
                            <div class="announce-img-div" style='background-image: url("<?php echo $webinar_ads_url; ?>");'></div>
                        </div>
                    </header>
                    <?php
                }
            }
        }
        ?>

        <?php if ($GLOBALS['ghostpool_page_header'] == 'gp-large-page-header') {
            ghostpool_page_header(get_the_ID());
        } ?>

        <div id="gp-left-column">

            <div id="gp-content">

                <?php ghostpool_breadcrumbs(); ?>

                <?php if ($GLOBALS['ghostpool_title'] == 'enabled') { ?>
                    <header class="gp-entry-header">

                        <h1 class="gp-entry-title" itemprop="headline">
                            <?php if (!empty($GLOBALS['ghostpool_custom_title'])) {
                                echo esc_attr($GLOBALS['ghostpool_custom_title']);
                            } else {
                                the_title();
                            } ?>
                        </h1>

                        <?php if (!empty($GLOBALS['ghostpool_subtitle'])) { ?>
                            <h3 class="gp-subtitle"><?php echo esc_attr($GLOBALS['ghostpool_subtitle']); ?></h3>
                        <?php } ?>

                    </header>
                <?php } ?>

                <?php if (has_post_thumbnail() && $GLOBALS['ghostpool_featured_image'] == 'enabled') { ?>

                    <div class="gp-post-thumbnail gp-entry-featured">

                        <div class="<?php echo sanitize_html_class($GLOBALS['ghostpool_image_alignment']); ?>">

                            <?php $gp_image = aq_resize(wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())), $GLOBALS['ghostpool_image_width'], $GLOBALS['ghostpool_image_height'], $GLOBALS['ghostpool_hard_crop'], false, true); ?>
                            <?php if ($socialize['retina'] == 'gp-retina') {
                                $gp_retina = aq_resize(wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())), $GLOBALS['ghostpool_image_width'] * 2, $GLOBALS['ghostpool_image_height'] * 2, $GLOBALS['ghostpool_hard_crop'], true, true);
                            } else {
                                $gp_retina = '';
                            } ?>

                            <img src="<?php echo esc_url($gp_image[0]); ?>"
                                 data-rel="<?php echo esc_url($gp_retina); ?>"
                                 width="<?php echo absint($gp_image[1]); ?>"
                                 height="<?php echo absint($gp_image[2]); ?>"
                                 alt="<?php if (get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) {
                                     echo esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));
                                 } else {
                                     the_title_attribute();
                                 } ?>" class="gp-post-image"/>

                        </div>

                    </div>

                <?php } ?>

                <div class="gp-entry-content <?php if (isset($GLOBALS['ghostpool_image_alignment'])) {
                    echo sanitize_html_class($GLOBALS['ghostpool_image_alignment']);
                } ?>">

                    <div class="gp-entry-text" itemprop="text"><?php the_content(); ?></div>

                    <?php wp_link_pages('before=<div class="gp-pagination gp-pagination-numbers gp-standard-pagination gp-entry-pagination"><ul class="page-numbers">&pagelink=<span class="page-numbers">%</span>&after=</ul></div>'); ?>

                </div>

                <?php if ($socialize['page_author_info'] == 'enabled') { ?>
                    <?php get_template_part('lib/sections/author', 'info'); ?>
                <?php } ?>

            </div>

            <?php get_sidebar('left'); ?>

        </div>

        <?php get_sidebar('right'); ?>

        <div class="gp-clear"></div>

    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>