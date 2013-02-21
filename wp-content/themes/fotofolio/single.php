<?php
$blog_category = wpop_get_option( 'blog' );
if ( fotofolio_landscape_in_category( $blog_category ) ) {
    include_once( TEMPLATEPATH . '/single-blog.php' );
} else {
    include_once( TEMPLATEPATH . '/single-default.php' );
} 
