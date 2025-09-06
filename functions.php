<?php
/**
 * Enqueue scripts and styles.
 */

function od_theme_scripts() {
    wp_register_style('style', get_template_directory_uri() . '/dist/app.css', array(), '1.0', 'all');
    wp_enqueue_style('style');

    wp_enqueue_script('jquery');

    wp_enqueue_script('app', get_template_directory_uri() . '/dist/app.js', array('jquery'), '1.0', true);
    wp_enqueue_script('app');
}

add_action('wp_enqueue_scripts', 'od_theme_scripts');

add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('widgets');

register_nav_menus(array(
    'Header-Nav' => __('Header Nav', 'od-theme'),
));

add_image_size('blog-large', 800, 600, false);
add_image_size('blog-small', 400, 300, true);

function my_sidebars(){
    register_sidebar(array(
        'name'          => __('Page Sidebar'),
        'id'            => 'page-sidebar',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    register_sidebar(array(
        'name'          => __('Blog Sidebar'),
        'id'            => 'blog-sidebar',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init','my_sidebars');


function custom_post_type(){

 $args = array(
   'labels' => array(
       'name' => __('News'),
       'singular_name' => __('News Item')
   ),
   'public' => true,
   'has_archive' => true,
   'rewrite' => array('slug' => 'news'),
   'supports' => array('title', 'editor', 'thumbnail'),
   'menu_icon' => 'dashicons-admin-site'
 );
 register_post_type('news', $args);
}
add_action('init','custom_post_type');

function register_custom_taxonomy() {
    $args = array(
        'labels' => array(
            'name' => __('News Categories'),
            'singular_name' => __('News Category')
        ),
        'public' => true,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'news-category'),
    );
    register_taxonomy('news_category', array('news'), $args);
}
add_action('init', 'register_custom_taxonomy');


function enqueue_custom_fonts() {
    wp_enqueue_style('fontshare-fonts', 'https://api.fontshare.com/v2/css?f[]=plus-jakarta-sans@200,201,300,301,400,401,500,501,600,601,700,701,800,801,1,2&f[]=zodiak@100,101,300,301,400,401,700,701,800,801,900,901,1,2&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_fonts');
