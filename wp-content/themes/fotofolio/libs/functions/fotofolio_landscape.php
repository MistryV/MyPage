<?php
/**
 * Fotofolio Landscape extra functions
 *
 * @category   Wordspop
 * @package    Fotofolio_Landscape
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */

/**
 * WP hook: init
 *
 * @return void
 */
function fotofolio_landscape_init() {
    if ( !is_admin() ) {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery_mousewheel', WPOP_THEME_URL . '/js/fancybox/jquery.mousewheel-3.0.2.pack.js', array( 'jquery' ), WPOP_THEME_VERSION );
        wp_enqueue_script( 'jquery_hoverintent', WPOP_THEME_URL . '/js/jquery.hoverIntent.minified.js', array( 'jquery' ), WPOP_THEME_VERSION );
        wp_enqueue_script( 'superfish', WPOP_THEME_URL . '/js/superfish/superfish.js', array( 'jquery' ), WPOP_THEME_VERSION );
        wp_enqueue_script( 'jquery_xfade', WPOP_THEME_URL . '/js/jquery.xfade-1.0.min.js', array( 'jquery' ), WPOP_THEME_VERSION );
        wp_enqueue_script( 'jquery_fancybox', WPOP_THEME_URL . '/js/fancybox/jquery.fancybox-1.3.0.pack.js', array( 'jquery' ), WPOP_THEME_VERSION );
        wp_enqueue_script( 'fotofolio_landscape', get_bloginfo( 'template_url' ) . '/js/init.js', array( 'superfish', 'jquery_xfade', 'jquery_fancybox' ), WPOP_THEME_VERSION );
    }
}

/**
 * Image resizing routines.
 *
 * @category   Wordspop
 * @package    WPop
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */
if(function_exists( 'add_theme_support' )) {
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'single-post-thumbnail', 668, 351, true );
    add_image_size( 'single-post-thumbnail-lands', 379, 568, true );
    add_image_size( 'single-post-thumbnail-square', 668, 668, true );
    add_image_size( 'category-thumbnail', 110, 110, true );
    add_image_size( 'navigation-thumbnail', 68, 68, true );
}

/**
 * Output the image html structure reflect to the dimension
 *
 * @return void
 */
