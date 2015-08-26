<?php get_header(); ?>
	<div class="frame">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
		<ul class="slidee">
        	<li></li> // Item
        	<li></li> // Item
        	<li></li> // Item
    	</ul>
	<?php endwhile; endif; ?>
	</div>
<?php get_footer(); ?>