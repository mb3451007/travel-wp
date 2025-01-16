<?php
/*
Template Name:  POSt Blog Custom Template
*/
get_header(); 

?>
 
<div class="custom-blog-container gggg">
    <?php
        // Query for the latest post only
        $latest_post_args = array(
            'post_type'      => 'post',
            'posts_per_page' => 1, // Get only the latest post
        );
        $latest_post = new WP_Query($latest_post_args);

        if ($latest_post->have_posts()) :
            while ($latest_post->have_posts()) : $latest_post->the_post();
        ?>
    <!-- Top Section with Featured Image and Title -->
        <div class="blog-featured-image" style="background-image: url('<?php the_post_thumbnail_url(); ?>');">
            </div>
            <div class="img-content">
                <p class="blog-date"><?php echo get_the_date(); ?></p>
                <div class="blog-title"><?php the_title(); ?></div>
            </div>
          

    <!-- Blog Content Section -->
    <div class="blog-content">
        <div class="blog">
            <?php
            // Output the main content of the post
             
                    the_content(); // Outputs the content from the WordPress editor
                
            ?>
        </div>
    </div>
    <?php
        endwhile;
        wp_reset_postdata(); // Reset post data
    endif;
    ?>
    <!-- Post Grid Section -->
    <div class="post-grid">
        <div class="grid-header">More Travel Secrets</div>
        <div class="grid-container">
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => -1,
                'post__not_in' => array(get_the_ID()),
            );

            $related_posts = new WP_Query($args);

            if ($related_posts->have_posts()) :
                while ($related_posts->have_posts()) : $related_posts->the_post();
            ?>
                <div class="grid-item">
                    <a href="<?php the_permalink(); ?>" class="card-link">
                        <div class="grid-item-thumbnail">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail(); ?> <!-- Display full-size featured image -->
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <h3 class="post-title"><?php the_title(); ?></h3>
                            <p class="post-date"><?php echo get_the_date(); ?></p>
                        </div>
                    </a>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No related posts found.</p>';
            endif;
            ?>
        </div>
    </div>

    <!--  -->




    
</div>

<?php get_footer(); ?>
