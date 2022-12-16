<?php
    get_header();

    pageBanner(array(
        'title' => __('All Programs', 'university'),
        'subtitle' => __('There is something for everyone. Have a look around.', 'university')
    ));
?>

<div class="container container--narrow page-section">

    <ul class="link-list min-list">

    <?php
    while( have_posts() ) :
        the_post(); ?>
        
        <li><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></li>

    <?php 
        endwhile;
        echo paginate_links();
    ?>

    </ul>

</div>

<?php get_footer(); ?>