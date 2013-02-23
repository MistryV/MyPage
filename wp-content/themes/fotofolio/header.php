<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/grid.css?ver=<?php echo WPOP_THEME_VERSION ?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/js/fancybox/jquery.fancybox-1.3.0.css?ver=<?php echo WPOP_THEME_VERSION ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/js/superfish/superfish.css?ver=<?php echo WPOP_THEME_VERSION ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/js/superfish/superfish-vertical.css?ver=<?php echo WPOP_THEME_VERSION ?>" type="text/css" media="screen" />
<?php wp_head(); ?>
<script type="text/javascript">
var FotofolioLandscape_Settings = {
  sliderEffect: '<?php wpop_get_option( 'slider_effect', true ); ?>',
  sliderSpeed: <?php wpop_get_option( 'slider_speed', true ); ?>,
  sliderTimeout: <?php echo wpop_get_option( 'slider_timeout' ); ?>,
  fancybox_autoScale: <?php echo wpop_get_option( 'fancybox_autoscale' ) ? 'true' : 'false' ?>,
  fancybox_titleShow: <?php echo wpop_get_option( 'fancybox_titleshow' ) ? 'true' : 'false' ?>,
  fancybox_titlePosition: '<?php echo wpop_get_option( 'fancybox_titleposition' ) ?>',
  fancybox_centerOnScroll: <?php echo wpop_get_option( 'fancybox_centeronscroll' ) ? 'true' : 'false' ?>,
  fancybox_hideOnContentClick: <?php echo wpop_get_option( 'fancybox_hideoncontentclick' ) ? 'true' : 'false' ?>,
  preventRightClick: <?php echo ( wpop_get_option( 'prevent_rightclick' ) == 'yes' ? 'true' : 'false' ) . "\n"; ?>
};
</script>
<!--[if IE 6]>
<script src="<?php bloginfo('template_url'); ?>/js/belatedpng.js?ver=<?php echo WPOP_THEME_VERSION ?>"></script>
<script>
DD_belatedPNG.fix('img, .slideshow, .wordspop a, .testimonial h2, .testimonial p');
</script>
<style type="text/css">
slideshow, .latest { background: none !important; }
</style>
<![endif]-->
<?php if ( wpop_get_option( 'favicon' ) ): ?><link rel="shortcut icon" href="<?php echo wpop_get_option( 'favicon' ); ?>" /><?php endif; ?>
</head>
<body <?php body_class(); ?>>
<div class="container container_24"><div class="container2<?php if ( fotofolio_landscape_in_category( wpop_get_option( 'blog' ) ) ) echo ' single-blog'; ?>">