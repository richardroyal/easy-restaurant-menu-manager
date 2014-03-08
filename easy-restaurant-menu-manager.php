<?php
/*
Plugin Name: Easy Restaurant Menu Manager
Plugin URI: http://www.sailabs.co/products/easy-restaurant-menu-manager-wordpress/
Description: Makes it easy for a restaurant to maintain an online menu. Includes categories, prices and descriptions that are a snap to update.
Version: 1.5.0
Author: Sarah Tebo, Richard Royal
Author URI: http://www.sailabs.co
*/


/*
Copyright (C) 2012, 2013, 2014 SAI Digital
@author Richard Royal, Sarah Tebo

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


defined('WP_PLUGIN_URL') or die('Restricted access');

global $wpdb;
define('WPRMM_PATH',ABSPATH.PLUGINDIR."/easy-restaurant-menu-manager/");
define('WPRMM_URL',WP_PLUGIN_URL."/easy-restaurant-menu-manager/");
define('WPRMM_MENU_DB', strtolower($wpdb->prefix.'wprmm_menus'));
define('WPRMM_CATEGORY_DB', strtolower($wpdb->prefix.'wprmm_categories'));
define('WPRMM_ITEM_DB', strtolower($wpdb->prefix.'wprmm_items'));
define('WPRMM_ICON_DB', strtolower($wpdb->prefix.'wprmm_icons'));
define('WPRMM_ADMIN_URL',"wprmm-menu-setup");
define('WPRMM_ADMIN_ICON_URL',"wprmm-item-icons");
define('WPRMM_ADMIN_PARSE',"wprmm-page");
define('WPRMM_ADMIN_ICON_PARSE',"wprmm-icon-page");
define('WPRMM_CAPABILITY','edit_pages');
define('WPRMM_ROUTE',get_bloginfo('url').'/?wprmm-routing=');
define('WPRMM_CRUD',get_bloginfo('url').'/?wprmm-routing=crud');
define('WPRMM_EXTENDED_DB_VERSION','1.0');
define('WPRMM_HELP','help');
require_once(ABSPATH.'wp-admin/includes/upgrade.php');
require_once("lib/db_setup.php");
require_once("lib/functions.php");
require_once("admin/functions.php");
require_once("lib/class.menu.php");
require_once("lib/class.category.php");
require_once("lib/class.item.php");
require_once("lib/class.icon.php");
require_once("views/view.items.php");
require_once("views/layouts.php");
require_once("views/view.menu.php");
require_once("views/view.printer-friendly.php");
require_once("views/view.feed.php");






/* run setup scripts on activation */
register_activation_hook(__FILE__,'wprmm_install_plugin');





/**
 *   Admin page Routes and Callbacks
 */
function wp_restaurant_admin(){require_once("admin/manage-menus.php");}
function wp_restaurant_admin_category(){require_once("admin/manage-categories.php");}
function wp_restaurant_admin_item(){require_once("admin/manage-items.php");}
function wp_restaurant_item_icons(){require_once("admin/icons/dispatcher.php");}
function wp_restaurant_global_settings(){require_once("admin/global-settings.php");}
function wprmm_admin_menu() {
  if (current_user_can(WPRMM_CAPABILITY)) {
    $title = "WP Restaurant Menu Manager - "; 
    // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    add_menu_page($title . "Setup Menus", "Manage Menus", WPRMM_CAPABILITY, WPRMM_ADMIN_URL, "wp_restaurant_admin");
    // add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
    add_submenu_page( WPRMM_ADMIN_URL, $title.'Custom Item Icons', "Item Icons", WPRMM_CAPABILITY, WPRMM_ADMIN_ICON_URL, "wp_restaurant_item_icons" );
    add_submenu_page( WPRMM_ADMIN_URL, $title.'Global Setting', "Settings", WPRMM_CAPABILITY, "wprmm-global-settings", "wp_restaurant_global_settings" );
  }
}add_action('admin_menu', 'wprmm_admin_menu');






/**
 *  Register Frontend CSSs
 */
function wprmm_stylesheets() {
  if(!is_admin()){
    wp_enqueue_style('wprmm-style', WPRMM_URL.'css/style.css');  
    wp_enqueue_style('wprmm-tooltip-style', WPRMM_URL.'css/wprmm-tooltip.css');
    wp_enqueue_style('wprmm-custom-db-style', get_bloginfo('url').'/?wprmm-routing=custom-css');  
    if(file_exists(WPRMM_PATH.'css/custom.css')){
      wp_enqueue_style('wprmm-custom-style', WPRMM_URL.'css/custom.css');
    }
  } 
}add_action('wp_print_styles', 'wprmm_stylesheets');




