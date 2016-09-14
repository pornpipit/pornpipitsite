<?php

	global $wp_customize;

	$zerif_portofolio_number = get_theme_mod('zerif_portofolio_number','8');
	
	if( !empty($zerif_portofolio_number) ):

		$args = array('post_type' => 'portofolio', 'posts_per_page' => $zerif_portofolio_number);
		
	else:
		
		$args = array('post_type' => 'portofolio', 'posts_per_page' => -1);

	endif;
	
	$zerif_portofolio_show = get_theme_mod('zerif_portofolio_show');

	$zerif_query = new WP_Query( apply_filters( 'zerif_product_parameters',$args ) );

	// zerif_before_product_trigger();

	if ( $zerif_query->have_posts() && ( isset($zerif_portofolio_show) && $zerif_portofolio_show != 1 ) ):
				
		echo '<section class="works" id="works">';
		
	elseif ( isset( $wp_customize ) && $zerif_query->have_posts() ):
	
		echo '<section class="works zerif_hidden_if_not_customizer" id="works">';

	endif;

	// zerif_top_product_trigger();
	
	if ( ($zerif_query->have_posts() && ( isset($zerif_portofolio_show) && $zerif_portofolio_show != 1 )) || ( isset( $wp_customize ) && $zerif_query->have_posts() ) ):

			echo '<div class="container">';
				echo '<div class="section-header">';
				
					/* title */
				
					$zerif_portofolio_title = get_theme_mod('zerif_portofolio_title',__('product','zerif'));

					if( !empty($zerif_portofolio_title) ):
					
						// echo '<h2 class="dark-text">'.$zerif_portofolio_title.'</h2>';

						echo '<h2 class="dark-text">Products</h2>';
						
					elseif ( isset( $wp_customize ) ):

						echo '<h2 class="dark-text zerif_hidden_if_not_customizer"></h2>';
						
					endif;
					
					/* subtitle */

					$zerif_portofolio_subtitle = get_theme_mod('zerif_portofolio_subtitle',__('product subtitle','zerif'));

					if( !empty($zerif_portofolio_subtitle) ):

						echo '<h6>'.$zerif_portofolio_subtitle.'</h6>';
						
					elseif ( isset( $wp_customize ) ):

						echo '<h6 class="zerif_hidden_if_not_customizer"></h6>';

					endif;
				echo '</div>';

				echo '<div class="row projects">';

					echo '<div id="loader">';

						echo '<div class="loader-icon"></div>';

					echo '</div>';


					echo '<div class="col-md-12" id="product-list">';


					echo '<ul class="cbp-rfgrid">';


					while ( $zerif_query->have_posts() ) :


						$zerif_query->the_post();


						?>


						<!-- PROJECT -->	


						<li data-scrollreveal="enter left after 0s over 1s">


						<a href="<?php the_permalink(); ?>" class="more">


							<?php


							if ( has_post_thumbnail($post->ID) ):


								echo get_the_post_thumbnail($post->ID, 'zerif_project_photo'); 


							endif;


							?>


							<div class="project-info">


								<div class="project-details">


									<h5 class="white-text red-border-bottom">


										<?php the_title(); ?>


									</h5>


									<div class="details white-text">


										<?php


										$categories = get_the_category();


										$separator = ' ';


										if($categories):


											foreach($categories as $category):


												echo $category->cat_name.$separator;


											endforeach;


										endif;


										?>


									</div>


								</div>


							</div>


							</a>


						</li>


						<!-- / PROJECT -->


						<?php


					endwhile;


					echo '</ul>';


					echo '</div>';

				echo '</div>';

			echo '<div id="loaded-content"></div>';

			echo '<a id="back-button" class="red-btn" href="#"><i class="icon-fontawesome-webfont-27"></i>'.__('Go Back','zerif').'</a>';

		echo '</div>';

		// zerif_bottom_product_trigger();

	echo '</section>';

	endif;


	wp_reset_postdata();

	// zerif_after_product_trigger();
?>