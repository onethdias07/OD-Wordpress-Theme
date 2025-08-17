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



// Menus
register_nav_menus(array(
    'Header-Nav' => __('Header Nav', 'od-theme'),
));
