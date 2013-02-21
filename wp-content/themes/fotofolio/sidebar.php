<div class="sidebar grid_6">
  <h1><a href="<?php bloginfo( 'url' ); ?>"><img src="<?php if ( wpop_get_option( 'logo' ) ): echo wpop_get_option( 'logo' ); else: echo get_bloginfo( 'template_url' ) . '/images/logo.png'; endif; ?>" alt="logo" /></a></h1>
  <?php wp_nav_menu( 'theme_location=main-menu&container=ul&container_class=nav&menu_class=nav sf-menu sf-vertical' ); ?>
  <div class="clear">&nbsp;</div>
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('main-sidebar') ) : ?>
  <div class="widgz here">
    <h2><?php _e( 'Categories', WPOP_THEME_SLUG ); ?></h2>		
    <ul><?php wp_list_categories( 'title_li=&show_empty=0&depth=1' ); ?></ul>
  </div>
  <?php endif; ?>
<?php include( TEMPLATEPATH . '/copyright.php' ); ?>
</div> <!-- end of sidebar -->
