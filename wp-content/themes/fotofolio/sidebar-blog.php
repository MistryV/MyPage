<div class="sidebar-blog grid_5 alpha omega">
  <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'blog-sidebar' ) ) : ?> 
  <div class="cat-desc">
    <p><?php _e( 'Widget Section', WPOP_THEME_SLUG ); ?></p>
  </div>
  <?php endif; ?>
</div>
