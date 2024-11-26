<!doctype html>
  <!--[if IE 8]>
    <html class="ie ie8">
  <![endif]-->

  <!--[if IE 9]>https://thenationalstg.wpengine.com/wp-admin/upload.php
    <html class="ie ie9">
  <![endif]-->

<html>

	<head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <title><?php
        /*
         * Print the <title> tag based on what is being viewed.
         */
        global $page, $paged;

        wp_title( '|', true, 'right' );

        // Add the blog name.
        bloginfo( 'name' );

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";

        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 )
            echo ' | ' . sprintf( __( 'Page %s', 'localize' ), max( $paged, $page ) );

        ?></title>
		
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />

        <!--[if IE 7]>
            <style type="text/css">
                .wpcf7-not-valid{ border-width: 2px }
            </style>
        <![endif]-->
        
        <?php
            wp_deregister_script('jquery');
            
            wp_enqueue_script('jquery', get_bloginfo( 'template_url' ).'/js/jquery-1.11.1.min.js', array(),'1.11.1',false);
            wp_enqueue_script('vendor', get_bloginfo('template_url').'/js/vendor.min.js', array(), '1.0.0', false);
            wp_enqueue_script('custom', get_bloginfo( 'template_url' ).'/js/jquery.custom.js', array(),'1.0.0',false);
        ?>
        
        <?php wp_head(); ?>
        <link rel="shortcut icon" href="/wp-content/uploads/2015/04/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
        <script src="//use.typekit.net/gzb6ykl.js"></script>
        <script>try{Typekit.load();}catch(e){}</script>
</head> 
    <body <?php body_class(); ?>>
        <div class="header">

            <a href="<?php echo home_url('/'); ?>" class="sprite sprite-logo-main" title="<?php bloginfo('name') ?>"><span><?php bloginfo('name') . get_bloginfo( 'description', 'display' ) ?></span></a>
        </div>
        
        <div id="content" class="container-fluid container-home">
            <div class="row">
                <div class="left-nav col-lg-2 col-md-2 col-sm-3">
																				<a class="hidden-md hidden-lg hidden-xl" href="wp-content/uploads/2019/10/WiredScore_Fact-Sheet_The-National.pdf" target="_blank">
                    <img class="" style="max-width: 52px;width: 100%;margin:15px 0 0 15px;float: left;" src="/wp-content/uploads/2019/10/wired_logo.png" />
</a>
                    <a href="<?php echo home_url('/'); ?>" class="sprite sprite-logo-nav logo">
                        <span><?php bloginfo('name'); ?></span></a>
                    <a href="#" class="toggle-icon"></a>
                    <div class="nav-box">
                        <?php if (is_front_page()) : ?>
                            <?php wp_nav_menu( array('theme_location' => 'main_nav', 'container' => false)); ?>
                        <?php else : ?>
                            <?php wp_nav_menu( array('theme_location' => 'main_nav', 'container' => false)); ?>
                        <?php endif; ?>
                    </div>
                    <?php if (is_front_page()) : ?>
                        <?php wp_nav_menu( array('menu' => 'Homepage Main Menu', 'theme_location' => 'main_nav', 'container' => false, 'menu_class' => 'mobile-menu')); ?>
                    <?php else : ?>
                        <?php wp_nav_menu( array('theme_location' => 'main_nav', 'container' => false, 'menu_class' => 'mobile-menu')); ?>
                    <?php endif; ?>
					<a href="wp-content/uploads/2019/10/WiredScore_Fact-Sheet_The-National.pdf" target="_blank">
                    <img class="logo-bottom-new" style="max-width: 140px;width: 100%;margin: 0 auto;bottom:120px;" src="/wp-content/uploads/2019/10/wired_logo.png" />

					</a>
                    <a href="https://www.commerzreal.com/en/" class="logo-link" target="_blank">
					                    <img class="logo-bottom-new" style="max-width:320px;width:100%;margin:0 auto; bottom:0;" src="/wp-content/uploads/2019/08/CB-2017-CR-Logo-ATL_EN_RGB.png" />
                  </a>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 left-nav-placeholder"></div>