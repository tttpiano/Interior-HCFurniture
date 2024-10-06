<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Theratio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-box masonry-post-item'); ?>>
	<div class="post-inner">
	    <div class="inner-post">
	        <div class="entry-header">

	            <?php if ( 'post' === get_post_type() ) : ?>
	            <div class="entry-meta">
	            	<?php if( theratio_get_option( 'post_entry_meta' ) ) { theratio_post_meta(); } ?>
	            </div><!-- .entry-meta -->
	            <?php endif; ?>

	            <?php the_title( '<h4 class="entry-title"><a class="title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>

	        </div><!-- .entry-header -->

	        <div class="entry-summary the-excerpt">

	            <?php the_excerpt(); ?>

	        </div><!-- .entry-content -->
	        <div class="entry-footer">
	        	<?php if(theratio_get_option('blog_read_more')){ ?><a href="<?php the_permalink(); ?>" class="btn-details"> <?php echo esc_html(theratio_get_option('blog_read_more')); ?></a><?php } ?>
	        </div>
	    </div>
	</div>
</article>