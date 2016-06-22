<?php
/**
* The template for displaying the header
*
* Displays all of the head element.
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.png" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<title><?php bloginfo('name');?></title>

	<?php wp_head(); ?>
</head>
<body>
	<header class="global">
		<div class="branding">
			<img src="<?php the_field('site_logo', 'option'); ?>" class="logo">
			<h1><?php bloginfo('name');?></h1>
		</div>
		<nav>
		<?php
		wp_nav_menu( 
			array( 'theme_location' => 'social' ) 
		); 
		?>
		</nav>
	</header>