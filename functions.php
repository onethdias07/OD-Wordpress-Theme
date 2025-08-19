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


// Theme Options
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('widgets');



// Menus
register_nav_menus(array(
    'Header-Nav' => __('Header Nav', 'od-theme'),
));

//custom image sizes
add_image_size('blog-large', 800, 600, false);
add_image_size('blog-small', 400, 300, true);


//register sidebars
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
