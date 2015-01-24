<?php
ob_start();
include_once get_template_directory() . '/functions/inkthemes-functions.php';
if (!function_exists('optionsframework_init')) {
    /* ----------------------------------------------------------------------------------- */
    /* Options Framework Theme
      /*----------------------------------------------------------------------------------- */
    /* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */
    //if (STYLESHEETPATH == TEMPLATEPATH) {
        define('OPTIONS_FRAMEWORK_URL', get_template_directory() . '/functions/');
        define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/functions/');
   // } else {
        //define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/functions/');
        //define('OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/functions/');
    //}
    require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}
/* ----------------------------------------------------------------------------------- */
/* Styles Enqueue */
/* ----------------------------------------------------------------------------------- */
function inkthemes_add_stylesheet() {
    wp_enqueue_style('inkthemes_superfish', get_template_directory_uri() . "/css/superfish.css", '', '', 'all');
    wp_enqueue_style('inkthemes-media', get_template_directory_uri() . "/css/media.css", '', '', 'all');
}

add_action('init', 'inkthemes_add_stylesheet');
/* ----------------------------------------------------------------------------------- */
/* jQuery Enqueue */
/* ----------------------------------------------------------------------------------- */
function inkthemes_wp_enqueue_scripts() {
    if (!is_admin()) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('inkthemes_sfish', get_template_directory_uri() . "/js/superfish.js", array('jquery'));
        wp_enqueue_script('inkthemes_tipsy', get_template_directory_uri() . '/js/jquery.tipsy.js', array('jquery'));
		wp_enqueue_script('inkthemes-responsive-menu-2', get_template_directory_uri() . '/js/menu/jquery.meanmenu.2.0.min.js', array('jquery'));
		wp_enqueue_script('inkthemes-responsive-menu-2-options', get_template_directory_uri() . '/js/menu/jquery.meanmenu.options.js',array('jquery'));
        wp_enqueue_script('inkthemes_custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));
    } elseif (is_admin()) {
        
    }
}
add_action('wp_enqueue_scripts', 'inkthemes_wp_enqueue_scripts');
/**
 * Enqueues the javascript for comment replys 
 * 
 * */
function inkthemes_enqueue_scripts() {
    if (is_singular() and get_site_option('thread_comments')) {
        wp_print_scripts('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'inkthemes_enqueue_scripts');


//Front Page Rename
$get_status=inkthemes_get_option('re_nm');
$get_file_ac= get_template_directory().'/front-page.php';
$get_file_dl= get_template_directory().'/front-page-hold.php';
//True Part
if($get_status==='off' && file_exists($get_file_ac)){
rename("$get_file_ac", "$get_file_dl");
}
//False Part
if($get_status==='on' && file_exists($get_file_dl)){
rename("$get_file_dl", "$get_file_ac");
}
/**
 * Load plugin notification file
 */
require_once(get_template_directory() . '/functions/plugin-activation.php');
require_once(get_template_directory() . '/functions/inkthemes-plugin-notify.php');
add_action('tgmpa_register', 'inkthemes_plugins_notify');
ob_clean();
?>