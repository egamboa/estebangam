<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<?php 
global $theme_option; 
global $wp_query;
    $seo_title = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_title", true);
    $seo_description = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_description", true);
    $seo_keywords = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_keywords", true);
?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="author" content="Davis Hoang" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Page Title 
	================================================== -->
	<title><?php bloginfo('name'); ?>  <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<!-- For SEO -->
	<?php if($seo_description!="") { ?>
	<meta name="description" content="<?php echo $seo_description; ?>">
	<?php }elseif($theme_option['seo_des']){ ?>
	<meta name="description" content="<?php echo $theme_option['seo_des']; ?>">
	<?php } ?>
	<?php if($seo_keywords!="") { ?>
	<meta name="keywords" content="<?php echo $seo_keywords; ?>">
	<?php }elseif($theme_option['seo_key']){ ?>
	<meta name="keywords" content="<?php echo $theme_option['seo_key']; ?>">
	<?php } ?>
	<!-- End SEO-->
	
	<!--Stylesheet-->

	<!--[if IE 7]>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fontello-ie7.css">
	<![endif]-->
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!--[if lt IE 8]>
	<style>
	/* For IE < 8 (trigger hasLayout) */
	.clearfix {
		zoom:1;
	}
	</style>
	<![endif]-->
	
	<!-- Favicons -->
	<link rel="shortcut icon" href="<?php echo $theme_option['favicon']['url']; ?>" type="image/png">
	
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- Preloader -->
	<div id="loader">
	  <div id="loaderInner"></div>
	</div>
<!--Wrapper-->
<div id="wrapper">
	<!--Header-->
	<header id="header">
		<!--Main header-->
			<div class="mainHeader">
			<!--Container-->
			<div class="container clearfix">
				<!--Navigation-->
					<nav id="mainNav" >
						<a href="#" class="mobileBtn" ><i class="icon-menu"></i></a>
						<?php 
							  wp_nav_menu( 
							  array( 
									'theme_location' => 'primary',
									'container' => '',
									'menu_class' => '', 
									'menu_id' => '',
									'menu'            => '',
									'container_class' => '',
									'container_id'    => '',
									'echo'            => true,
									 'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
									 'walker'            => new wp_bootstrap_navwalker(),
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           => 0,        
								)
							 ); ?>
					</nav>
				<!--End navigation-->
			<!--End container-->
			</div>
		<!--End main header-->
			</div>
	</header>
	<!--End header-->