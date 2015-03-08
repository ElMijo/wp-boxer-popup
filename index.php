<?php
/**
 * Plugin Name: Wordpress Exit Popup
 * Plugin URI: https://github.com/ElMijo/wp-boxer-popup
 * Description: Un plugin para wordpress que permite mostrar una ventaana popup, basado en la libreria jquery.boxer.
 * Version: Version 1.0
 * Author: Jerry Anselmi
 * Author URI: https://github.com/ElMijo
 */

define( 'BOXERPOPPUP_ROOT_FILE', __FILE__ );
define( 'BOXERPOPPUP_ROOT_PATH', dirname( __FILE__ ) );
define( 'BOXERPOPPUP_ROOT_URL', plugins_url( '', __FILE__ ) );
define( 'BOXERPOPPUP_PLUGIN_VERSION', '1.0');
define( 'BOXERPOPPUP_PLUGIN_SLUG', basename( dirname( __FILE__ ) ) );
define( 'BOXERPOPPUP_PLUGIN_BASE', plugin_basename( __FILE__ ) );

include_once BOXERPOPPUP_ROOT_PATH.'/inc/wp-simple-exitpopup.php';
include_once BOXERPOPPUP_ROOT_PATH.'/inc/wp-simple-exitpopup-colums.php';
include_once BOXERPOPPUP_ROOT_PATH.'/inc/wp-simple-exitpopup-frontend.php';

?>