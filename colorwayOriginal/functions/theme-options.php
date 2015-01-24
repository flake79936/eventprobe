<?php

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */
function optionsframework_option_name() {
    // This gets the theme name from the stylesheet (lowercase and without spaces)
    $themename = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme();
    $themename = $themename['Name'];
    $themename = preg_replace("/\W/", "", strtolower($themename));
    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = $themename;
    update_option('optionsframework', $optionsframework_settings);
    // echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */
function optionsframework_options() {
    $themename = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme();
    $themename = $themename['Name'];
    $shortname = "of";
    $file_rename = array("on" => "On", "off" => "Off");
    //Stylesheet Reader
    $alt_stylesheets = array("black" =>
        "black", "brown" => "brown", "blue" => "blue", "green" => "green", "pink" => "pink", "purple" => "purple", "red" => "red", "yellow" => "yellow");
    // Test data
    $test_array = array("one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five");
    // Multicheck Array
    $multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
    // Multicheck Defaults
    $multicheck_defaults = array("one" => "1", "five" => "1");
    // Background Defaults
    $background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat', 'position' => 'top center', 'attachment' => 'scroll');
    // Pull all the categories into an array
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }
    // Pull all the pages into an array
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }

    // If using image radio buttons, define a directory path
    $imagepath = get_stylesheet_directory_uri() . '/images/';

    $options = array(array("name" => "General Settings",
            "type" => "heading"),
        array("name" => "Custom Logo",
            "desc" => "Choose your own logo. Optimal Size: 215px Wide by 55px Height",
            "id" => "colorway_logo",
            "type" => "upload"),
        array("name" => "Custom Favicon",
            "desc" => "Specify a 16px x 16px image that will represent your website's favicon.",
            "id" => "colorway_favicon",
            "type" => "upload"),
        array("name" => "Tracking Code",
            "desc" => "Paste your Google Analytics (or other) tracking code here.",
            "id" => "colorway_analytics",
            "std" => "",
            "type" => "textarea"),
        array("name" => "Front Page On/Off",
            "desc" => "Check on for enabling front page or check off for enabling blog page in front page",
            "id" => "re_nm",
            "std" => "on",
            "type" => "radio",
            "options" => $file_rename),
//****=============================================================================****//
//****-----------This code is used for creating slider settings--------------------****//							
//****=============================================================================****//						
        array("name" => "Home Top Feature",
            "type" => "heading"),
        array("name" => "Home Top Feature Image",
            "desc" => "Choose Image for your Home Top Feature. Optimal Size: 900px x 350px",
            "id" => "colorway_slideimage1",
            "type" => "upload"),
        array("name" => "Home Top Feature Heading",
            "desc" => "Enter the Heading for Home Top Feature",
            "id" => "colorway_slideheading1",
            "std" => "",
            "type" => "text"),
        array("name" => "Home Top Feature Heading Link",
            "desc" => "Enter the Link URL in Heading for Home Top Feature",
            "id" => "colorway_slidelink1",
            "std" => "",
            "type" => "text"),
        array("name" => "Home Top Feature Description",
            "desc" => "Description for Home Top Feature",
            "id" => "colorway_slidedescription1",
            "std" => "",
            "type" => "textarea"),
//****=============================================================================****//
//****-----------This code is used for creating home page feature content----------****//							
//****=============================================================================****//	
        array("name" => "Home Page Settings",
            "type" => "heading"),
        array("name" => "Home Page Intro",
            "desc" => "Enter your heading text for home page",
            "id" => "inkthemes_mainheading",
            "std" => "",
            "type" => "text"),
        //***Code for first column***//
        array("name" => "First Feature Image",
            "desc" => "Choose image for your feature column first. Optimal size 198px x 115px",
            "id" => "inkthemes_fimg1",
            "std" => "",
            "type" => "upload"),
        array("name" => "First Feature Heading",
            "desc" => "Enter your heading line for first column",
            "id" => "inkthemes_headline1",
            "std" => "",
            "type" => "text"),
        array("name" => "First Feature Link",
            "desc" => "Enter your link for feature column first",
            "id" => "inkthemes_link1",
            "std" => "",
            "type" => "text"),
        array("name" => "First Feature Content",
            "desc" => "Enter your feature content for column first",
            "id" => "inkthemes_feature1",
            "std" => "",
            "type" => "textarea"),
        //***Code for second column***//	
        array("name" => "Second Feature Image",
            "desc" => "Choose image for your feature column second. Optimal size 198px x 115px",
            "id" => "inkthemes_fimg2",
            "std" => "",
            "type" => "upload"),
        array("name" => "Second Feature Heading",
            "desc" => "Enter your heading line for second column",
            "id" => "inkthemes_headline2",
            "std" => "",
            "type" => "text"),
        array("name" => "Second Feature Link",
            "desc" => "Enter your link for feature column second",
            "id" => "inkthemes_link2",
            "std" => "",
            "type" => "text"),
        array("name" => "Second Feature Content",
            "desc" => "Enter your feature content for column second",
            "id" => "inkthemes_feature2",
            "std" => "",
            "type" => "textarea"),
        //***Code for third column***//	
        array("name" => "Third Feature Image",
            "desc" => "Choose image for your feature column thrid. Optimal size 198px x 115px",
            "id" => "inkthemes_fimg3",
            "std" => "",
            "type" => "upload"),
        array("name" => "Third Feature Heading",
            "desc" => "Enter your heading line for third column",
            "id" => "inkthemes_headline3",
            "std" => "",
            "type" => "text"),
        array("name" => "Third Feature Link",
            "desc" => "Enter your link for feature column third",
            "id" => "inkthemes_link3",
            "std" => "",
            "type" => "text"),
        array("name" => "Third Feature Content",
            "desc" => "Enter your feature content for third column",
            "id" => "inkthemes_feature3",
            "std" => "",
            "type" => "textarea"),
        //***Code for fourth column***//	
        array("name" => "Fourth Feature Image",
            "desc" => "Choose image for your feature column fourth. Optimal size 198px x 115px",
            "id" => "inkthemes_fimg4",
            "std" => "",
            "type" => "upload"),
        array("name" => "Fourth Feature Heading",
            "desc" => "Enter your heading line for fourth column",
            "id" => "inkthemes_headline4",
            "std" => "",
            "type" => "text"),
        array("name" => "Fourth Feature link",
            "desc" => "Enter your link for feature column fourth",
            "id" => "inkthemes_link4",
            "std" => "",
            "type" => "text"),
        array("name" => "Fourth Feature Content",
            "desc" => "Enter your feature content for fourth column",
            "id" => "inkthemes_feature4",
            "std" => "",
            "type" => "textarea"),
        array("name" => "Home Page Testimonial",
            "desc" => "Enter your text for homepage testimonial in short paragraph.",
            "id" => "inkthemes_testimonial",
            "std" => "",
            "type" => "textarea"),
		array("name" => "Home Page Blog Heading",
            "desc" => "Enter your text for homepage blog heading.",
            "id" => "inkthemes_blog_head",
            "std" => "",
            "type" => "textarea"),
//****=============================================================================****//
//****-----------This code is used for creating color styleshteet options----------****//							
//****=============================================================================****//				
        $options[] = array("name" => "Styling Options",
    "type" => "heading"),
        array("name" => "Custom CSS",
            "desc" => "Quickly add some CSS to your theme by adding it to this block.",
            "id" => "inkthemes_customcss",
            "std" => "",
            "type" => "textarea"),
        array("name" => "Footer Settings",
            "type" => "heading"),
        array("name" => "Facebook URL",
            "desc" => "Enter your Facebook URL if you have one",
            "id" => "colorway_facebook",
            "std" => "",
            "type" => "text"),
        array("name" => "Twitter URL",
            "desc" => "Enter your Twitter URL if you have one",
            "id" => "colorway_twitter",
            "std" => "",
            "type" => "text"),
        array("name" => "RSS Feed URL",
            "desc" => "Enter your RSS Feed URL if you have one",
            "id" => "colorway_rss",
            "std" => "",
            "type" => "text"),
        array("name" => "Linked In URL",
            "desc" => "Enter your Linkedin URL if you have one",
            "id" => "colorway_linkedin",
            "std" => "",
            "type" => "text"),
        array("name" => "Stumble Upon URL",
            "desc" => "Enter your Stumble Upon URL if you have one",
            "id" => "colorway_stumble",
            "std" => "",
            "type" => "text"),
        array("name" => "Digg URL",
            "desc" => "Enter your Stumble Upon URL if you have one",
            "id" => "colorway_digg",
            "std" => "",
            "type" => "text")
    );

    update_option('of_themename', $themename);
    return $options;
}
