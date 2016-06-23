<?php
/**
 * The frontpage template file
 * @package Landmarks
 */
?>
<?php get_header(); ?>
<main>
<?php while ( have_posts() ) : the_post(); ?>

	<section class="promo">
	    <?php
	    $promo_type = get_field('promo_type');

		if ($promo_type == 'video') {
			$video_url = get_field('promo_video');
			$video_key_start = strpos($video_url, "?v=");
			$video_key = substr($video_url, $video_key_start + 3);
			
			echo '<div class="promo-video">';
			echo '<iframe src="https://www.youtube.com/embed/'.$video_key.'" id="promo-video" frameborder="0" allowfullscreen></iframe>';
			echo '</div>';
		}
		else {
			$promo_image = get_field('promo_image');
			echo '<div class="promo-image" style="background-image:url('.$promo_image.');background-size:cover;">';
		}
	    ?>
	</section>

	<section class="products">
		<header>
			<h1><?php the_field('product_title'); ?></h1>
		</header>
		<div class="content">

		<?php

		$terms = get_terms( array(
		    'taxonomy' => 'product_categories',
			'orderby' => 'title',
			'order' => 'DESC',
			'hide_empty' => false,
			'parent' => 0
		) );

		$parent_amount = count( $terms );
		$widths = 100 / $parent_amount;

		if ($parent_amount > 0) {

			echo '<div class="tabs">';

			foreach( $terms as $term ){

				echo '<div class="tab" style="width:'.$widths.'%;">';
				echo '<h2>'.$term->name.'</h2>';

				$termchildren = get_term_children( $term->term_id, 'product_categories' );

				if ( count( $termchildren ) > 0 ){

					echo '<div class="tab-content-hidden">';

					foreach ( $termchildren as $child ) {

						$term_child = get_term_by( 'id', $child, 'product_categories' );

						echo '<h3>'.$term_child->name.'</h3>';

						$args = array(
							        'posts_per_page' => -1,
							        'post_type' => 'product',
							        'tax_query' => array(
							            array(
							                'taxonomy' => 'product_categories',
							                'field' => 'term_id',
							                'terms' => $term_child->term_id
							            )
							        )
							    );

						$the_query = new WP_Query( $args );

						if( $the_query->have_posts() ){

							echo '<div class="products-container">';

							while( $the_query->have_posts() ){
								$the_query->the_post();
								$image = get_field('product_image');
								$title = get_the_title();
								$link = get_field('product_link');
								$description = get_field('product_description');

								echo '<a class="product-item" href="'.$link.'">';
								echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" class="product-item-image">';
								echo '<div class="product-item-text">';
								echo '<h4>'.$title.'</h4>';
								echo $description;
								echo '</div>';
								echo '</a>'; // end a.product-item
							}

							echo '</div>'; // end div.products-container
						}

						wp_reset_query();
					};

					echo '</div>'; // end div.tab-content-hidden
				}

				echo '</div>'; // end div.tab
			};

			echo '</div>'; // end div.tabs
		}
		?>
			<div class="tab-content-display" id="product-display"></div>
		</div>
	</section>

	<section class="about">
		<header>
			<h2><?php the_field('about_title'); ?></h2>
		</header>
		<div class="content">
			<?php the_field('about_description'); ?>
		</div>
	</section>

	<section class="contact">
		<div class="contact-info">
			<h2><?php the_field('contact_title'); ?></h2>
			<?php the_field('contact_info'); ?>
		</div>
		<div class="contact-form">
			<?php gravity_form( 'Contact', false, true, false, null, false, 1, true ); ?>
		</div>
	</section>

<?php endwhile; ?>
</main>
<?php get_footer(); ?>