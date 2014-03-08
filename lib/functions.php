<?php

defined('WPRMM_PATH') or die();




/**
 *  Creates sample data upon plugin activation
 *  WPRMM_MENU_DB, WPRMM_CATEGORY_DB, WPRMM_ITEM_DB
 */
function wprmm_create_sample(){
  global $wpdb;
  
  /* Create default icons */
  $wpdb->insert(WPRMM_ICON_DB, array('name'=>'Spicy',
                                     'description'=>'Spicy',
                                     'image'=>WPRMM_URL."images/pepper.png"));
  $spicy = ( empty($wpdb->insert_id) ? 0 : $wpdb->insert_id );
  $wpdb->insert(WPRMM_ICON_DB, array('name'=>'Star',
                                     'description'=>'Specially Prepared',
                                     'image'=>WPRMM_URL."images/star.png"));
  $star = ( empty($wpdb->insert_id) ? 0 : $wpdb->insert_id );
  $wpdb->insert(WPRMM_ICON_DB, array('name'=>'Trophy',
                                     'description'=>'Award Winning',
                                     'image'=>WPRMM_URL."images/trophy.png"));
  $trophy = ( empty($wpdb->insert_id) ? 0 : $wpdb->insert_id );
  $wpdb->insert(WPRMM_ICON_DB, array('name'=>'Healthy',
                                     'description'=>'Healthy Eating Choice',
                                     'image'=>WPRMM_URL."images/healthy.png"));
  $healthy = ( empty($wpdb->insert_id) ? 0 : $wpdb->insert_id );
  $wpdb->insert(WPRMM_ICON_DB, array('name'=>'New',
                                     'description'=>'New Menu Item!',
                                     'image'=>WPRMM_URL."images/new.png"));
  $new = ( empty($wpdb->insert_id) ? 0 : $wpdb->insert_id );
  $wpdb->insert(WPRMM_ICON_DB, array('name'=>'Vegetarian',
                                     'description'=>'Vegetarian Dish',
                                     'image'=>WPRMM_URL."images/vegetarian.png"));
  $vegetarian = ( empty($wpdb->insert_id) ? 0 : $wpdb->insert_id );


  /* Setup sample menu */
  $wpdb->insert(WPRMM_MENU_DB, array('name'=>'Lunch', 'description'=>'Sample Lunch Menu'));
  $menu_id = ( empty($wpdb->insert_id) ? 0 : $wpdb->insert_id );
  $wpdb->insert(WPRMM_CATEGORY_DB, array('name'=>'Entrees',
                                         'description'=>'Each entree comes with your choice of soup or salad, plus fresh-baked rolls or cornbread muffins.',
                                         'layout'=>'one-column',
                                         'menu_id'=>$menu_id,
                                         'display_order'=>1));
  $category_id = ( empty($wpdb->insert_id) ? 0 : $wpdb->insert_id );
  $wpdb->insert(WPRMM_ITEM_DB, array('name'=>'Flame-broiled cheeseburger', 
                                     'description'=>'A cheeseburger is a hamburger with cheese that has been added to it. Traditionally, the cheese is placed on top of the patty, but the burger can include many variations in structure, ingredients, and composition. The term itself is a portmanteau of the words "cheese" and "hamburger."',
                                     'price'=>'8.99',
                                     'menu_id'=>$menu_id,
                                     'category_id'=>$category_id));
  $wpdb->insert(WPRMM_ITEM_DB, array('name'=>'Chimichanga', 
                                     'description'=>'Chimichanga is typically prepared by filling a flour tortilla with a wide range of ingredients, most commonly rice, cheese, machaca, carne adobada, or shredded chicken, and folding it into a rectangular package. It is then deep-fried and can be accompanied with salsa, guacamole, sour cream and/or cheese.',
                                     'price'=>'12.99',
                                     'icon_class'=>$star,
                                     'menu_id'=>$menu_id,
                                     'category_id'=>$category_id));
  $wpdb->insert(WPRMM_ITEM_DB, array('name'=>'Deluxe pizza',
                                     'description'=>'Due to the wide influence of Italian and Greek immigrants in American culture, the US has developed regional forms of pizza, some bearing only a casual resemblance to the Italian original.',
                                     'price'=>'11.99',
                                     'menu_id'=>$menu_id,
                                     'category_id'=>$category_id));
  $wpdb->insert(WPRMM_ITEM_DB, array('name'=>'Feta Salad', 
                                     'description'=>'Salads are generally served with a dressing, as well as various garnishes such as nuts or croutons, and sometimes with the addition of meat, fish, pasta, cheese, eggs, or whole grains.',
                                     'price'=>'9.99',
                                     'icon_class'=>$healthy,
                                     'menu_id'=>$menu_id,
                                     'category_id'=>$category_id));
  $wpdb->insert(WPRMM_ITEM_DB, array('name'=>'Sushi platter',
                                     'description'=>'Sushi is a Japanese food consisting of cooked vinegared rice (shari) combined with other ingredients (neta). Neta and forms of sushi presentation vary, but the ingredient which all sushi have in common is shari. The most common neta is seafood.',
                                     'price'=>'13.99',
                                     'icon_class'=>$vegetarian,
                                     'menu_id'=>$menu_id,
                                     'category_id'=>$category_id));

  /* sample desserts */
  $wpdb->insert(WPRMM_CATEGORY_DB, array('name'=>'Desserts',
                                         'description'=>'Delicious sweets, baked up fresh each day by our awesome pastry chef. The perfect end to your meal!',
                                         'layout'=>'two-column',
                                         'menu_id'=>$menu_id,
                                         'display_order'=>2));
  $category_id = ( empty($wpdb->insert_id) ? 0 : $wpdb->insert_id );
  $wpdb->insert(WPRMM_ITEM_DB, array('name'=>'Pumpkin Pie',
                                     'description'=>'Pumpkin pie is a traditional sweet dessert, often eaten during the fall and early winter, especially for Thanksgiving and Christmas in the United States and Canada.',
                                     'price'=>'4.59',
                                     'menu_id'=>$menu_id,
                                     'category_id'=>$category_id));
  $wpdb->insert(WPRMM_ITEM_DB, array('name'=>'Chocolate Cupcake',
                                     'description'=>'Designed to serve one person, frequently baked in a small, thin paper or aluminum cup. As with larger cakes, frosting and other cake decorations, such as sprinkles, are common on cupcakes.',
                                     'price'=>'4.59',
                                     'menu_id'=>$menu_id,
                                     'category_id'=>$category_id));

}



/** 
 *  Iterate through list of objects and return name for given id
 *  If id is 0, return Default
 *
 *  @param int id
 *  @param array objects Assumes that object->id and object->name exist
 *  @return string name : $object->name | 'Default'
 */
function wprmm_get_name_from_id($id,$objects){
  if($id==0) return 'None (hidden)';
  if(empty($objects) || empty($id)) return '';
  foreach($objects as $obj) {
    if(!empty($obj->name) && !empty($obj->id)){
      if($obj->id == $id) return $obj->name;
    }
  }
  
}



/**
 *  Convert dynamic menu, category, and item names
 *  to CSS compatable id names
 */
function wprmm_css_name($name){
  if(empty($name)) return '';

  $n = trim(strtolower($name));
  return str_replace(array('-','"',"'",' '),array(''),$n);
}


?>
