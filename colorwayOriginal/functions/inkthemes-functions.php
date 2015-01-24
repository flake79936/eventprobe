<?php
ob_start();

function inkthemes_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('post-thumbnails');
    add_image_size('post_thumbnail', 250, 160, true);
    add_theme_support('custom-background', array(
        // Background color default
        'default-color' => '000',
        // Background image default
        'default-image' => get_template_directory_uri() . '/images/body-bg.png'
    ));
    add_theme_support('custom-background', array(
        'default-image' => 'e6e6e6',
    ));
}

add_action('after_setup_theme', 'inkthemes_setup');
/* ----------------------------------------------------------------------------------- */
/* Auto Feed Links Support
  /*----------------------------------------------------------------------------------- */
if (function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links');
}
/* ----------------------------------------------------------------------------------- */
/* Custom Menus Function
  /*----------------------------------------------------------------------------------- */

// Add CLASS attributes to the first <ul> occurence in wp_page_menu
function inkthemes_add_menuclass($ulclass) {
    return preg_replace('/<ul>/', '<ul class="ddsmoothmenu">', $ulclass, 1);
}

add_filter('wp_page_menu', 'inkthemes_add_menuclass');
add_action('init', 'inkthemes_register_custom_menu');

function inkthemes_register_custom_menu() {
    register_nav_menu('custom_menu', 'Main Menu');
}

function inkthemes_nav() {
    if (function_exists('wp_nav_menu'))
        wp_nav_menu(array('theme_location' => 'custom_menu', 'container_id' => 'menu', 'menu_class' => 'sf-menu', 'fallback_cb' => 'inkthemes_nav_fallback'));
    else
        inkthemes_nav_fallback();
}

function inkthemes_nav_fallback() {
    ?>
    <div id="menu">
        <ul class="sf-menu">
            <?php
            wp_list_pages('title_li=&show_home=1&sort_column=menu_order');
            ?>
        </ul>
    </div>
    <?php
}

function inkthemes_new_nav_menu_items($items) {
    if (is_home()) {
        $homelink = '<li class="current_page_item">' . '<a href="' . home_url('/') . '">' . 'Home' . '</a></li>';
    } else {
        $homelink = '<li>' . '<a href="' . home_url('/') . '">' . 'Home' . '</a></li>';
    }
    $items = $homelink . $items;
    return $items;
}

add_filter('wp_list_pages', 'inkthemes_new_nav_menu_items');
/* ----------------------------------------------------------------------------------- */
/* Breadcrumbs Plugin
  /*----------------------------------------------------------------------------------- */

function inkthemes_breadcrumbs() {
    $delimiter = '&raquo;';
    $home = 'Home'; // text for the 'Home' link
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb
    echo '<div id="crumbs">';
    global $post;
    $homeLink = home_url();
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
    } elseif (is_day()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $before . get_the_title() . $after;
        }
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        //$cat = get_the_category($parent->ID); $cat = $cat[0];
        //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . get_the_title() . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_search()) {
        echo $before . 'Search results for "' . get_search_query() . '"' . $after;
    } elseif (is_tag()) {
        echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . 'Articles posted by ' . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . 'Error 404' . $after;
    }

    if (get_query_var('paged')) {
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ' (';
        echo 'Page' . ' ' . get_query_var('paged');
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ')';
    }

    echo '</div>';
}

/* ----------------------------------------------------------------------------------- */
/* Function to call first uploaded image in functions file
  /*----------------------------------------------------------------------------------- */

function inkthemes_main_image() {
    global $post, $posts;
    //This is required to set to Null
    $id = '';
    $the_title = '';
    // Till Here
    $permalink = get_permalink($id);
    $homeLink = get_template_directory_uri();
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (isset($matches [1] [0])) {
        $first_img = $matches [1] [0];
    }
    if (empty($first_img)) { //Defines a default image  
    } else {
        print "<a href='$permalink'><img src='$first_img' width='250px' height='160px' class='postimg wp-post-image' alt='$the_title' /></a>";
    }
}

