<?php
/**
 * OD Theme Security Configuration
 * This file contains additional security measures
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Additional Security Functions
 */

// Secure wp-config.php file location check
add_action('init', 'od_theme_check_wp_config_security');
function od_theme_check_wp_config_security() {
    if (file_exists(ABSPATH . 'wp-config.php') && is_readable(ABSPATH . 'wp-config.php')) {
        // Log potential security issue
        error_log('OD Theme Security: wp-config.php is in web accessible directory');
    }
}

// Database security - prevent SQL injection in custom queries
function od_theme_safe_query($query, $params = array()) {
    global $wpdb;
    
    if (empty($params)) {
        return $wpdb->get_results($wpdb->prepare($query));
    }
    
    return $wpdb->get_results($wpdb->prepare($query, $params));
}

// Validate and sanitize GET/POST data
function od_theme_validate_input($input, $type = 'text') {
    switch ($type) {
        case 'email':
            return is_email($input) ? sanitize_email($input) : false;
        case 'url':
            return filter_var($input, FILTER_VALIDATE_URL) ? esc_url_raw($input) : false;
        case 'int':
            return filter_var($input, FILTER_VALIDATE_INT);
        case 'text':
        default:
            return sanitize_text_field($input);
    }
}

// Rate limiting for forms
function od_theme_rate_limit($action, $limit = 5, $window = 300) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $key = 'rate_limit_' . $action . '_' . $ip;
    $attempts = get_transient($key);
    
    if ($attempts >= $limit) {
        return false;
    }
    
    $attempts = $attempts ? $attempts + 1 : 1;
    set_transient($key, $attempts, $window);
    
    return true;
}

// Honeypot field for forms
function od_theme_honeypot_field() {
    echo '<input type="text" name="od_honeypot" style="display:none !important;" tabindex="-1" autocomplete="off">';
}

// Validate honeypot
function od_theme_validate_honeypot() {
    return empty($_POST['od_honeypot']);
}

// Enhanced nonce verification
function od_theme_verify_nonce($nonce_field, $action) {
    if (!isset($_POST[$nonce_field])) {
        return false;
    }
    
    return wp_verify_nonce($_POST[$nonce_field], $action);
}

// Secure session handling
add_action('init', 'od_theme_secure_session');
function od_theme_secure_session() {
    if (!session_id()) {
        session_start();
        
        // Regenerate session ID for security
        if (!isset($_SESSION['initiated'])) {
            session_regenerate_id(true);
            $_SESSION['initiated'] = true;
        }
    }
}

// Monitor failed login attempts
add_action('wp_login_failed', 'od_theme_log_failed_login');
function od_theme_log_failed_login($username) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
    error_log("OD Theme Security: Failed login attempt for user '{$username}' from IP {$ip} with User-Agent: {$user_agent}");
}

// Block suspicious user agents
add_action('init', 'od_theme_block_suspicious_agents');
function od_theme_block_suspicious_agents() {
    $suspicious_agents = array('sqlmap', 'nikto', 'whatweb', 'masscan', 'nmap');
    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    
    foreach ($suspicious_agents as $agent) {
        if (strpos($user_agent, $agent) !== false) {
            status_header(403);
            exit('Access Denied');
        }
    }
}

// Prevent information disclosure
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'feed_links_extra', 3);

// Disable unnecessary endpoints
add_filter('rest_endpoints', function($endpoints) {
    if (!is_user_logged_in()) {
        unset($endpoints['/wp/v2/users']);
        unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints;
});

// Add Content Security Policy
add_action('send_headers', 'od_theme_security_headers');
function od_theme_security_headers() {
    if (!is_admin()) {
        $is_development = (strpos($_SERVER['HTTP_HOST'], 'local') !== false || 
                          strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || 
                          strpos($_SERVER['HTTP_HOST'], '.test') !== false ||
                          strpos($_SERVER['HTTP_HOST'], '.dev') !== false);
        
        $csp = "default-src 'self'; ";
        
        if ($is_development) {
            // More permissive CSP for development
            $csp .= "script-src 'self' 'unsafe-inline' 'unsafe-eval' https: blob: data:; ";
            $csp .= "style-src 'self' 'unsafe-inline' https: data:; ";
            $csp .= "font-src 'self' https: data: blob:; ";
            $csp .= "img-src 'self' data: https: blob:; ";
            $csp .= "connect-src 'self' ws: wss: https:; ";
        } else {
            // Production CSP
            $csp .= "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://api.fontshare.com https://cdnjs.cloudflare.com blob:; ";
            $csp .= "style-src 'self' 'unsafe-inline' https://api.fontshare.com https://cdnjs.cloudflare.com; ";
            $csp .= "font-src 'self' https://api.fontshare.com https://cdnjs.cloudflare.com data:; ";
            $csp .= "img-src 'self' data: https: blob:; ";
            $csp .= "connect-src 'self'; ";
        }
        
        $csp .= "worker-src 'self' blob:; ";
        $csp .= "child-src 'self' blob:; ";
        $csp .= "frame-ancestors 'self'; ";
        $csp .= "form-action 'self'; ";
        $csp .= "base-uri 'self';";
        
        header("Content-Security-Policy: " . $csp);
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: geolocation=(), microphone=(), camera=(), payment=(), usb=()');
        
        // Only add HSTS in production
        if (!$is_development) {
            header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
        }
    }
}

// Validate file uploads more strictly
add_filter('wp_check_filetype_and_ext', 'od_theme_secure_file_upload', 10, 4);
function od_theme_secure_file_upload($data, $file, $filename, $mimes) {
    $wp_filetype = wp_check_filetype($filename, $mimes);
    
    // Additional security checks
    $dangerous_extensions = array('php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'phps', 'asp', 'aspx', 'jsp', 'exe', 'bat', 'cmd', 'scr', 'com', 'pif', 'vbs', 'js', 'jar');
    
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    
    if (in_array(strtolower($extension), $dangerous_extensions)) {
        $data['ext'] = false;
        $data['type'] = false;
    }
    
    return $data;
}