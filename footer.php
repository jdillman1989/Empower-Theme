<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 */
?>
	<footer>
		<p>&copy <?php the_field('site_copyright', 'option'); ?></p>
	</footer>
<?php wp_footer(); ?>
</body>
</html>