if (!function_exists('inkthemes_comment')) :

    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own inkthemes_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function inkthemes_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case '' :
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div id="comment-<?php comment_ID(); ?>">
                        <div class="comment-author vcard"> <?php echo get_avatar($comment, 40); ?> <?php printf('%s <span class="says">says:</span>' . sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?> </div>
                        <!-- .comment-author .vcard -->
                        <?php if ($comment->comment_approved == '0') : ?>
                            <em> <?php echo ('Your comment is awaiting moderation.'); ?> </em> <br />
                                <?php endif; ?>
                        <div class="comment-meta commentmetadata"><a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                <?php
                                /* translators: 1: date, 2: time */
                                printf('%1$s at %2$s' . get_comment_date(), get_comment_time());
                                ?>
                            </a>
                            <?php edit_comment_link('(Edit)', ' ');
                            ?>
                        </div>
                        <!-- .comment-meta .commentmetadata -->
                        <div class="comment-body">
                <?php comment_text(); ?>
                        </div>
                        <div class="reply">
                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </div>
                        <!-- .reply -->
                    </div>
                    <!-- #comment-##  -->
                    <?php
                    break;
                case 'pingback' :
                case 'trackback' :
                    ?>
                <li class="post pingback">
                    <p> <?php echo ('Pingback:'); ?>
                        <?php comment_author_link(); ?>
                    <?php edit_comment_link('(Edit)', ' '); ?>
                    </p>
                    <?php
                    break;
            endswitch;
        }

    endif;

    /**
     * Set the content width based on the theme's design and stylesheet.
     *
     * Used to set the width of images and content. Should be equal to the width the theme
     * is designed for, generally via the style.css stylesheet.
     */
    if (!isset($content_width))
        $content_width = 590;

    /**
     * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
     *
     * To override inkthemes_widgets_init() in a child theme, remove the action hook and add your own
     * function tied to the init hook.
     * @uses register_sidebar
     */
    function inkthemes_widgets_init() {
        // Area 1, located at the top of the sidebar.
        register_sidebar(array(
            'name' => 'Primary Widget Area',
            'id' => 'primary-widget-area',
            'description' => 'The primary widget area',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
        // Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
        register_sidebar(array(
            'name' => 'Secondary Widget Area',
            'id' => 'secondary-widget-area',
            'description' => 'The secondary widget area',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
        // Area 3, located in the footer. Empty by default.
        register_sidebar(array(
            'name' => 'First Footer Widget Area',
            'id' => 'first-footer-widget-area',
            'description' => 'The first footer widget area',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h4>',
            'after_title' => '</h4>',
        ));
        // Area 4, located in the footer. Empty by default.
        register_sidebar(array(
            'name' => 'Second Footer Widget Area',
            'id' => 'second-footer-widget-area',
            'description' => 'The second footer widget area',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h4>',
            'after_title' => '</h4>',
        ));
        // Area 5, located in the footer. Empty by default.
        register_sidebar(array(
            'name' => 'Third Footer Widget Area',
            'id' => 'third-footer-widget-area',
            'description' => 'The third footer widget area',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h4>',
            'after_title' => '</h4>',
        ));
        // Area 6, located in the footer. Empty by default.
        register_sidebar(array(
            'name' => 'Fourth Footer Widget Area',
            'id' => 'fourth-footer-widget-area',
            'description' => 'The fourth footer widget area',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h4>',
            'after_title' => '</h4>',
        ));
		// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
			 register_sidebar(array(
			'name' => __('Home Page Right Feature Widget Area', 'colorway'),
			'id' => 'home-page-right-feature-widget-area',
			'description' => __('The Home Page Right Feature widget area', 'colorway'),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		));
    }

    /** Register sidebars by running inkthemes_widgets_init() on the widgets_init hook. */
    add_action('widgets_init', 'inkthemes_widgets_init');

    /**
     * Display navigation to next/previous pages when applicable
     */
    function inkthemes_content_nav($nav_id) {
        global $wp_query;
        if ($wp_query->max_num_pages > 1) :
            ?>
            <nav id="<?php echo $nav_id; ?>">
                <h3 class="assistive-text"><?php echo ( 'Post navigation'); ?></h3>
                <div class="nav-next">
        <?php previous_posts_link('Newer posts <span class="meta-nav">&rarr;</span>'); ?>
                </div>
                <div class="nav-previous">
        <?php next_posts_link('<span class="meta-nav">&larr;</span> Older posts'); ?>
                </div>  
            </nav>
            <!-- #nav-above -->
            <?php
        endif;
    }

    /**
     * Pagination
     *
     */
    function inkthemes_pagination($pages = '', $range = 2) {
        $showitems = ($range * 2) + 1;
        global $paged;
        if (empty($paged))
            $paged = 1;
        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages) {
                $pages = 1;
            }
        }
        if (1 != $pages) {
            echo "<ul class='paging'>";
            if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
                echo "<li><a href='" . get_pagenum_link(1) . "'>&laquo;</a></li>";
            if ($paged > 1 && $showitems < $pages)
                echo "<li><a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a></li>";
            for ($i = 1; $i <= $pages; $i++) {
                if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
                    echo ($paged == $i) ? "<li><a href='" . get_pagenum_link($i) . "' class='current' >" . $i . "</a></li>" : "<li><a href='" . get_pagenum_link($i) . "' class='inactive' >" . $i . "</a></li>";
                }
            }
            if ($paged < $pages && $showitems < $pages)
                echo "<li><a href='" . get_pagenum_link($paged + 1) . "'>&rsaquo;</a></li>";
            if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
                echo "<li><a href='" . get_pagenum_link($pages) . "'>&raquo;</a></li>";
            echo "</ul>\n";
        }
    }

/////////Theme Options
    /* ----------------------------------------------------------------------------------- */
    /* Add Favicon
      /*----------------------------------------------------------------------------------- */
    function inkthemes_childtheme_favicon() {
        if (inkthemes_get_option('colorway_favicon') != '') {
            echo '<link rel="shortcut icon" href="' . inkthemes_get_option('colorway_favicon') . '"/>' . "\n";
        } else {
            ?>
            <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" />
            <?php
        }
    }

    add_action('wp_head', 'inkthemes_childtheme_favicon');
    /* ----------------------------------------------------------------------------------- */
    /* Show analytics code in footer */
    /* ----------------------------------------------------------------------------------- */

    function inkthemes_analytics() {
        $shortname = inkthemes_get_option('of_shortname');
        $output = inkthemes_get_option($shortname . 'colorway_analytics');
        if ($output <> "")
            echo "<script type='text/javascript'>" . stripslashes($output) . "</script>\n";
    }

    add_action('wp_footer', 'inkthemes_analytics');
    /* ----------------------------------------------------------------------------------- */
    /* Custom CSS Styles */
    /* ----------------------------------------------------------------------------------- */

    function inkthemes_of_head_css() {
        $output = '';
        $custom_css = inkthemes_get_option('inkthemes_customcss');
        if ($custom_css <> '') {
            $output .= $custom_css . "\n";
        }
// Output styles
        if ($output <> '') {
            $output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
            echo $output;
        }
    }

    add_action('wp_head', 'inkthemes_of_head_css');

//Green color style
    function inkthemes_green_css() {
        ?>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . '/css/green.css'; ?>" />
        <?php
    }
    add_action('wp_head', 'inkthemes_green_css');
	//Trim excerpt
function inkthemes_custom_trim_excerpt($length) {
    global $post;
    $explicit_excerpt = $post->post_excerpt;
    if ('' == $explicit_excerpt) {
        $text = get_the_content('');
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
    } else {
        $text = apply_filters('the_content', $explicit_excerpt);
    }
    $text = strip_shortcodes($text); // optional
    $text = strip_tags($text);
    $excerpt_length = $length;
    $words = explode(' ', $text, $excerpt_length + 1);
    if (count($words) > $excerpt_length) {
        array_pop($words);
        array_push($words, '[&hellip;]');
        $text = implode(' ', $words);
        $text = apply_filters('the_excerpt', $text);
    }
    return $text;
}
    ob_clean();