/**
 *  Register frontend JS for ToolTip
 */
function wprmm_js() {
  if(!is_admin()){
    wp_enqueue_script('jquery');
    wp_enqueue_script("bootstrap-tooltip", WPRMM_URL.'js/bootstrap-tooltip.js', array('jquery'), '2.0.1', true);
    wp_enqueue_script("wprmm-style", WPRMM_URL.'js/wprmm.js', array('jquery', 'bootstrap-tooltip'), '1.0.0', true);
  }
}add_action('wp_enqueue_scripts', 'wprmm_js');





/**
 *  Register CSS for Admin Pages
 */
function wprmm_admin_register_css(){
  wp_enqueue_style('wprmm-admin-style', WPRMM_URL.'css/admin.css');
  wp_enqueue_style('thickbox');
}add_action('admin_init', 'wprmm_admin_register_css');



/*** Register admin JS */
function wprmm_admin_scripts() {
  if(isset($_GET['page']) && ($_GET['page'] == WPRMM_ADMIN_URL || $_GET['page'] == WPRMM_ADMIN_ICON_URL)) {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script('wprmm-admin', WPRMM_URL.'/js/admin.js', array('jquery','media-upload','thickbox'));
    wp_enqueue_script('wprmm-admin');
  }
}add_action('admin_print_scripts', 'wprmm_admin_scripts');







/*** Use Shortcode API to output menus on frontend */
function wprmm_shortcode_handler($atts, $content=null, $code=""){

  extract( shortcode_atts( array('categories' => 'all'), $atts ) );

  $categories = str_replace( ' ', '', $categories );
  if( !empty($categories) && $categories != 'all' && preg_match( '/^[-,0-9]+$/', $categories ) ){
    $categories = explode( ',', $categories );
  }

  return wprmm_get_menu($atts, $categories);
  
}add_shortcode('WP_Restaurant_Menu', 'wprmm_shortcode_handler');






/**
 *  Setup custom URL for Export Route and Create New
 */
function wprmm_parse_export($wp) {
    // only process requests POST'ed to "/?wprmm-routing=export"
    if (array_key_exists('wprmm-routing', $wp->query_vars) && $wp->query_vars['wprmm-routing'] == 'export') {
      echo wprmm_get_printer_friendly_menu($_GET['menu_id']);
      die();exit();
    }
}add_action('parse_request', 'wprmm_parse_export');

function wprmm_parse_crud($wp) {
    // only process requests POST'ed to "/?wprmm-routing=crud"
    if (array_key_exists('wprmm-routing', $wp->query_vars) && $wp->query_vars['wprmm-routing'] == 'crud') {
      include('admin/crud-routing.php');
      die();exit();
    }
}add_action('parse_request', 'wprmm_parse_crud');


function wprmm_parse_asset($wp) {
    // Output Custom CSS from Database GET "/?wprmm-routing=custom-css"
    if (array_key_exists('wprmm-routing', $wp->query_vars) && $wp->query_vars['wprmm-routing'] == 'custom-css') {
      $custom_css = get_option('wprmm_custom_css');
      header( 'Content-Type: text/css' );
      echo $custom_css;
      die();exit();
    }
    // Output Custom Print CSS from Database GET "/?wprmm-routing=custom-print-css"
    if (array_key_exists('wprmm-routing', $wp->query_vars) && $wp->query_vars['wprmm-routing'] == 'custom-print-css') {
      $custom_css = get_option('wprmm_custom_print_css');
      header( 'Content-Type: text/css' );
      echo $custom_css;
      die();exit();
    }    
}add_action('parse_request', 'wprmm_parse_asset');


function wprmm_parse_rss2($wp) {
    // Output Custom CSS from Database GET "/?wprmm-routing=rss2"
    if (array_key_exists('wprmm-routing', $wp->query_vars) && $wp->query_vars['wprmm-routing'] == 'rss2') {
      echo wpermm_rss2( (int) $_GET['menu_id'] );
      die();exit();
    }
}add_action('parse_request', 'wprmm_parse_rss2');


function wprmm_parse_query_vars($vars) {
    $vars[] = 'wprmm-routing';
    return $vars;
}add_filter('query_vars', 'wprmm_parse_query_vars');

?>
