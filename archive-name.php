<?php
/*
 * Recipe Archive Page
 * */

get_header();

$page = get_query_var( 'paged' );
?>

    <div style="height: 30px"></div>

    <div class="entry-content">
        <?php
        $args = array(
            'post_type' => 'recipe',
            'post_status' => 'publish',
            'posts_per_page' => '2',
            'paged' => 1,
        );
        $blog_posts = new WP_Query( $args );
        ?>

        <?php if ( $blog_posts->have_posts() ) : ?>
            <div class="posts-grid">
                <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
                    <h2><?php the_title(); ?></h2>
                    <?php the_excerpt(); ?>
                <?php endwhile; ?>
            </div>

            <button class="loadmore">Load posts</button>

        <?php endif; ?>
    </div>



    <div style="height: 30px"></div>

<?php
get_footer();
