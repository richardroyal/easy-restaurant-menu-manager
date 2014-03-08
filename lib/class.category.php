<?php
class WPRMM_Category{
 
/*  public $id, $name, $description;*/


  public function __construct($id = 'ALL') { 
    $this->id = '';
    $this->name = 'New';
    $this->active = 1;
    $this->show_description = 1;
    $this->show_title = 1;
    $this->description = '';
    $this->layout = 'one-column';

    if(is_numeric($id)) $this->load_category($id);
  }


 
  /* @return all categories in the DB */
  public static function get_all( $menu_id='all', $category_ids='all' ){
    global $wpdb;
    
    $where = array();

    if( !empty( $category_ids ) && is_array( $category_ids ) ) {
      $where[] = 'id IN ('.implode( ',', $category_ids ).')';
    }
    if( is_numeric($menu_id) ){
      $where[] = 'menu_id="'.$menu_id.'"';
    }
    $where = empty($where) ? '': ' WHERE ' . implode( ' AND ', $where );

    $categories = $wpdb->get_results('SELECT * FROM '.WPRMM_CATEGORY_DB.' '.$where.' ORDER BY display_order, id');
    return stripslashes_deep($categories);
  }
  


  /* Create category object from ID */
  private function load_category($id){
    global $wpdb;
    $category = $wpdb->get_results('SELECT * FROM '.WPRMM_CATEGORY_DB.' WHERE id="'.$id.'" LIMIT 1', ARRAY_A);
    $category = $category[0];
    if(empty($category)) return '';

    $this->id = $category['id'];
    $this->name = stripslashes($category['name']);
    $this->description = stripslashes($category['description']);
    $this->layout = stripslashes($category['layout']);
    $this->active = stripslashes($category['active']);
    $this->show_title = stripslashes($category['show_title']);
    $this->show_description = stripslashes($category['show_description']);
    $this->display_order = stripslashes($category['display_order']);
    $this->menu_id = stripslashes($category['menu_id']);
  }



  /* Saves category on admin update */
  public static function update($category){
    global $wpdb;
    $wpdb->update(WPRMM_CATEGORY_DB, $category, array('id'=>$category['id']));
    echo wprmm_update_message('Category successfully updated.');
  }



  /* Creates category in DB */
  public static function create($category){
    global $wpdb;
    $wpdb->insert(WPRMM_CATEGORY_DB, $category);
    return $wpdb->insert_id;
  }

  /* Deletes menu from DB */
  public static function destroy($category_id){
    global $wpdb;
    if(empty($category_id)) return '';
    $wpdb->query('DELETE FROM '.WPRMM_CATEGORY_DB.' WHERE id="'.$category_id.'"'); 
  }

}
?>
