<?php
/**
 * Security Headers and Basic Protections
 */

// Prevent direct access to theme files
if (!defined('ABSPATH')) {
    exit;
}

// Include additional security configuration
require_once get_template_directory() . '/includes/security-config.php';

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

/**
 * Security Enhancements
 */

// Remove WordPress version from head and feeds
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

// Remove RSD link
remove_action('wp_head', 'rsd_link');

// Remove wlwmanifest.xml
remove_action('wp_head', 'wlwmanifest_link');

// Remove shortlink
remove_action('wp_head', 'wp_shortlink_wp_head');

// Remove REST API links from head
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Remove X-Pingback header
add_filter('wp_headers', function($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});

// Hide login errors
add_filter('login_errors', function() {
    return 'Invalid credentials.';
});

// Disable file editing from admin
define('DISALLOW_FILE_EDIT', true);

// Add security headers
add_action('send_headers', function() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
    }
});

// Limit login attempts (basic implementation)
add_action('wp_login_failed', 'od_theme_login_failed');
add_filter('authenticate', 'od_theme_check_attempted_login', 30, 3);

function od_theme_login_failed($username) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $attempts = get_transient('login_attempts_' . $ip);
    $attempts = $attempts ? $attempts + 1 : 1;
    set_transient('login_attempts_' . $ip, $attempts, 15 * MINUTE_IN_SECONDS);
}

function od_theme_check_attempted_login($user, $username, $password) {
    if (!empty($username) && !empty($password)) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $attempts = get_transient('login_attempts_' . $ip);
        if ($attempts && $attempts >= 5) {
            return new WP_Error('too_many_attempts', 'Too many failed login attempts. Please try again later.');
        }
    }
    return $user;
}

// Sanitize file uploads
add_filter('wp_handle_upload_prefilter', function($file) {
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx');
    $filetype = wp_check_filetype($file['name']);
    
    if (!in_array($filetype['ext'], $allowed_types)) {
        $file['error'] = 'File type not allowed.';
    }
    
    return $file;
});

// Remove author enumeration
add_action('init', function() {
    if (isset($_GET['author']) && !is_admin()) {
        wp_redirect(home_url(), 301);
        exit;
    }
});

// Disable directory browsing
add_action('init', function() {
    if (!file_exists(ABSPATH . '.htaccess')) {
        $htaccess_content = "Options -Indexes\n";
        $htaccess_content .= "<Files \"wp-config.php\">\nOrder allow,deny\nDeny from all\n</Files>\n";
        file_put_contents(ABSPATH . '.htaccess', $htaccess_content, FILE_APPEND | LOCK_EX);
    }
});

// Add nonce verification for AJAX requests
add_action('wp_enqueue_scripts', function() {
    wp_localize_script('app', 'od_theme_ajax', array(
        'nonce' => wp_create_nonce('od_theme_nonce'),
        'ajax_url' => admin_url('admin-ajax.php')
    ));
});

/**
 * Input Sanitization Functions
 */
function od_theme_sanitize_text($input) {
    return sanitize_text_field(wp_unslash($input));
}

function od_theme_sanitize_email($input) {
    return sanitize_email(wp_unslash($input));
}

function od_theme_sanitize_url($input) {
    return esc_url_raw(wp_unslash($input));
}
