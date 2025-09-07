<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://api.fontshare.com/v2/css?f[]=bebas-neue@400&f[]=nunito@200,201,300,301,400,401,500,501,600,601,700,701,800,801,900,901,1,2&display=swap" rel="stylesheet">
    
    <?php if (is_singular() && get_the_title()): ?>
        <title><?php echo esc_html(get_the_title()); ?> - <?php echo esc_html(get_bloginfo('name')); ?></title>
    <?php else: ?>
        <title><?php echo esc_html(get_bloginfo('name')); ?> - <?php echo esc_html(get_bloginfo('description')); ?></title>
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="header-right">
                    <nav class="main-navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'Header-Nav',
                            'container' => false,
                            'menu_class' => 'header-nav',
                        ));
                        ?>
                    </nav>
                    
                    <div class="header-search">
                        <?php get_search_form(); ?>
                    </div>

                    <button class="mobile-menu-toggle" aria-label="Toggle mobile menu">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="mobile-menu-overlay"></div>
    </header>
    
    <div class="site-content">