<?php

get_header(); ?>

<div class="site-content clearfix">
    <div class="main-column">
        <?php
            if(have_posts()):
                while(have_posts()): the_post();
                get_template_part('content', get_post_format());
                endwhile;
            else:
                echo '<p>No Content Found</p>';
            endif;
        ?>
    </div>
    <?php get_sidebar(); ?>
</div>
<div class="pagination">
    <?php
        echo paginate_links();
    ?>
</div>

<?php

get_footer();

?>