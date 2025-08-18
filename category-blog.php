<?php get_header(); ?>


<div class="archive-page">
    <h1>Category Page</h1>

    <?php get_template_part( 'includes/section', 'archive' ); ?>
    
    <nav class="pagination">
        <?php 
        echo paginate_links(array(
            'prev_text' => 'Previous',
            'next_text' => 'Next',
            'mid_size' => 2,
            'type' => 'list',
        ));
        ?>
    </nav>

</div>

<?php get_footer(); ?>