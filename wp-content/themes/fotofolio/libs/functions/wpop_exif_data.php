<?php
/**
 * Fotofolio Landscape extra functions
 *
 * @category   Wordspop
 * @package    Fotofolio_Landscape
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 * @since      Version: 1.2.2
 */
 
/**
 * Read the exif data of file.
 *
 * @param   string $file Absolute path of file.
 *
 * @return  mixed An array of exif data or FALSE on failure.
 * @since   Version: 1.2.2
 */
function wpop_exif_data( $file ) {
    // EXIF library is unsupported
    if ( !function_exists( 'exif_read_data' ) ) {
        return false;
    }

    $data = array(
        'width'         => 0,
        'height'        => 0,
        'make'          => '',
        'model'         => '',
        'aperture'      => '',
        'shutter_speed' => '',
        'exposure'      => '',
        'iso'           => '',
        'focal'         => 0,
        'date'          => 0
    );

    // Looking from cache first.
    $info = false; wp_cache_get( 'exif_' . md5( $file ) );
    if ( !$info ) {
        $info = @exif_read_data( $file );
        if ( !$info || !isset( $info[ 'Make' ] )  || !isset( $info[ 'Model' ] ) ) {
            return false;
        }
    }

    // Add data to cache if needed.
    wp_cache_add( 'exif_' . md5( $file ), $info );

    $data[ 'width' ]         = @$info[ 'COMPUTED' ][ 'Width' ]; // in pixels
    $data[ 'height' ]        = @$info[ 'COMPUTED' ][ 'Height' ]; // in pixels
    $data[ 'make' ]          = @$info[ 'Make' ];
    $data[ 'model' ]         = @$info[ 'Model' ];
    $data[ 'exposure' ]      = @$info[ 'ExposureTime' ]; // in sec
    $data[ 'aperture' ]      = @$info[ 'COMPUTED' ][ 'ApertureFNumber' ];
    $data[ 'shutter_speed' ] = @$info[ 'ExposureTime' ]; // in sec
    $data[ 'iso' ]           = @$info[ 'ISOSpeedRatings' ];

    if ( array_key_exists( 'FocalLength', $info ) ) {
        list($fls, $flp) = explode( '/', $info[ 'FocalLength' ] );
        $data[ 'focal' ]         = ( ( int ) $fls ) / ( ( int ) $flp ) ; // in mm
    }

    if ( array_key_exists( 'DateTimeOriginal', $info ) && trim( $info[ 'DateTimeOriginal' ] ) != '' ) {
        $data[ 'date' ] = strtotime( $info[ 'DateTimeOriginal' ] );
    } else if ( !empty( $info[ 'DateTimeOriginal' ] ) ) {
        $data[ 'date' ] = $info[ 'FileDateTime' ];
    }

    return $data;
}
