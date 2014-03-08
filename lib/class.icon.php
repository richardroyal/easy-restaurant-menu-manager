<?php
class WPRMM_ICON{


  public function __construct($id = 'ALL') { 
    $this->id = '';
    $this->name = 'New';
    $this->description = '';
    $this->image_url = '';

    if(is_numeric($id)) $this->load_icon($id);
  }


 
  /* @return all icons in the DB */
  public static function get_all(){
    global $wpdb;
    $icons = $wpdb->get_results('SELECT * FROM '.WPRMM_ICON_DB);
    return stripslashes_deep($icons);
  }
  


  /* Create icon object from ID */
  private function load_icon($id){
    global $wpdb;
    $icon = $wpdb->get_results('SELECT * FROM '.WPRMM_ICON_DB.' WHERE id="'.$id.'" LIMIT 1', ARRAY_A);
    $icon = $icon[0];
    if(empty($icon)) return '';

    $this->id = $icon['id'];
    $this->name = stripslashes($icon['name']);
    $this->description = stripslashes($icon['description']);
    $this->image = stripslashes($icon['image']);
  }


  /* Set icon object from name */
  public function get_by_name($name){
    global $wpdb;
    $icon = $wpdb->get_results('SELECT * FROM '.WPRMM_ICON_DB.' WHERE name="'.$name.'" LIMIT 1', ARRAY_A);
    $icon = $icon[0];
    if(empty($icon)) return '';
    return $icon;
  }


  /* Set icon object from name */
  public function get_by_id($id){
    global $wpdb;
    $icon = $wpdb->get_results('SELECT * FROM '.WPRMM_ICON_DB.' WHERE id="'.$id.'" LIMIT 1', ARRAY_A);
    $icon = $icon[0];
    if(empty($icon)) return '';
    return stripslashes_deep($icon);
  }



  /* Saves icon on admin update */
  public static function update($icon){
    global $wpdb;
    $wpdb->update(WPRMM_ICON_DB, $icon, array('id'=>$icon['id'])); 
    echo wprmm_update_message('Icon successfully updated.');
  }


  /* Saves icon on admin update */
  public static function create($icon){
    global $wpdb;
    $wpdb->insert(WPRMM_ICON_DB, $icon); 
    return $wpdb->insert_id;
  }

  /* Saves icon on admin update */
  public static function destroy($icon_id){
    global $wpdb;
    if(empty($icon_id)) return '';
    $wpdb->query('DELETE FROM '.WPRMM_ICON_DB.' WHERE id="'.$icon_id.'"'); 
  }
}
?>
