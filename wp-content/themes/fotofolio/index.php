<?php 
get_header();
get_sidebar();
?>
<div class="main grid_17">
  <div class="slideshow">
    <?php $the_query = new WPop_Slider( null, null, sprintf( 'cat=-%d', wpop_get_option( 'blog' ) ) ); ?><?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <div class="slide" style="display: none;">
      <?php if ( wpop_get_option( 'slider_caption' ) == 'yes' ): ?><h2><?php the_title(); ?></h2><?php endif; ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'single-post-thumbnail', array( 'title' => the_title( '', '', false ) ) ); ?></a>
    </div>
    <?php endwhile; ?>
  </div>

  <?php if ( wpop_get_option( 'show_latest' ) == 'yes' ): ?>
  <div class="latest grid_17 alpha omega">
    <h2 class="grid_5 alpha omega"><?php wpop_get_option( 'recentlyadded_caption', true ); ?></h2>
    <div class="photos grid_12 alpha omega">
      <?php $the_query = new WP_Query ( sprintf( 'cat=-%d,-%d&posts_per_page=6', wpop_get_option( 'testimonial' ), wpop_get_option( 'blog' ) ) ); ?>
      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php  the_post_thumbnail( 'navigation-thumbnail', array( 'title' => the_title( '', '', false ) ) ); ?></a>
      <?php endwhile; ?>
      <div class="clear"></div>
    </div>
  </div>
  <?php endif; ?>

  <?php if ( wpop_get_option( 'intro_enable') == 'yes' ): ?>
    <?php if ( wpop_get_option( 'testimonial_enable') == 'yes' ): ?>
  <div class="intro grid_8 alpha omega">
    <?php else: ?>
  <div class="intro grid_17 alpha omega">
    <?php endif; ?>
    <p><?php wpop_get_option( 'intro', true ); ?></p>
  </div>
  <?php endif; ?>

  <?php if ( wpop_get_option( 'testimonial_enable') == 'yes' ): ?>
    <?php if ( wpop_get_option( 'intro_enable' ) == 'yes' ): ?>
  <div class="testimonial grid_7 prefix_1 alpha omega">
    <?php else: ?>
  <div class="testimonial grid_17 alpha omega">
    <?php endif; ?>
    <h2><?php wpop_get_option( 'testimonial_caption', true ); ?></h2>
    <?php $the_query = new WP_Query ( sprintf( 'cat=%d&posts_per_page=1&orderby=rand', wpop_get_option( 'testimonial' ) ) ); ?>
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; ?>
  </div>
  <?php endif; ?>

</div> <!-- end of main -->
<div class="clear"></div>
<?php get_footer(); ?>