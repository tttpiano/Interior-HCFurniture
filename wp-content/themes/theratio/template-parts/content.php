<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Theratio
 */

?>
<?php                                                     
	$format 	 = get_post_format();
	$link_video  = get_post_meta(get_the_ID(),'post_video', true);
	$link_audio  = get_post_meta(get_the_ID(),'post_audio', true);
	$link_link   = get_post_meta(get_the_ID(),'post_link', true);
	$text_link   = get_post_meta(get_the_ID(),'text_link', true);
	$quote_text  = get_post_meta(get_the_ID(),'post_quote', true);
	$quote_name  = get_post_meta(get_the_ID(),'quote_name', true);
	$images		 = '';
?> 
<article id="post-<?php the_ID(); ?>" <?php post_class('post-box masonry-post-item'); ?>>
	<div class="post-inner">
	    <?php if ( $format == 'gallery' ) { ?>
			
			<?php if ( function_exists( 'rwmb_meta' ) ) { $images = rwmb_meta( 'post_gallery', array( 'size' => 'full' ) ); } ?>
			<div class="entry-media <?php if( $images ) echo esc_attr('post-cat-abs'); ?>">
				<?php if($images){ ?>
					<div class="gallery-post-slider-swiper img-slider swiper-container" <?php if( is_rtl() ){ echo'dir="rtl"'; }?>>
						<div class="swiper-wrapper"> 
		                	<?php foreach ( $images as $image ) {  ?>	
	                    		<div class="swiper-slide">
		                    		<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
	                			</div>
	                		<?php } ?>    
                		</div>
                		<!-- Add Arrows -->
	    				<div class="octf-swiper-button-next"><i class="ot-flaticon-right-arrow"></i></div>
	    				<div class="octf-swiper-button-prev"><i class="ot-flaticon-left-arrow"></i></div>
            		</div> 
	            <?php } ?>
		        <?php theratio_posted_in(); ?>
			</div>			

	    <?php }elseif( $format == 'image' ) { ?>

	    	<?php if( function_exists( 'rwmb_meta' ) ) { $images = rwmb_meta( 'post_image' ); } ?>
	    	<div class="entry-media <?php if( $images ) echo esc_attr('post-cat-abs'); ?>">
			    <?php if($images){ ?>              
			        <?php foreach ( $images as $image ) {  ?>				            
			            <a href="<?php the_permalink(); ?>">
			            	<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
			            </a>
			        <?php } ?>                
			    <?php } ?>
				<?php theratio_posted_in(); ?>
			</div>
			
	    <?php }elseif( $format == 'audio' ){ ?>

	    	<?php if( $link_audio ){ ?>
			<div class="audio-box">
				<iframe scrolling="no" frameborder="no" src="<?php echo esc_url( $link_audio ); ?>"></iframe>
			</div>
			<?php } ?>
			<div class="entry-media">
	        	<?php theratio_posted_in(); ?>
	        </div>

	    <?php }elseif( $format == 'video' ){ ?>

	    	<?php if( function_exists( 'rwmb_meta' ) ) { $images = rwmb_meta( 'bg_video', array( 'size' => 'full' ) ); } ?>
			<div class="entry-media <?php if( $images ) echo esc_attr('post-cat-abs'); ?>">
			    <?php if($images){ ?>
			    	<div class="video-popup">
				    	<a class="btn-play" href="<?php echo esc_url( $link_video ); ?>">
							<i class="ot-flaticon-play-button"></i>
						</a> 
					</div>
			        <?php foreach ( $images as $image ) {  ?>
			            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
			        <?php } ?>                
			    <?php } ?>
				<?php theratio_posted_in(); ?>
			</div>

	    <?php }elseif( $format == 'link' ){ ?>

			<?php if( $text_link ){ ?>
			<div class="link-box">
				<i class="ot-flaticon-link"></i>
				<a href="<?php echo esc_url( $link_link ); ?>"><?php echo esc_html( $text_link ); ?></a>
			</div>
			<?php } ?>
			<div class="entry-media">
	        	<?php theratio_posted_in(); ?>
	        </div>

	    <?php }elseif( $format == 'quote' ){ ?>
			
			<div class="quote-box font-second">
				<div class="quote-text">
					<?php echo esc_html( $quote_text ); ?>
					<span><?php echo esc_html( $quote_name ); ?></span>
				</div>
			</div>
			<div class="entry-media">
	        	<?php theratio_posted_in(); ?>
	        </div>

	    <?php }elseif ( has_post_thumbnail() ) { ?>

	        <div class="entry-media post-cat-abs">
	            <a href="<?php the_permalink(); ?>">
	                <?php the_post_thumbnail(); ?>
	            </a>
	            <?php theratio_posted_in(); ?>
	        </div>
	        
	    <?php }else{ ?>
			
			<div class="entry-media">
	        	<?php theratio_posted_in(); ?>
	        </div>

	    <?php } ?>

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