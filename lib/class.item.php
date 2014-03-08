<?php
class WPRMM_Item{
 
  /*public $id, $name, $description;*/
  private $parent_menus;

  public function __construct($id = 'ALL') { 
    $this->id = '';
    $this->name = 'New';
    $this->show_price = 1;
    $this->active = 1;
    $this->description = '';
    $this->category_id = 0;

    if(is_numeric($id)) $this->load_item($id);
  }


 
  /* @return all items in the DB */
  public static function get_all($menu_id = 'ALL'){
    global $wpdb;
    $where = is_numeric($menu_id)? 'WHERE menu_id="'.$menu_id.'"' : '';
    $sql = "SELECT ".WPRMM_ITEM_DB.".*, ".WPRMM_ICON_DB.".image AS icon_image, ".WPRMM_ICON_DB.".name AS icon_name, ".WPRMM_ICON_DB.".description AS icon_description FROM ".WPRMM_ITEM_DB." LEFT JOIN ".WPRMM_ICON_DB." ON (".WPRMM_ITEM_DB.".icon_class = ".WPRMM_ICON_DB.".id) $where ORDER BY category_id, display_order, id";
    $items = $wpdb->get_results($sql);

    return stripslashes_deep($items);
  }


  /* Loads parent menus when load_all is requested */
  public function load_parent_menus(&$items){
    $menu_ids = array();
    foreach($items as $i){
      $menu_ids[] = $i->menu_id;
    }
    if(empty($menu_ids)) return '';

    $where = ' WHERE id='.implode(' OR id=',$menu_ids);
    global $wpdb;

    $this->parent_menus = $wpdb->get_results('SELECT * FROM '.WPRMM_MENU_DB.' '.$where.' ORDER BY id');
  }
  

  /* Get parent menu */
  public function get_parent_menu($menu_id){
    foreach($this->parent_menus as $m){
      if($m->id == $menu_id) return $m;
    }
  }


  /* Create item object from ID */
  private function load_item($id){
    global $wpdb;
    $item = $wpdb->get_results('SELECT * FROM '.WPRMM_ITEM_DB.' WHERE id="'.$id.'" LIMIT 1', ARRAY_A);
    $item = $item[0];
    if(empty($item)) return '';

    $this->id = $item['id'];
    $this->name = stripslashes($item['name']);
    $this->description = stripslashes($item['description']);
    $this->price = stripslashes($item['price']);
    $this->second_price = stripslashes($item['second_price']);
    $this->show_price = stripslashes($item['show_price']);
    $this->icon_class = stripslashes($item['icon_class']);
    $this->layout = empty($item['layout']) ? '' : stripslashes($item['layout']);
    $this->active = stripslashes($item['active']);
    $this->display_order = stripslashes($item['display_order']);
    $this->menu_id = stripslashes($item['menu_id']);
    $this->category_id = stripslashes($item['category_id']);
    $this->image = stripslashes($item['image']);
  }



  /* Saves item on admin update */
  public static function update($item){
    global $wpdb;
    $item['display_order'] = empty($item['display_order'])? 0 : $item['display_order'];
    $wpdb->update(WPRMM_ITEM_DB, $item, array('id'=>$item['id']));
    echo wprmm_update_message('Item successfully updated.');
  }


  /* Creates item in DB */
  public static function create($item){
    global $wpdb;
    $item['display_order'] = empty($item['display_order'])? 0 : $item['display_order'];
    $wpdb->insert(WPRMM_ITEM_DB, $item);
    return $wpdb->insert_id;
  }

  /* Deletes item from DB */
  public static function destroy($item_id){
    global $wpdb;
    if(empty($item_id)) return '';
    $wpdb->query('DELETE FROM '.WPRMM_ITEM_DB.' WHERE id="'.$item_id.'"'); 
  }
}
?>
