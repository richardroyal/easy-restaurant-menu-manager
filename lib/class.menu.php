<?php
class WPRMM_MENU{
 
  /*public $id, $name, $description;*/


  public function __construct($id = 'ALL') { 
    $this->id = '';
    $this->name = 'New';
    $this->show_title = 1;
    $this->description = '';
    $this->show_link = 1;
    $this->rss2 = 1;

    if(is_numeric($id)) $this->load_menu($id);
  }


 
  /* @return all menus in the DB */
  public function get_all(){
    global $wpdb;
    $menus = $wpdb->get_results('SELECT * FROM '.WPRMM_MENU_DB);
    return stripslashes_deep($menus);
  }
  


  /* Create menu object from ID */
  private function load_menu($id){
    global $wpdb;
    $menu = $wpdb->get_results('SELECT * FROM '.WPRMM_MENU_DB.' WHERE id="'.$id.'" LIMIT 1', ARRAY_A);
    $menu = $menu[0];
    if(empty($menu)) return '';

    $this->id = $menu['id'];
    $this->name = stripslashes($menu['name']);
    $this->show_title = (int) $menu['show_title'];
    $this->description = stripslashes($menu['description']);
    $this->show_link = (int) $menu['show_link'];
    $this->rss2 = (int) $menu['rss2'];
    $this->print_url = site_url().urlencode("?wprmm-routing=export&menu_id=".$menu['id']);
    $this->rss2_url = site_url("?wprmm-routing=rss2&menu_id=".$menu['id']);    
  }


  /* Set menu object from name */
  public function get_by_name($name){
    global $wpdb;
    $menu = $wpdb->get_results('SELECT * FROM '.WPRMM_MENU_DB.' WHERE name="'.$name.'" LIMIT 1', ARRAY_A);
    $menu = $menu[0];
    if(empty($menu)) return '';
    return $menu;
  }


  /* Set menu object from name */
  public static function get_by_id($id){
    global $wpdb;
    $menu = $wpdb->get_results('SELECT * FROM '.WPRMM_MENU_DB.' WHERE id="'.$id.'" LIMIT 1', ARRAY_A);
    $menu = $menu[0];
    $menu['print_url'] = site_url()."?wprmm-routing=export&menu_id=".$menu['id'];
    if(empty($menu)) return '';
    return stripslashes_deep($menu);
  }



  /* Saves menu on admin update */
  public function update($menu){
    global $wpdb;
    $wpdb->update(WPRMM_MENU_DB, $menu, array('id'=>$menu['id'])); 
    echo wprmm_update_message('Menu successfully updated.');
  }


  /* Saves menu on admin update */
  public function create($menu){
    global $wpdb;
    $wpdb->insert(WPRMM_MENU_DB, $menu); 
    return $wpdb->insert_id;
  }

  /* Saves menu on admin update */
  public function destroy($menu_id){
    global $wpdb;
    if(empty($menu_id)) return '';
    $wpdb->query('DELETE FROM '.WPRMM_MENU_DB.' WHERE id="'.$menu_id.'"'); 
  }
}
?>
