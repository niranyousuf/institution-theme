<?php
get_header();

while( have_posts() ) :
    the_post();

    pageBanner();
?>

<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( "program" ); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>

    <div class="generic-content">
        <?php the_field( 'main_body_content' ); ?>
    </div>
    
    <!-- Related Professor -->
    <?php
    $relatedProfessors = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => 'professor',
        'orderby' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
            )
        )
    )); 
    
    if ($relatedProfessors->have_posts()) : ?>
    <hr class="section-break">
    <h2 class="headline headline--medium"><?php echo get_the_title(); ?> Professors</h2>
    <ul class="professor-cards">
    <?php

    while( $relatedProfessors->have_posts() ) :
        $relatedProfessors->the_post(); ?>
        <li class="professor-card__list-item">
            <a class="professor-card" href="<?php the_permalink(); ?>">
                <img src="<?php the_post_thumbnail_url( 'professorLandscape' ); ?>" class="professor-card__image">
                <span class="professor-card__name"><?php the_title(); ?></span>
            </a>
        </li>
    <?php 
    endwhile; // while loop used for Professor 
        ?>

    </ul>
    <?php
    endif; // if condition used for Professor

    wp_reset_postdata();
    ?>
    <!-- Related Professor End -->

    <!-- Releted Events  -->
    <?php
    $today = date( 'Ymd' );
    $homepageEvents = new WP_Query( array(
        'posts_per_page' => 2,
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            ),
            array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
            )
        )
    ) );

    if ( $homepageEvents->have_posts() ) : ?>
    <hr class="section-break">
    <h2 class="headline headline--medium">Upcoming <?php echo get_the_title(); ?> Events</h2>
    <?php
    while( $homepageEvents->have_posts() ) {
        $homepageEvents->the_post();

        // Event Content from template part
        get_template_part( 'template-parts/content-event' );
        
    } // while loop used for events posts

    endif; // if condition used for events posts

    // Related Evants END ---- >
    wp_reset_postdata();

    // Available Campuses ---- >
    $relatedCampuses = get_field( 'related_campus' );
    if ( $relatedCampuses ) { ?>
        <hr class="section-break">
        <h2 class="headline headline--medium"><?php echo get_the_title(); ?> is Available at these Campuses:</h2>
        <ul class="link-list min-list">
        <?php
        foreach( $relatedCampuses as $campus ) { ?>
            <li>
                <a href="<?php echo get_the_permalink( $campus ); ?>">
                    <?php echo get_the_title( $campus ); ?>
                </a>
            </li>
        <?php }
        ?>
        </ul>
     <?php }

    ?>
    <!-- Available Campuses END -->
</div>


<?php
endwhile;
get_footer();
?>
