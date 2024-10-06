<?php
/**
 * Template part for displaying widget Portfolio Carousel, section portfolio-related-posts in single-ot_portfolio
 *
 * @package Theratio
 */
?>
<div class="project-items swiper-slide">
	<div class="projects-box">
		<div class="projects-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'theratio-portfolio-thumbnail-grid' );
					}
				?>
			</a>
			<span class="overlay"><i class="ot-flaticon-add"></i></span>
		</div>
		<div class="portfolio-info">
			<div class="portfolio-info-inner">
				<h5><a class="title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<?php 
					$cates = get_the_terms( get_the_ID(), 'portfolio_cat' );
					if ( ! is_wp_error( $cates ) && ! empty( $cates ) ) :
						echo '<p class="portfolio-cates">';	 
						foreach ( $cates as $term ) {
							// The $term is an object, so we don't need to specify the $taxonomy.
							$term_link = get_term_link( $term );
							// If there was an error, continue to the next term.
							if ( is_wp_error( $term_link ) ) {
								continue;
							}
							// We successfully got a link. Print it out.
							echo '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
						}		                         
						
						echo '</p>';    
					endif; 
				?> 
			</div>
			<a class="overlay" href="<?php the_permalink(); ?>"></a>
		</div>
	</div>
</div>
