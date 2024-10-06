<?php
/**
 * Template part for displaying widget Portfolio Filter Metro
 *
 * @package Theratio
 */
?>
<?php 
	$cates = get_the_terms( get_the_ID(), 'portfolio_cat' );
    $cate_id   = '';
    if ( ! is_wp_error( $cates ) && ! empty( $cates ) ) :
	    foreach ( $cates as $cate ) {
	        $cate_id   .= 'category-' . $cate->term_id . ' ';
	    }
	endif;
	$thumb = '';
	if ( function_exists('rwmb_meta') ) {
		$thumb = rwmb_meta('thumb_size');
	}
?>
<div class="project-item <?php echo esc_attr( $cate_id ); if ( $thumb == 'double' ) { echo 'thumb2x'; } ?>">
	<div class="projects-box">
		<div class="projects-thumbnail" data-src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" data-sub-html="<?php the_title(); ?>">
			<a href="<?php the_permalink(); ?>">
				<?php
					if ( has_post_thumbnail() ) {
						if( $thumb == 'double' ){
							the_post_thumbnail( 'theratio-portfolio-thumbnail-grid2x' );
						}else{
							the_post_thumbnail( 'theratio-portfolio-thumbnail-grid' );
						}
					}
				?>
			</a>
			<span class="overlay">
				<h5><?php the_title(); ?></h5>
				<i class="ot-flaticon-add"></i>
			</span>
		</div>
		<div class="portfolio-info">
			<div class="portfolio-info-inner">
				<h5><a class="title-link" href="<?php the_permalink(); ?>" data-src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" data-sub-html="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
				<?php 
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