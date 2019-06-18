<?php

get_header();

if(have_posts()):
    while(have_posts()): the_post();
    ?>
    <article class="post" >
        <h2>
            <a href=" <?php the_permalink(); ?> "> <?php the_title(); ?> </a>
        </h2>
        <p class="post-meta">
            <?php the_time('F jS, Y | g:i a'); ?>
             | by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'))?>">
             <?php the_author(); ?></a>
              | Posted in
              <?php

                $categories = get_the_category();
                $separator = ", ";
                $output = '';

                    if($categories){
                        foreach($categories as $category){
                            $output .='<a href="' . get_category_link($category->term_id) . '">'. $category->cat_name . '</a>' . $separator;
                        }
                        echo trim($output, $separator);
                    }
            ?></p>
            <?php
                the_post_thumbnail('banner-image');
                the_content();
            ?>
        <div class="about-author clearfix">
            <div class="about-author-image">
                <?php echo get_avatar(get_the_author_meta('ID'), 300) ?>
                <p><?php echo get_the_author_meta('nickname') ?></p>
            </div>
            <?php
                $posts_by_author = new WP_Query(array(
                    'author' => get_the_author_meta('ID'),
                    'posts_per_page' => 2,
                    'post__not_in' => array(get_the_ID())
                ));
            ?>
            <div class="about-author-text">
                <h3>About The Author</h3>
                <?php echo wpautop(get_the_author_meta('description')) ?>
                <div class="other-posts-by">
                    <h4>Other posts by <?php echo get_the_author_meta('nickname') ?></h4>
                    <ul>
                        <?php
                            while($posts_by_author->have_posts()){
                                $posts_by_author->the_post(); ?>
                                <li><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></li>
                            <?php }?>
                    </ul>
                </div>
                <?php wp_reset_postdata() ?>
            </div>
        </div>

    </article>
    <?php
    endwhile;
else:
    echo '<p>No Content Found</p>';
endif;
get_footer();

?>