<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Add Fontshare Fonts -->
    <link href="https://api.fontshare.com/v2/css?f[]=bebas-neue@400&f[]=nunito@200,201,300,301,400,401,500,501,600,601,700,701,800,801,900,901,1,2&display=swap" rel="stylesheet">
    <title><?php the_title(); ?></title>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                    ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                    <?php
                    }
                    ?>
                </div>

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
                </div>
            </div>
        </div>
    </header>
    
    <div class="site-content">