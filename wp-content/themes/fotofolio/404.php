<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Wordspop
 * @subpackage Fotofolio_Landscape
 */

get_header();
get_sidebar();
?>
<div class="main grid_17">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <h2 class="title"><?php _e( '404 Not Found', WPOP_THEME_SLUG ); ?></h2>
  <div class="stage">
    <div class="slide">
    </div>
  </div>
  <div class="intro">
    <?php the_content(); ?>
  </div>

  <div class="section">
    <div class="clear"></div>
  </div>
  <?php endwhile; endif;?>		
</div> <!-- end of main -->
<div class="clear"></div>
<?php get_footer(); ?>
