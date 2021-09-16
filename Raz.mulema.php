/**
 * Plugin Name:       Mulema
 * Plugin URI:        https://miticher.com
 * Description:       Multi level marketing con woocommerce.
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Raziel Alcaraz
 * Author URI:        https://razielalcaraz.com/
 * License:           GPL v2 or later
 */


 /**
  * Register the "book" custom post type
  */
 function pluginprefix_setup_post_type() {
     register_post_type( 'book', ['public' => true ] );
 }
 add_action( 'init', 'pluginprefix_setup_post_type' );


 /**
  * Activate the plugin.
  */
 function pluginprefix_activate() {
     // Trigger our function that registers the custom post type plugin.
     pluginprefix_setup_post_type();
     // Clear the permalinks after the post type has been registered.
     flush_rewrite_rules();
 }
 register_activation_hook( __FILE__, 'pluginprefix_activate' );
