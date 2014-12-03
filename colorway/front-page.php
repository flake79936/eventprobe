<?php
/*
  /**
 * The main front page file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
?>
<?php get_header(); ?>
<!--Start Slider-->
<div class="grid_24 slider">
    <div class="slider-container">
        <div id="slides">
            <div id="slide-box">
                <div class="slides_container col-full slide-fix" >
                    <div class="slide slide-1" >
                        <div class="slide-content entry fl">
                            <?php if (inkthemes_get_option('colorway_slideheading1') != '') { ?>
                                <h2 class="title"><a href="<?php echo inkthemes_get_option('colorway_slidelink1'); ?>"><?php echo inkthemes_get_option('colorway_slideheading1'); ?></a></h2>
                            <?php } else { ?>
                                <h2 class="title"><a href="#"><?php _e('Beauty at its best','colorway'); ?></a></h2>
                            <?php } ?> 
                            <?php if (inkthemes_get_option('colorway_slidedescription1') != '') { ?>
                                <p><?php echo inkthemes_get_option('colorway_slidedescription1'); ?></p>
                            <?php } else { ?>
                                <p><?php _e('What happens when beauty and simplicity connects. We tried to give you a slight hint of that with the Colorway Theme.','colroway'); ?></p>
                            <?php } ?>
                        </div>
                        <!-- /.slide-content -->
                        <?php if (inkthemes_get_option('colorway_slideimage1') != '') { ?>
                            <div class="slide-image fl"><img  src="<?php echo inkthemes_get_option('colorway_slideimage1'); ?>" class="slide-img" alt="Slide 1"/> </div>
                        <?php } else { ?>
                            <div class="slide-image fl"><img  src="<?php echo get_template_directory_uri(); ?>/images/slider.jpg" class="slide-img" alt="Slide 1"/> </div>
                        <?php } ?>
                        <!-- /.slide-image -->
                        <div class="fix"></div>
                    </div>         
                </div>
                <!-- /.slides_container -->
            </div>
            <!-- /#slide-box -->
        </div>
        <!-- /#slides -->
    </div>
</div>
<div class="clear"></div>
<!--End Slider-->
<!--Start Content Grid-->
<div class="grid_24 content">
    <div class="content-wrapper">
        <div class="content-info home">
            <h2>
                <center>
                    <?php if (inkthemes_get_option('inkthemes_mainheading') != '') { ?>
                        <?php echo inkthemes_get_option('inkthemes_mainheading'); ?>
                    <?php } else { ?>
                        <?php _e('Design is not just what it looks like and feels like. Design is how it works.','colorway'); ?>
                    <?php } ?>
                </center>
            </h2>
        </div>
				<div class="clear"></div>
        <div  id="content">
            <div class="columns">
                <div class="one_fourth"> <a href="<?php echo inkthemes_get_option('inkthemes_link1'); ?>" class="bigthumbs">
                        <?php if (inkthemes_get_option('inkthemes_fimg1') != '') { ?>
                            <img src="<?php echo inkthemes_get_option('inkthemes_fimg1'); ?>"/>
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/1.jpg"/>
                        <?php } ?>
                    </a>
                    <?php if (inkthemes_get_option('inkthemes_headline1') != '') { ?>
                        <h2><a href="<?php echo inkthemes_get_option('inkthemes_link1'); ?>"><?php echo inkthemes_get_option('inkthemes_headline1'); ?></a></h2>
                    <?php } else { ?>
                        <h2><a href="#"><?php _e('Power of Easiness','colorway'); ?></a></h2>
                    <?php } ?>
                    <?php if (inkthemes_get_option('inkthemes_feature1') != '') { ?>
                        <p><?php echo inkthemes_get_option('inkthemes_feature1'); ?></p>
                    <?php } else { ?>
                        <p><?php _e('This Colorway Wordpress Theme gives you the easiness of building your site without any coding skills required.','colorway'); ?></p>
                    <?php } ?>
                </div>
                <div class="one_fourth middle"> <a href="<?php echo inkthemes_get_option('inkthemes_link2'); ?>" class="bigthumbs">
                        <?php if (inkthemes_get_option('inkthemes_fimg2') != '') { ?>
                            <img src="<?php echo inkthemes_get_option('inkthemes_fimg2'); ?>"/>
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/2.jpg"/>
                        <?php } ?>
                    </a>
                    <?php if (inkthemes_get_option('inkthemes_headline2') != '') { ?>
                        <h2><a href="<?php echo inkthemes_get_option('inkthemes_link2'); ?>"><?php echo inkthemes_get_option('inkthemes_headline2'); ?></a></h2>
                    <?php } else { ?>
                        <h2><a href="#"><?php _e('Power of Speed','colorway'); ?></a></h2>
                    <?php } ?>
                    <?php if (inkthemes_get_option('inkthemes_feature2') != '') { ?>
                        <p><?php echo inkthemes_get_option('inkthemes_feature2'); ?></p>
                    <?php } else { ?>
                        <p><?php _e('The Colorway Wordpress Theme is highly optimized for Speed. So that your website opens faster than any similar themes.','colorway'); ?></p>
                    <?php } ?>
                </div>
                <div class="one_fourth"> <a href="<?php echo inkthemes_get_option('inkthemes_link3'); ?>" class="bigthumbs">
                        <?php if (inkthemes_get_option('inkthemes_fimg3') != '') { ?>
                            <img src="<?php echo inkthemes_get_option('inkthemes_fimg3'); ?>"/>
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/3.jpg"/>
                        <?php } ?>
                    </a>
                    <?php if (inkthemes_get_option('inkthemes_headline3') != '') { ?>
                        <h2><a href="<?php echo inkthemes_get_option('inkthemes_link3'); ?>"><?php echo inkthemes_get_option('inkthemes_headline3'); ?></a></h2>
                    <?php } else { ?>
                        <h2><a href="#"><?php _e('Power of SEO','colorway'); ?></a></h2>
                    <?php } ?>
                    <?php if (inkthemes_get_option('inkthemes_feature3') != '') { ?>
                        <p><?php echo inkthemes_get_option('inkthemes_feature3'); ?></p>
                    <?php } else { ?>
                        <p><?php _e('Visitors to the Website are very highly desirable. With the SEO Optimized Themes, You get more traffic from Google.','colorway'); ?></p>
                    <?php } ?>
                </div>
                <div class="one_fourth last"> <a href="<?php echo inkthemes_get_option('inkthemes_link4'); ?>" class="bigthumbs">
                        <?php if (inkthemes_get_option('inkthemes_fimg4') != '') { ?>
                            <img src="<?php echo inkthemes_get_option('inkthemes_fimg4'); ?>"/>
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/4.jpg"/>
                        <?php } ?>
                    </a>
                    <?php if (inkthemes_get_option('inkthemes_headline4') != '') { ?>
                        <h2><a href="<?php echo inkthemes_get_option('inkthemes_link4'); ?>"><?php echo inkthemes_get_option('inkthemes_headline4'); ?></a></h2>
                    <?php } else { ?>
                        <h2><a href="#"><?php _e('Ready Contact Form','colorway'); ?></a></h2>
                    <?php } ?>
                    <?php if (inkthemes_get_option('inkthemes_feature4') != '') { ?>
                        <p><?php echo inkthemes_get_option('inkthemes_feature4'); ?></p>
                    <?php } else { ?>
                        <p><?php _e('Let your visitors easily contact you. The builtin readymade contact form makes it easier for clients to contact.','colorway'); ?></p>
                    <?php } ?>
                </div>
            </div>            
        </div>        
		<div class="clear"></div>
		<div class="home_page_blog">
		<div class="grid_16 alpha">
        <div class="content-wrap home">
		<?php if (inkthemes_get_option('inkthemes_blog_head') != '') { ?>
                <h1 class="blog_head"><?php echo stripslashes(inkthemes_get_option('inkthemes_blog_head')); ?></h1>
            <?php } else { ?>
                <h1 class="blog_head"><?php _e('From The Blog', 'colorway'); ?></h1>
            <?php } ?> 
            <div class="blog" id="blogmain">
                <ul class="blog_post">
			<!-- Start the Loop. -->
			 <?php query_posts('posts_per_page=3'); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('post_thumbnail', array('class' => 'postimg')); ?>
                    </a>
                    <?php
                } else {
                    echo inkthemes_main_image();
                }
                ?>
                <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                <?php echo inkthemes_custom_trim_excerpt(25); ?>
                <a href="<?php the_permalink() ?>">Continue Reading...</a> </li>
            <!-- End the Loop. -->
        <?php endwhile;
            else: ?>
        <li>
            <p> <?php echo ('Sorry, no posts matched your criteria.'); ?> </p>
        </li>
		<?php endif; ?>
		</ul>
            </div>
        </div>
    </div>
	<div class="grid_8 omega">
	<?php if (is_active_sidebar('home-page-right-feature-widget-area')) : ?>
        <div class="sidebar home">
            <?php dynamic_sidebar('home-page-right-feature-widget-area'); ?>
			</div>
			<?php else : ?>
			 <div class="sidebar home">
             <img class="widget_img" src="<?php echo get_template_directory_uri(); ?>/images/widget-area.png" />
			</div>
        <?php endif; ?>
		</div>
		</div>
		<div class="clear"></div>
		<?php if (inkthemes_get_option('inkthemes_testimonial') != '') { ?>
            <blockquote class="home_blockquote"><?php echo inkthemes_get_option('inkthemes_testimonial'); ?></blockquote>
        <?php } else { ?>
            <blockquote class="home_blockquote"><?php _e('Theme from InkThemes.com are based on P3+ Technology, giving high speed, easiness to built &amp; power of SEO for lending trustworthiness and experience to a customer. The Themes are really one of the best we saw everywhere.<br />
                Neeraj Agarwal','colorway'); ?></blockquote>
        <?php } ?>
    </div>
			<div class="clear"></div>
</div>
<div class="clear"></div>
<!--End Content Grid-->
</div>
<!--End Container Div-->
<?php get_footer(); ?>
