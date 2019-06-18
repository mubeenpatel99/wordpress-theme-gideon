<?php

get_header(); ?>

	<!-- site-content -->
	<div class="site-content clearfix">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                the_content();
            endwhile;
        else :
                echo '<p>No content found</p>';
        endif; ?>

        <div class="home-columns clearfix">
            <div class="one-half">
                <h2>Latest Tech Updates</h2>
                <?php
                // Tech Updates post loop begins here
                $techposts = new WP_Query('cat=6&posts_per_page=2');

                if ($techposts->have_posts()) :

                    while($techposts->have_posts()) : $techposts->the_post();  ?>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span class="date"> <?php the_date('d/m/y'); ?> </span> </h2>
                        <?php the_excerpt(); ?>
                    <?php
                    endwhile;

                else :
                        echo '<p>No Content found</p>';
                endif;
                wp_reset_postdata(); ?>
            </div>

            <div class="one-half last">
                <h2>Latest News Updates</h2>
                <?php
                // News Update post loop
                $newsposts = new WP_Query('cat=4&posts_per_page=2');

                if ($newsposts->have_posts()) :

                    while($newsposts->have_posts()) : $newsposts->the_post();  ?>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span class="date"> <?php the_date('d/m/y'); ?> </span> </h2>
                        <?php the_excerpt(); ?>
                    <?php
                    endwhile;

                else :
                        echo '<p>No Content found</p>';
                endif;
                wp_reset_postdata();
                    ?>
            </div>
        </div>
	</div><!-- /site-content -->
	<?php get_footer();
?>