function fotofolio_landscape_image() {
    $id_thumb = get_post_thumbnail_id();
    $image_info = wp_get_attachment_image_src( $id_thumb, 'full' );

    if ( $image_info[1] > $image_info[2] ) {
        echo '<div class="stage">';
        echo '<div class="slide">';
        echo '<a href="' . $image_info[0] . '" class="full" title="' . the_title( '', '', false ) . '">';
        the_post_thumbnail( 'single-post-thumbnail', array( 'title' => the_title( '', '', false ) ) );
        echo '</a>';

        if ( wpop_get_option( 'show_exif' ) == 'yes' ) {
            $exif = fotofolio_landscape_fexif( $image_info[0] );
            if ( $exif ) {
                echo '<div class="exif">' . $exif  . '</div>';
            }
        }

        echo '</div>';
        if ( get_the_content() && !is_page() ) {
            echo '<div class="intro">';
            the_content();
            echo '</div>';
        }
        echo '</div>';
    } else if ($image_info[1] < $image_info[2]) {
        echo '<div class="stage">';
        echo '<div class="slide-lands">';
        echo '<a href="' . $image_info[0] . '" class="full" title="' . the_title( '', '', false ) . '">';
        the_post_thumbnail( 'single-post-thumbnail-lands', array( 'title' => the_title( '', '', false ) ) );
        echo '</a>';

        if ( wpop_get_option( 'show_exif' ) == 'yes' ) {
            $exif = fotofolio_landscape_fexif( $image_info[0] );
            if ( $exif ) {
                echo '<div class="exif">' . $exif  . '</div>';
            }
        }

        echo '</div>';
        if ( get_the_content() && !is_page() ) {
            echo '<div class="intro-lands">';
            the_content();
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="stage">';
        echo '<div class="slide">';
        echo '<a href="' . $image_info[0] . '" class="full" title="' . the_title( '', '', false ) . '">';
        the_post_thumbnail( 'single-post-thumbnail-square', array( 'title' => the_title( '', '', false ) ) );
        echo '</a>';

        if ( wpop_get_option( 'show_exif' ) == 'yes' ) {
            $exif = fotofolio_landscape_fexif( $image_info[0] );
            if ( $exif ) {
                echo '<div class="exif">' . $exif  . '</div>';
            }
        }

        echo '</div>';
        if ( get_the_content() && !is_page() ) {
            echo '<div class="intro">';
            the_content();
            echo '</div>';
        }
        echo '</div>';
    }
}

/**
 * Find the whether if category in specified category or not
 *
 * @param mixed $category
 * @return bool
 */
function fotofolio_landscape_in_category( $category ) {
    if ( !( is_category() || is_single() ) ) {
        return false;
    }

    $obj_specified_category = is_numeric( $category ) ? get_category( $category ) : get_category_by_slug( $category );
    if ( empty( $obj_specified_category->cat_ID ) ) {
        return false;
    }

    if ( is_category() ) {
        $current_category_ID = get_query_var( 'cat' );
        return ( $obj_specified_category->cat_ID == $current_category_ID or cat_is_ancestor_of( $obj_specified_category->cat_ID,$current_category_ID ) );
    } else {
        global $wp_query;
        $obj_post = $wp_query->get_queried_object();
        if ( empty( $obj_post->ID ) ) {
            return false;
        }

        if ( in_category( $obj_specified_category->cat_ID, $obj_post->ID ) ) {
            return true;
        } else {
            return in_category( get_term_children( $obj_specified_category->cat_ID, 'category' ), $obj_post->ID) ;
        }
    }
}

/**
 * Get formatted html of exif data.
 *
 * @param string $file Absolute path of file.
 *
 * @return mixed A formatted string or FALSE on failure.
 */
function fotofolio_landscape_fexif( $file ) {
    $exif = WPop::call( 'wpop_exif_data', $file );
    if ( !$exif ) {
        return false;
    }

    $html = '';

    if ( !empty( $exif[ 'make'] ) || !empty( $exif[ 'model'] ) || !empty( $exif[ 'date'] ) ) {
        $html .= __( 'This photo was taken', WPOP_THEME_SLUG );
        $html .= !empty ( $exif[ 'date' ] ) ?
                 sprintf(
                  __( ' on <strong>%s</strong> at <strong>%s</strong>', WPOP_THEME_SLUG ),
                  date( get_option( 'date_format' ), $exif[ 'date' ] ),
                  date( get_option( 'time_format' ), $exif[ 'date' ] )
                 ) : '';
        
        $html .= __( ' using ', WPOP_THEME_SLUG );
        $html .= !empty( $exif[ 'make' ] ) ? "<strong>{$exif[ 'make' ]}</strong>" : '';
        $html .= !empty( $exif[ 'model' ] ) ? " <strong>{$exif[ 'model' ]}</strong>" : '';
    }
    
    $shotinfo = array();
    if ( !empty( $exif[ 'exposure' ] ) && !empty( $exif[ 'aperture' ] ) ) {
        $shotinfo[] = sprintf( __( 'Exposure: <strong>%s</strong> at <strong>%s</strong>;', WPOP_THEME_SLUG ), $exif[ 'exposure' ], $exif[ 'aperture' ] );
    }
    
    if ( $exif[ 'focal' ] ) {
        $shotinfo[] = sprintf( __( 'Focal Length: <strong>%s</strong> mm;', WPOP_THEME_SLUG ), $exif[ 'focal' ] );
    }

    if ( $exif[ 'iso' ] ) {
        $shotinfo[] = sprintf( __( 'ISO Speed Rating: <strong> ISO %s</strong>;', WPOP_THEME_SLUG ), $exif[ 'iso' ] );
    }

    $html .= !empty( $shotinfo ) ? "<br />\n" .  implode( ' ', $shotinfo ) : '';

    return $html;
}
