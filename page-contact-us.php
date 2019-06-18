<?php

get_header(); ?>

<!-- site-content -->
<div class="clearfix">
    <div class="left-form">
        <?php
            if (have_posts()) :
                while (have_posts()) : the_post(); ?>

                    <div class="contact-form">
                        <h2> <?php the_title(); ?></h2>
                        <h4>Like What you See? We'd love to hear from you!</h4>
                        <p><?php the_content(); ?></p>
                    </div>
                    <?php
                endwhile;

            else :
                echo '<p>No content found</p>';

            endif;
        ?>
    </div>
    <div class="right-section">
        <?php get_sidebar(); ?>
    </div>
</div><!-- /clearfix -->

<?php get_footer();

?>