<?php
/**
 * The main template file.
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
<!--Start Content Grid-->
<div class="grid_24 content">
    <div class="grid_16 alpha">
        <div class="content-wrap">
            <div class="content-info">
                <?php if (function_exists('inkthemes_breadcrumbs')) inkthemes_breadcrumbs(); ?>
            </div>
            <div class="blog" id="blogmain">
                <?php get_template_part('loop', 'index'); ?>
            </div>
            <?php inkthemes_content_nav('nav-below'); ?>
        </div>
    </div>
    <?php get_sidebar(); ?>
</div>
<div class="clear"></div>
<!--End Content Grid-->
</div>
<!--End Container Div-->
<?php get_footer(); ?>
