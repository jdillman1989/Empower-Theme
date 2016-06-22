<?php
/**
 * The main template file
 * @package Landmarks
 */
?>
	<?php get_header(); ?>

	<!--Start the Loop.-->
	<?php while ( have_posts() ) : the_post(); ?>
		<h1><?php the_title(); ?></h1> 
		<?php the_content(); ?>
	<?php endwhile; ?>

	<?php get_footer(); ?>