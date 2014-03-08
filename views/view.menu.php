<?php

/** 
 * Displays HTML Menu on frontend.
 *
 * @param int $atts['id'] is the menu id
 * @param $categories array of category ids to pull else pull all from menu.
 */
function wprmm_get_menu( $atts, $category_ids='all' ){
  global $wpdb;
  $menu_id = $atts['id'];
  if(empty($atts['id']) || !is_numeric($atts['id']) ) return '';

  /* Get Menu, Categories, and Items */
  $menu = WPRMM_Menu::get_by_id($menu_id);
  if(empty($menu['id'])) return "Menu not found.";
  $categories = WPRMM_Category::get_all((int) $menu['id'], $category_ids);
  $items = WPRMM_Item::get_all((int) $menu['id']);

  /* Build HTML Output for menu */
  $m  = '<!-- SAI Digital Restaurant Menu Manager -->'."\r\n";
  $m .= '<div id="wprmm_menu_'.$menu['id'].'" class="wprmm_menu">'."\r\n";
  $m .= '<div class="menu_manager">'."\r\n";
  if($menu['show_title']){
    $m .= '<h1>'.$menu['name'].'</h1>'."\r\n";
  }
  $m .= '<p class="menu_desc">'.nl2br($menu['description']).'</p>'."\r\n";
  $m .= '<div class="menu_manager">'."\r\n";
  foreach($categories as $cat) {
    if($cat->active){
      $m .= '<div id="'.wprmm_css_name($cat->name).'" class="menu_category">'."\r\n";
      if($cat->show_title) $m .= '<h2>'.$cat->name.'</h2>'."\r\n";
      if($cat->show_description) $m .= '<p class="menu_category_desc">'.nl2br($cat->description).'</p>'."\r\n";

      $m .=    wprmm_view_items($cat, $items);

      $m .= '</div>'."\r\n";
    }    
  }
  
  if($menu['show_link']){
    $m .= '<p class="wprmm_print"><a href="'.$menu['print_url'].'" target="_blank">Print</a></p>';
  }
  $m .= '</div>';
  $m .= '</div>';
  $m .= '</div>';


  return $m;
}

?>
