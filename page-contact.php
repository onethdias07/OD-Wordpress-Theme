<?php
/*
Template Name: Contact Page
*/

get_header(); ?>

<div class="contact-page">
    <?php while (have_posts()) : the_post(); ?>
        <div class="page-header">
            <div class="container">
                <h1><?php the_title(); ?></h1>
                <?php if (get_the_content()) : ?>
                    <div class="page-content">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <?php include get_template_directory() . '/includes/section-contactform.php'; ?>
        
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
