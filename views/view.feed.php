<?php
/**
 *  Output RSS 2 version of a specified menu.
 */
function wpermm_rss2( $menu_id ){

  $menu = WPRMM_Menu::get_by_id($menu_id);

  if( $menu['rss2'] ){
    $categories = WPRMM_Category::get_all((int) $menu['id']);
    $items = WPRMM_Item::get_all((int) $menu['id']);
  
    header( 'Content-Type: text/xml' );
    $s  = '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
    $s .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">'."\n";
    $s .=   '<channel>'."\n";
    $s .=     '<title>'.ermm_xmlen( $menu['name'] ).'</title>'."\n";
    $s .=     '<description>'.ermm_xmlen( $menu['description'] ).'</description>'."\n";
    $s .=     '<link>'.ermm_xmlen( $menu['print_url'] ).'</link>'."\n";

    foreach($categories as $category) {
      if($category->active){
        foreach($items as $i){
          if($i->category_id == $category->id && $i->active){

            $s .= '<item>'."\n";
            $s .=  '<title>'.ermm_xmlen($i->name).'</title>' . "\n";
            $s .=   '<category>'.ermm_xmlen($category->name).'</category>'."\n";
            

            $s .=  '<description><![CDATA['."\n";

            if(!empty($i->image)){
              $s .= '<img src="'.$i->image.'" alt="'.ermm_xmlen($i->name).'" class="center" />'."\n";
            }

            if($i->show_price){
              $s .= '<p>Price: ' . $i->price . '</p>' . "\n";
              if(!empty($i->second_price)) { 
                $s .= '<p>Alternate Price: ' . $i->second_price . '</p>' . "\n";
              }
            }

            if(!empty($i->icon_image)){
              $s .= '<p>' . "\n";
              $s .=   '<img alt="'.$i->icon_description.'" src="'.$i->icon_image.'" />  ';
              $s .=   '<span>' . $i->icon_description . '</span>' ."\n";
              $s .= '</p>' . "\n";
            }

            $s .=    '<p>'.nl2br($i->description).'</p>'."\n";
            $s .=  ']]></description>'."\n";


            $s .=  '<guid isPermaLink="false">item_' .$i->id. '</guid>' ."\n";
            $s .= '</item>'."\n";

          }
        }
      }
    }


    $s .=   '</channel>'."\n";
    $s .= '</rss>'."\n";
  
    return $s;
  } else {
    return "RSS2 Feed not turned on for this menu.";  
  }
}




/**
 *  Make strings XML safe
 */
function ermm_xmlen( $in ){
  return utf8_encode( htmlentities( $in, ENT_COMPAT, 'utf-8') );
}


?>
