<?php 

/*** Displays Printer Friendly HTML Menu on frontend */
function wprmm_get_printer_friendly_menu($id){

  global $wpdb;
  if(empty($id) || !is_numeric($id) ) return '';

  /* Get Menu, Categories, and Items */
  $menu = WPRMM_Menu::get_by_id($id);
  if(empty($menu['id'])) return "Menu not found.";
 
  $s = '<html>
          <head>
            <meta charset="utf-8">
            <title>'.$menu['name'].'</title>
            <link rel="stylesheet" href="'.WPRMM_URL.'css/style.css" type="text/css" media="all" />
            <link rel="stylesheet" href="'.site_url().'/?wprmm-routing=custom-print-css" type="text/css" media="all" />
          </head>
          <body>'.
            wprmm_get_menu($menu).
          '</body>
        </html>';


  return $s;
}

?>
