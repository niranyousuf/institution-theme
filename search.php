<?php
    get_header();

    pageBanner( array(
        'title' => __( 'Search Results', 'university' ),
        'subtitle' => __( 'You searched for &ldquo;'. get_search_query( false ) .'&rdquo;', 'university' )
    ) );
?>


<div class="container container--narrow page-section">
    <?php
    if ( have_posts() ) {
        while(have_posts()) {
            the_post(); 
            
            get_template_part( '/template-parts/content', get_post_type() );
    
        }
        echo paginate_links();
    } else {
        echo '<h2 class="headline headline--small-plus">Nor results match that search! </h2>';
    }
    
    get_search_form();
    ?>
    
</div>

<?php get_footer(); ?>