<!--Start Footer container-->
<div class="container_24 footer-container">
    <div class="grid_24 footer">
        <?php
        /* A sidebar in the footer? Yep. You can can customize
         * your footer with four columns of widgets.
         */
        get_sidebar('footer');
        ?>
    </div>
    <div class="clear"></div>
</div>
<!--End footer container-->
<!--Start footer navigation-->
<div class="container_24 footer-navi">
    <div class="grid_24">
        <div class="grid_10 alpha">
            <div class="navigation">
                <ul class="footer_des">
                    <li><a href="<?php echo home_url(); ?>"><?php echo get_bloginfo('name'); ?> -
                            <?php bloginfo('description'); ?>
                        </a></li>
                </ul>                
            </div>
        </div>
        <div class="grid_14 omega">
            <div class="right-navi">
                <?php if (inkthemes_get_option('colorway_twitter') != '') { ?>
                    <a href="<?php echo inkthemes_get_option('colorway_twitter'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter-icon.png" alt="twitter" title="Twitter"/></a>
                <?php } else { ?>
                <?php } ?>
                <?php if (inkthemes_get_option('colorway_facebook') != '') { ?>
                    <a href="<?php echo inkthemes_get_option('colorway_facebook'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook-icon.png" alt="facebook" title="facebook"/></a>
                <?php } else { ?>
                <?php } ?>
                <?php if (inkthemes_get_option('colorway_rss') != '') { ?>
                    <a href="<?php echo inkthemes_get_option('colorway_rss'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/rss-icon.png" alt="rss" title="rss"/></a>
                <?php } else { ?>
                <?php } ?>
                <?php if (inkthemes_get_option('colorway_linkedin') != '') { ?>
                    <a href="<?php echo inkthemes_get_option('colorway_linkedin'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linked.png" alt="linkedin" title="linkedin"/></a>
                <?php } else { ?>
                <?php } ?>
                <?php if (inkthemes_get_option('colorway_stumble') != '') { ?>
                    <a href="<?php echo inkthemes_get_option('colorway_stumble'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/stumbleupon.png" alt="stumble" title="stumble"/></a>
                <?php } else { ?>
                <?php } ?>
                <?php if (inkthemes_get_option('colorway_digg') != '') { ?>
                    <a href="<?php echo inkthemes_get_option('colorway_digg'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/digg.png" alt="digg" title="digg"/></a>
                <?php } else { ?>
                <?php } ?>
                <p><a href="<?php echo esc_url('http://www.inkthemes.com'); ?>"><?php _e('Colorway Wordpress Theme</a> by InkThemes.com', 'colorway'); ?></p>
            </div> 
        </div>
    </div>
    <div class="clear"></div>
</div>
<!--End Footer navigation-->
<div class="footer_space"></div>
<?php wp_footer(); ?>
</body></html>