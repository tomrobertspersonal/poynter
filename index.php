<?php get_header(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
		<header>
			<button id="open-cover">
				<i class="fa fa-angle-right"></i>
			</button>
		</header>	
	<?php endwhile; endif; ?>
<?php get_footer(); ?>