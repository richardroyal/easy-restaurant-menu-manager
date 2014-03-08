<?php
defined('WPRMM_PATH') or die();



/**
 *  Loads admin page from request via GET
 *  
 *  @echo admin php file
 */
function wprmm_load_admin_page(){
  $admin_page = empty( $_GET[WPRMM_ADMIN_PARSE] ) ? '' : $_GET[WPRMM_ADMIN_PARSE];
  switch($admin_page){
    ##  Menus ##
    case '':
      include("index-menus.php");
      break;
    case 'new-menu':
      include("new-menu.php");
      break;
    case 'edit-menu':
      include("edit-menu.php");
      break;
    ##  Category ##
    case 'index-category':
      include("index-category.php");
      break;
    case 'new-category':
      include("new-category.php");
      break;
    case 'edit-category':
      include("edit-category.php");
      break;
    ## Items ##
    case 'index-item':
      include("index-item.php");
      break;
    case 'new-item':
      include("new-item.php");
      break;
    case 'edit-item':
      include("edit-item.php");
      break;
  }
}


/**
 *  Load admin pages for admin
 */
function wprmm_load_admin_icon_page(){
  $admin_icon_page = empty($_GET[WPRMM_ADMIN_ICON_PARSE]) ? '' : $_GET[WPRMM_ADMIN_ICON_PARSE];

  switch($admin_icon_page){
    case '':
      require("icons/index.php");
      break;
    case 'new-icon':
      include("icons/new.php");
      break;
    case 'edit-icon':
      include("icons/edit.php");
      break;
  }
}



/**
 *  Build admin url
 *
 *  @param string $type "menu", "category", "item"
 *  @param string $page "edit-menu", "edit-category", "edit-item"
 *  @param int $id  the DB id of requested object
 *  @return string url of requested admin page
 */
function wprmm_admin_url($type,$page,$id){
  $req = WPRMM_ADMIN_PARSE.'='.$page.'&'.$type.'_id='.$id;
  $url = admin_url('admin.php?page='.WPRMM_ADMIN_URL.'&'.$req);
  return $url;
}

// Admin URLs for icon model
function wprmm_admin_icon_url($type,$page,$id){
  $req = WPRMM_ADMIN_ICON_PARSE.'='.$page.'&'.$type.'_id='.$id;
  $url = admin_url('admin.php?page='.WPRMM_ADMIN_ICON_URL.'&'.$req);
  return $url;
}




/**
 *  Save Menu on update and create
 */
function wprmm_save_menu(){
  if( !empty($_POST['save_menu']) && $_POST['save_menu'] == 'Save Menu' ) {
    $menu = $_POST['wprmm'];
    if(empty($menu['show_title'])) $menu['show_title'] = 0;
    if(empty($menu['show_link'])) $menu['show_link'] = 0;
    $menu = WPRMM_MENU::update($menu);
  }
}

/**
 *  Save Category on update and create
 */
function wprmm_save_category(){
  if( !empty($_POST['save_category']) && $_POST['save_category'] == 'Save Category' ) {
    $category = $_POST['wprmm'];
    if(empty($category['active'])) $category['active'] = 0;
    if(empty($category['show_title'])) $category['show_title'] = 0;
    if(empty($category['show_description'])) $category['show_description'] = 0;
    $category = WPRMM_CATEGORY::update($category);
  }
}

/**
 *  Save Item on update and create
 */
function wprmm_save_item(){
  if( !empty($_POST['save_item']) && $_POST['save_item'] == 'Save Item') {
    $item = $_POST['wprmm'];
    if(empty($item['active'])) $item['active'] = 0;
    if(empty($item['show_price'])) $item['show_price'] = 0;
    $item = WPRMM_ITEM::update($item);
  }
}


/**
 *  Save Item Icon on update and create
 */
function wprmm_save_icon(){
  if( !empty($_POST) && $_POST['save_item'] == 'Save Icon' ){
    $icon = $_POST['wprmm'];
    #if(empty($icon['show_price'])) $icon['show_price'] = 0;
    $icon = WPRMM_ICON::update($icon);
  }
}


/**
 *  WP Update messages
 */
function wprmm_update_message($m){
  $s = '<div id="message" class="updated below-h2">
          <p>'.$m.'</p>
        </div>';
  return $s;
}





/***  Return help link or un-help link */
function wprmm_help_link(){
  $l = $_SERVER['REQUEST_URI'];
  if( !empty($_GET[WPRMM_HELP]) ){
    $l = str_replace('&'.WPRMM_HELP.'=true','',$l);    
  }
  else{
    $l = $l.'&'.WPRMM_HELP.'=true'; 
  }
  return $l;
}


/**
 *  Print Admin help message
 */
function wprmm_get_help($main = array()){
  if(empty($_GET[WPRMM_HELP])) return '';
 
  if(empty($main)) $f = WPRMM_PATH.'admin/help/'.$_GET['wprmm-page'].'-help.php';
  else $f = WPRMM_PATH.'admin/help/index-menus-help.php';

  if($_GET['page'] == "wprmm-item-icons") $f =  WPRMM_PATH.'admin/help/index-item-icon-help.php';
   
  if(file_exists($f)){
    $s = '<div id="message" class="updated">'.file_get_contents($f).'</div>';

    print $s;
  }

}





/* Save Global Settings */
function wprmm_save_global_settings(){
  if( !empty($_POST)  && $_POST['save_options'] == 'Save Options'){
    $options = $_POST['wprmm'];
  
    $css = $options['custom_css'];
    update_option( 'wprmm_custom_css', $css );
  
    $css = $options['custom_print_css'];
    update_option( 'wprmm_custom_print_css', $css );
  }

}





/**
 *  Check user authorization by role name.
 *
 *  @see http://docs.appthemes.com/tutorials/wordpress-check-user-role-function/
 */
function wprmm_check_user_role($role){
  $user = wp_get_current_user();
  if( empty($user) ){
    return false;  
  } else {
    return in_array( $role, (array) $user->roles ); 
  }
}



/**
 *  Authorize logged in editors and admins to edit menu
 * 
 *  Role names are in options table: wp_user_roles
 */
function wprmm_editor_or_admin(){
  if( wprmm_check_user_role('editor') || wprmm_check_user_role('administrator') ){
    return true;  
  } else {
    return false;  
  }
}




/**
 * Converts saved category layout name to full layout name.
 */
function ermm_full_layout_name( $layout ){
  $name = $layout;
  $layouts = ermm_defined_layouts();
  foreach( ermm_defined_layouts() as $l ){
    if( $l['safe_name'] == $layout ){
      $name = $l['name'];
    }
  }
  return $name;
}




?>
