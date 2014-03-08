<?php
/**
 *  Setup database tables on plugin activation
 */
function wprmm_install_plugin() {
  global $wpdb;

  // Setup database structure for Menus, Categories, and Items
  //   Menu has many Categories
  //   Category has one Menu
  //   Category has many Items
  //   Item has many Categories
  $sql = "CREATE TABLE ".WPRMM_MENU_DB." (
          id int NOT NULL AUTO_INCREMENT,
          name text NOT NULL,
          show_title tinyint NOT NULL DEFAULT '1',
          description text NOT NULL,
          show_link tinyint NOT NULL DEFAULT '1',
          rss2 tinyint NOT NULL DEFAULT '1',          
          created_at TIMESTAMP DEFAULT now(),
          UNIQUE KEY id (id)
        )DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
  dbDelta($sql);


  $sql = "CREATE TABLE ".WPRMM_CATEGORY_DB." (
          id int NOT NULL AUTO_INCREMENT,
          name text NOT NULL,
          description text NOT NULL,
          layout text NOT NULL,
          active tinyint NOT NULL DEFAULT '1',
          show_title tinyint NOT NULL DEFAULT '1',
          show_description tinyint NOT NULL DEFAULT '1',
          display_order int NOT NULL,
          menu_id int NOT NULL,
          created_at TIMESTAMP DEFAULT now(),
          UNIQUE KEY id (id)
        )DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
  dbDelta($sql);


  $sql = "CREATE TABLE ".WPRMM_ITEM_DB." (
          id int NOT NULL AUTO_INCREMENT,
          name text NOT NULL,
          description text NOT NULL,
          price text NOT NULL,
          second_price text NOT NULL,
          image text NOT NULL,
          icon_class text NOT NULL,
          show_price tinyint NOT NULL DEFAULT '1',
          active tinyint NOT NULL DEFAULT '1',
          display_order int NOT NULL,
          menu_id int NOT NULL,
          category_id int NOT NULL,
          created_at TIMESTAMP DEFAULT now(),
          UNIQUE KEY id (id) 
        )DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
    dbDelta($sql);


  /* Icon DB table */
  $sql = "CREATE TABLE ".WPRMM_ICON_DB." ( 
          id int NOT NULL AUTO_INCREMENT,
          name text NOT NULL,
          description text NOT NULL,
          image text NOT NULL,
          created_at TIMESTAMP DEFAULT now(),
          UNIQUE KEY id (id) 
        )DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
  dbDelta($sql);


  // Create first menu upon activation
  $menus = $wpdb->get_results("SELECT * FROM ".WPRMM_MENU_DB, ARRAY_A);
  if(empty($menus)) wprmm_create_sample(); 

  add_option("wprmm_extended_db_version",WPRMM_EXTENDED_DB_VERSION);
}
?>
