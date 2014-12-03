<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Colorway
 * @since Colorway 1.0
 */
get_header();
?>
<!--Start Content Grid-->
<div class="grid_24 content">
    <div class="content-wrap">
        <div class="fullwidth">
            <div class="content-info">
            <?php if (function_exists('inkthemes_breadcrumbs')) inkthemes_breadcrumbs(); ?>
            </div>
            <h1> <?php echo ('Not Found'); ?> </h1>
            <p> <?php echo ( 'Apologies, but the page you requested could not be found. Perhaps searching will help.'); ?> </p>
            <?php get_search_form(); ?>
        </div>
    </div>
</div>
<div class="clear"></div>
</div>
<?php get_footer(); ?>
