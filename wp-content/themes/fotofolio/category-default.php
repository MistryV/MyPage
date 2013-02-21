<?php 
get_header(); 
get_sidebar();
?>
<div class="main grid_17">
  <h2 class="title"><?php single_cat_title(); ?> <span style="color: #cecece;"><?php _e( 'Category', WPOP_THEME_SLUG ); ?></span></h2>
  <div class="this-category <?php echo category_description() ? 'grid_10' : 'grid_16'; ?>">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="this-category-photo"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'category-thumbnail', array( 'title' => the_title( '', '', false ) ) ); ?></a></div>
    <?php endwhile; ?>
    <div class="navigation">
      <div class="alignleft"><?php next_posts_link( __( 'Older', WPOP_THEME_SLUG ) ) ?></div>
      <div class="alignright"><?php previous_posts_link( __( 'Newer', WPOP_THEME_SLUG ) ) ?></div>
    </div>
  </div>
  <?php endif;?>

  <?php if( category_description() ) : ?>
  <div class="cat-desc grid_6">
    <?php echo category_description(); ?>
  </div>
  <?php endif; ?> 
</div> <!-- end of main -->
<div class="clear"></div>
<?php get_footer(); ?>