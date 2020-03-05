		<?php
		/**
		 * The main template file
		 *
		 * This is the most generic template file in a WordPress theme
		 * and one of the two required files for a theme (the other being style.css).
		 * It is used to display a page when nothing more specific matches a query.
		 * E.g., it puts together the home page when no home.php file exists.
		 *
		 * @link https://codex.wordpress.org/Template_Hierarchy
		 *
		 * @package WP_Bootstrap_Starter
		 */

		get_header();
		?>

			<section id="primary" class="content-area col-sm-12 col-md-12 col-lg-12">
				<main id="main" class="site-main" role="main">
				<?php 
					$args = array('post_type' => 'property', 'posts_per_page' => '1');
					$myQuery = new WP_Query($args);
				?>
				<?php
				if ($myQuery->have_posts() ) :

					if ( is_home() && !is_front_page() ) : ?>
						<header>   
							<h1 class="page-title screen-reader-text"><?php single_post_title();  ?></h1>
						
						</header>
				

					<?php
					endif;

					/* Start the Loop */
					while ( $myQuery->have_posts() ) : $myQuery->the_post();
							
						/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
					
					?>
					<div class="row">
					
					<div class="col-6">
			<?php $image = get_field('headerimage'); ?>
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		</div>
		<div class="col-6">
		<div class="row">			
		<?php					
				 	get_template_part( 'template-parts/content', get_post_format() );
					
					?>
				</div>
		<div class="row facts-payment-container">
			 
					
			<div class="fact-sheet-container  jumbotron" id ="jumbo">
			<?php	
			the_field("Facts",false,false);
			?>

			</div>	
			<div class="payment-plan-container jumbotron" id ="jumbo-payment">
			<?php	
			the_field("payment_plan");
			?>
			</div>		
	

		</div>
			</div> 
			</div>
			<?php
					endwhile; wp_reset_postdata();

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

				</main><!-- #main -->
			</section><!-- #primary -->

		<?php
		get_sidebar();
		get_footer();
