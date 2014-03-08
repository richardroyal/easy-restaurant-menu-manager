<?php
defined('WPRMM_PATH') or die();
if( !wprmm_editor_or_admin() || empty($_POST['wprmm_crud'])) wp_die('You do not have permission to modify this object.');


// Saves and Deletes menus, categories, and items, icons and routes to edit


if( !empty($_POST) && !empty( $_POST['wprmm_crud'] ) ){

  
  /* Save New Menu */
  if( !empty($_POST['wprmm_crud']['menu']) ) {
    if($_POST['wprmm_crud']['menu'] == 'new'){
      $menu_id = WPRMM_Menu::create($_POST['wprmm']);
      wp_redirect(wprmm_admin_url('menu','edit-menu',$menu_id));
      exit;
    }
    /* Delete Menu */
    if($_POST['wprmm_crud']['menu'] == 'Delete'){
      $menu_id = (int) $_POST['wprmm_crud']['menu_id'];
      WPRMM_Menu::destroy($menu_id);
      wp_redirect(admin_url('admin.php?page='.WPRMM_ADMIN_URL));
      exit;
    }
  }
    
    
  /* Save New Category */
  if( !empty($_POST['wprmm_crud']['category']) ) {
    if($_POST['wprmm_crud']['category'] == 'new'){
      $category_id = WPRMM_Category::create($_POST['wprmm']);
      wp_redirect(wprmm_admin_url('category','edit-category',$category_id));
      exit;
    }
    /* Delete Category */
    if($_POST['wprmm_crud']['category'] == 'Delete'){
      $category_id = (int) $_POST['wprmm_crud']['category_id'];
      $menu_id = (int) $_POST['wprmm_crud']['menu_id'];
      WPRMM_Category::destroy($category_id);
      wp_redirect(wprmm_admin_url('menu','index-category',$menu_id));
      exit;
    }
  }
    
    
  /* Save New Item */
  if( !empty($_POST['wprmm_crud']['item']) ) {
    if($_POST['wprmm_crud']['item'] == 'new'){
      $item_id = WPRMM_Item::create($_POST['wprmm']);
      wp_redirect(wprmm_admin_url('item','edit-item',$item_id));
      exit;
    }
    /* Delete Item */
    if($_POST['wprmm_crud']['item'] == 'Delete'){
      $item_id = (int) $_POST['wprmm_crud']['item_id'];
      $menu_id = (int) $_POST['wprmm_crud']['menu_id'];
      WPRMM_Item::destroy($item_id);
      wp_redirect(wprmm_admin_url('menu','index-item',$menu_id));
      exit;
    }
  }
    
    
  /* Save New Icon */
  if( !empty($_POST['wprmm_crud']['icon']) ) {
    if($_POST['wprmm_crud']['icon'] == 'new'){
      $icon_id = WPRMM_ICON::create($_POST['wprmm']);
      wp_redirect(wprmm_admin_icon_url('icon','edit-icon',$icon_id));
      exit;
    }
    /* Delete Icon */
    if($_POST['wprmm_crud']['icon'] == 'Delete'){
      $icon_id = (int) $_POST['wprmm_crud']['icon_id'];
      WPRMM_ICON::destroy($icon_id);
      wp_redirect(admin_url('admin.php?page='.WPRMM_ADMIN_ICON_URL));
      exit;
    }
  }  

}
  
?>
