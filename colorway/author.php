<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
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
                <?php if (function_exists('inkthemes_breadcrumbs'))
                    inkthemes_breadcrumbs();
                ?>
            </div>
            <div class="blog" id="blogmain">
                <?php
                /* Queue the first post, that way we know who
                 * the author is when we try to get their name,
                 * URL, description, avatar, etc.
                 *
                 * We reset this later so we can run the loop
                 * properly with a call to rewind_posts().
                 */
                if (have_posts())
                    the_post();
                ?>
                <h1><?php printf(__('Author Archives: %s', 'colorway'), "<a class='url fn n' href='" . get_author_posts_url(get_the_author_meta('ID')) . "' title='" . esc_attr(get_the_author()) . "' rel='me'>" . get_the_author() . "</a>"); ?></h1>
                <?php
                // If a user has filled out their description, show a bio on their entries.
                if (get_the_author_meta('description')) :
                    ?>
                    <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('inkthemes_author_bio_avatar_size', 60)); ?>
                    <h2><?php printf('About %s' . get_the_author()); ?></h2>
                    <?php the_author_meta('description'); ?>
                <?php endif; ?>
                <?php
                /* Since we called the_post() above, we need to
                 * rewind the loop back to the beginning that way
                 * we can run the loop properly, in full.
                 */
                rewind_posts();
                /* Run the loop for the author archive page to output the authors posts
                 * If you want to overload this in a child theme then include a file
                 * called loop-author.php and that will be used instead.
                 */
                get_template_part('loop', 'author');
                ?>
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
