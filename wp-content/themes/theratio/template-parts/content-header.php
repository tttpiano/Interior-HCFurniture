<!-- #site-header-open -->
<header id="site-header" class="site-header <?php theratio_header_class(); ?>">

    <!-- #header-desktop-open -->
    
    <?php theratio_header_builder(); ?>
    
    <!-- #header-desktop-close -->

    <!-- #header-mobile-open -->
    
    <?php theratio_mobile_builder(); ?>
    <!-- #header-mobile-close -->

</header>
<!-- #site-header-close -->
<!-- #side-panel-open -->
<?php if ( !empty( theratio_get_option('is_sidepanel') ) && theratio_get_option('sidepanel_layout') != '' ) { ?>
    <div id="side-panel" class="side-panel <?php if( theratio_get_option('panel_left') ) echo 'on-left'; ?>">
        <a href="#" class="side-panel-close"><i class="ot-flaticon-close-1"></i></a>
        <div class="side-panel-block">
            <?php theratio_sidepanel_builder(); ?>
        </div>
    </div>
<?php } ?>
<!-- #side-panel-close -->