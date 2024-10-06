<!-- Main header start -->
<div class="octf-main-header">
	<div class="octf-area-wrap">
		<div class="container octf-mainbar-container">
			<div class="octf-mainbar">
				<div class="octf-mainbar-row octf-row">
					<div class="octf-col logo-col">
						<?php if ( theratio_get_option('logo') ) { ?>
						<div id="site-logo" class="site-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img <?php if ( theratio_get_option('logo_scroll') != '' ) echo 'class="logo-static"'; ?> src="<?php echo esc_url( theratio_get_option('logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
								<?php if ( theratio_get_option('logo_scroll') != '' ) { ?>
									<img class="logo-scroll" src="<?php echo esc_url( theratio_get_option('logo_scroll') ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
								<?php } ?>
							</a>
						</div>
						<?php } ?>
					</div>
					<div class="octf-col menu-col">
						<nav id="site-navigation" class="main-navigation">			
							<?php
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'menu_id'        => 'primary-menu',
									'container'      => 'ul',
								) );
							?>
						</nav><!-- #site-navigation -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
<!-- Main header close -->