<?php get_header(); ?>

<?php $page_title = get_the_title(); ?>

<div class="white-wrap container page-content">
	<?php if ($page_title == 'Products____________'){?>
		<div id="home-block-m">
			<div class="container">
			<?php
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
				echo do_shortcode('[content_block id=202 ]');
			else 
				echo do_shortcode('[content_block id=484 ]'); 
			?>
			</section>
			</div>
		</div>
	<?php } ?>
	<?php if (have_posts()): ?>
		<?php while(have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php get_template_part('404'); ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
