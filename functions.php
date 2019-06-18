<?php

function theme_resources(){
    wp_enqueue_style('style',get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'theme_resources');

//get top ancestor

function get_top_ancestor_id(){

    global $post;

    if ($post->post_parent){
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }
    else {
        return $post->ID;
    }

}

//to check for children
function has_children() {
    global $post;

    $pages = get_pages('child_of=' . $post->ID);

    return count($pages);
}

//Customize Excerpt Length
function custom_excerpt_length(){
    return 25;
}

add_filter('excerpt_length','custom_excerpt_length');

function theme_setup(){

    //navigation menu
    register_nav_menus(array(
        'primary' => __('Primary Menu'),
        'footer' => __('Footer Menu'),
    ));

    //add featured image support
    add_theme_support('post-thumbnails');
    add_image_size('small-thumbnail', 180, 120, true);
    add_image_size('banner-image', 920, 210, array('left', 'top'));

    //Add support for post format
    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
}

add_action('after_setup_theme', 'theme_setup');

// Add our Widget Location
function theme_widget_init(){
    register_sidebar(array(
        'name' => 'Sidebar 1',
        'id' => 'sidebar1',
        'before_widget' => '<div class="widget-item-sidebar">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => 'Sidebar 2',
        'id' => 'sidebar2',
        'before_widget' => '<div class="widget-item-sidebar">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Area 1',
        'id' => 'footer1',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Area 2',
        'id' => 'footer2',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Area 3',
        'id' => 'footer3',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Area 4',
        'id' => 'footer4',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>'
    ));
}

add_action('widgets_init', 'theme_widget_init');

// Customize appearance option
function theme_customize_register( $wp_customize ){
    $wp_customize->add_setting('theme_link_color', array(
        'default' => '#006ec3',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting('theme_button_color', array(
        'default' => '#006ec3',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting('theme_button_hover_color', array(
        'default' => '#006ec3',
        'transport' => 'refresh',
    ));

    $wp_customize->add_section('theme_standard_colors', array(
        'title' => __('Standard Colors', 'Gideon'),
        'priority' => 30,
    ));

    $wp_customize->add_control( new WP_Customize_color_control( $wp_customize, 'theme_link_color_control', array(
        'label' => __('Link Color', 'Gideon'),
        'section' => 'theme_standard_colors',
        'settings' => 'theme_link_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_color_control( $wp_customize, 'theme_button_color_control', array(
        'label' => __('Button Color', 'Gideon'),
        'section' => 'theme_standard_colors',
        'settings' => 'theme_button_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_color_control( $wp_customize, 'theme_button__hover_color_control', array(
        'label' => __('Button Hover Color', 'Gideon'),
        'section' => 'theme_standard_colors',
        'settings' => 'theme_button_hover_color',
    ) ) );
}

add_action('customize_register', 'theme_customize_register');

// Output Customize CSS
function theme_customize_css(){ ?>
    <style type="text/css">
        a:link,
        a:visited{
            color: <?php echo get_theme_mod('theme_link_color'); ?>
        }

        .site-header nav ul li.current-menu-item a:link,
        .site-header nav ul li.current-menu-item a:visited,
        .site-header nav ul li.current-page-ancestor a:link,
        .site-header nav ul li.current-page-ancestor a:visited{
            background-color: <?php echo get_theme_mod('theme_link_color'); ?>
        }

        .head-search #searchsubmit{
            background-color: <?php echo get_theme_mod('theme_button_color'); ?>
        }

        .head-search #searchsubmit:hover {
            background-color: <?php echo get_theme_mod('theme_button_hover_color'); ?>
        }
    </style>
<?php }

add_action('wp_head', 'theme_customize_css');