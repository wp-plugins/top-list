<?php

/**
 * Top List
 *
 * @link              http://www.nilambar.net
 * @since             1.0.0
 * @package           Top_List
 *
 * @wordpress-plugin
 * Plugin Name:       Top List
 * Plugin URI:        https://wordpress.org/plugins/top-list/
 * Description:       A plugin for making Listing site.
 * Version:           1.0.0
 * Author:            Nilambar Sharma
 * Author URI:        http://www.nilambar.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       top-list
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define
define( 'TOP_LIST_NAME', 'Top List' );
define( 'TOP_LIST_SLUG', 'top-list' );
define( 'TOP_LIST_BASENAME', basename( dirname( __FILE__ ) ) );
define( 'TOP_LIST_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'TOP_LIST_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
define( 'TOP_LIST_TEMPLATES_DIR', TOP_LIST_DIR . '/public/templates' );
define( 'TOP_LIST_POST_TYPE_LIST', 'list' );
define( 'TOP_LIST_TAX_TYPE_LIST_CATEGORY', 'list_category' );
define( 'TOP_LIST_TAX_TYPE_LIST_TAG', 'list_tag' );
define( 'TOP_LIST_POST_TYPE_LIST_ITEM', 'list_item' );
/**
 * The code that runs during plugin activation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-top-list-activator.php';

/**
 * The code that runs during plugin deactivation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-top-list-deactivator.php';

/** This action is documented in includes/class-top-list-activator.php */
register_activation_hook( __FILE__, array( 'Top_List_Activator', 'activate' ) );

/** This action is documented in includes/class-top-list-deactivator.php */
register_deactivation_hook( __FILE__, array( 'Top_List_Deactivator', 'deactivate' ) );

/** Include core file */
require plugin_dir_path( __FILE__ ) . 'includes/top-list-core-functions.php';

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-top-list.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_top_list() {

	$plugin = new Top_List();
	$plugin->run();

}
run_top_list();

