<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title(); ?></title>

    <?php wp_head(); ?>
</head>
<body>


<!-- Header Nav -->
<header>
    <div class="header-nav-container">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'Header-Nav',
            'container' => false,
            'menu_class' => 'header-nav',
        ));
        ?>
    </div>
</header>    