<?php
/*
  Template Name: Blog Page
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
                <ul class="blog_post">
                    <?php
                    $limit = get_option('posts_per_page');
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    query_posts('showposts=' . $limit . '&paged=' . $paged);
                    $wp_query->is_archive = true;
                    $wp_query->is_home = false;
                    ?>
                    <!-- Start the Loop. -->
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
                                <?php
                                printf(
                                        _x('Posted on %1$s by %2$s in %3$s.', 'Time, Author, Category', 'colorway'), get_the_time(get_option('date_format')), get_the_author(), get_the_category_list(', ')
                                );
                                ?>
                                <?php the_excerpt(); ?>
                                <div class="clear"></div>
                                <div class="tags">
                                    <?php the_tags('Post Tagged with ', ', ', ''); ?>
                                </div>
                                <div class="clear"></div>
                                <?php comments_popup_link('No Comments.', '1 Comment.', '% Comments.'); ?>
                                <div class="clear"></div>
                                <a href="<?php the_permalink() ?>"><?php _e('Continue Reading...', 'colorway'); ?></a> </li>
                            <!-- End the Loop. -->
                        <?php endwhile;
                    else:
                        ?>
                        <li>
                            <p> <?php echo ('Sorry, no posts matched your criteria.'); ?> </p>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php inkthemes_pagination(); ?>
        </div>
    </div>
<?php get_sidebar(); ?>
</div>
<div class="clear"></div>
<!--End Content Grid-->
</div>
<!--End Container Div-->
<?php get_footer(); ?>
