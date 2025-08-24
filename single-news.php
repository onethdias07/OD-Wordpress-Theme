<?php get_header(); ?>

<div class="content-wrapper">
    <div class="content-area">
        <div class="single-page">
            <?php get_template_part( 'includes/section', 'blogcontent' ); ?>
        </div>

        <div class="post-pagination">
            <?php wp_link_pages(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>