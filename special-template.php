<?php

/*
Template Name: special template
*/

get_header();

if(have_posts()):
    while(have_posts()): the_post();
    ?>
    <article class="post page">
        <?php
            if ( has_children() OR $post->post_parent > 0) { ?>
            <nav class="site-nav children-links clearfix">

                <span class="parent-link"><a href="<?php echo get_the_permalink(get_top_ancestor_id()) ?>"> <?php echo get_the_title(get_top_ancestor_id()); ?> </a></span>
                <ul>

                    <?php
                    $args = array('child_of' => get_top_ancestor_id(),
                                    'title_li' => '');
                    wp_list_pages($args); ?>

                </ul>

            </nav>

            <?php } ?>

        <h2>
            <?php the_title(); ?>
        </h2>

        <div class="info-box">
            <h4>Disclaimer Title</h4>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum quidem est impedit perspiciatis, hic dolores alias assumenda veli.</p>
        </div>

<?php the_content()?>
</article>
<?php
endwhile;
else:
    echo '<p>No Content Found</p>';
endif;

get_footer();

?>