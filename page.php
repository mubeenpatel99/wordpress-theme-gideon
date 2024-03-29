<?php

get_header(); ?>

	<!-- site-content -->
	<div class="site-content clearfix">
	<?php

		if ( has_children() OR $post->post_parent > 0 ) { ?>

			<nav class="site-nav children-links clearfix">

				<span class="parent-link"><a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>"><?php echo get_the_title(get_top_ancestor_id()); ?></a></span>

				<ul>
					<?php

					$args = array(
						'child_of' => get_top_ancestor_id(),
						'title_li' => ''
					);

					?>

					<?php wp_list_pages($args); ?>
				</ul>
			</nav>

		<?php } ?>
		<!-- main-column -->
		<div class="main-column">
			<?php if (have_posts()) :
				while (have_posts()) : the_post();

				get_template_part('content', 'page');

				endwhile;

				else :
					echo '<p>No content found</p>';

				endif;
				?>
		</div><!-- /main-column -->

		<?php get_sidebar(); ?>

	</div><!-- /site-content -->

	<?php get_footer();

?>