<?php

get_header();
?>

<h2> Search Results for: <?php the_search_query(); ?> </h2>

<?php
if(have_posts()):
    while(have_posts()): the_post();
    get_template_part('content',get_post_format());
    endwhile;
else:
    echo '<p>No Content Found</p>';
endif;
?>
<div class="pagination">
    <?php
        echo paginate_links();
    ?>
</div>
<?php
get_footer();

?>