<?php 
    get_header();
    
    pageBanner( array(
        'title' => __( 'All Events','university' ),
        'subtitle' => __( 'See what is going on in our world!', 'university' )
    ) );
?>


<div class="container container--narrow page-section">
    <?php
    while( have_posts() ) {
        the_post(); 

        // Event Content from template part
        get_template_part( 'template-parts/content-event' );

    }
    
    echo paginate_links();

    ?>

    <hr class="section-break">
    <p><?php _e( 'Looking for a recap of past events?', 'university' ); ?> <a href="<?php echo site_url('/past-events'); ?>"> <?php _e( 'Check out our past events archive.', 'university' ); ?> </a></p>
</div>

<?php get_footer(); ?>