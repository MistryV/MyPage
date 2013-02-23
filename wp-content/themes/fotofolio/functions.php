<?php
/**
 * @package Wordspop
 * @subpackage Fotofolio_Landscape
 */

/**
 * Register the supported menus
 */
register_nav_menus(array(
    'main-menu' => __( 'Main Menu' ),
));

/**
 * Load initial WPop script
 */
require_once dirname(__FILE__) . '/libs/wpop/init.php';
