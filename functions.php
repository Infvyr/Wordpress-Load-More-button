<?php
// FUNCTIONS.php

// include wordpress ajax file and custom jQuery script
function blog_scripts() {
    // Register the script
    wp_register_script( 'custom-load-more', get_template_directory_uri() . '/assets/js/load-more.js', array('jquery'), time(), true );

    // Localize the script with new data
    $script_data_array = [
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'security' => wp_create_nonce( 'load_more_posts' ),
    ];
    wp_localize_script( 'custom-load-more', 'blog', $script_data_array );

    // Enqueued script with localized data.
    wp_enqueue_script( 'custom-load-more' );
}
add_action( 'wp_enqueue_scripts', 'blog_scripts' );


// callback function for AJAX
function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');

    $paged = $_POST['page'];

    $args = [
        'post_type' => 'recipe',
        'post_status' => 'publish',
        'posts_per_page' => '2',
        'paged' => $paged,
    ];

    $blog_posts = new WP_Query( $args );
    ?>

    <?php if ( $blog_posts->have_posts() ) : ?>
        <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
            <h2><?php the_title(); ?></h2>
            <?php the_excerpt(); ?>
        <?php endwhile; ?>
    <?php
    endif;

    wp_die();
}
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');
