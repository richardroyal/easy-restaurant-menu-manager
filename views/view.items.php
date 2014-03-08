<?php
/*** Returns HTML UL/LI items elements for frontend display */
function wprmm_view_items(&$category, &$items){

  /* Output default layout use override for custom layout */
  $m = '';
  $custom_layout = 'wprmm_view_'.str_replace(array('-'),array('_'),$category->layout);
  if(function_exists($custom_layout)) {
    $m = call_user_func($custom_layout, $category,$items);
    return $m;
  } else {


    /*** One column layout */
    $m .=   '<ul class="'.$category->layout.'">'."\r\n";
  
    foreach($items as $i){
      if($i->category_id == $category->id && $i->active){
        $m .=   '<li>';
  
        $m .=    '<h3>'.$i->name.'</h3>
                  <span class="menu_price" title="">';
                      if(!empty($i->icon_image)){ 
                        $m .= '<img class="wprmm_tooltip" rel="tooltip" title="'.$i->icon_description.'" alt="'.$i->icon_description.'" src="'.$i->icon_image.'" />';
                      }
                      if($i->show_price):
                        $m .= $i->price;
                        if(!empty($i->second_price)) $m .= '<span class="second_price">'.$i->second_price.'</span>';
                      endif;
        $m .=    '</span>
                  <p>'.nl2br($i->description).'</p>
                  <div class="clear"></div>
               </li>';
      }
    }
  
    $m .=   '<li class="clear"></li></ul>'."\r\n";
  
    return $m;   
  }
}


/* Custom layouts: functions name wprmm_view_{layout name} */



/*** Two column layout */
function wprmm_view_two_column($category,$items){
  $clear = false;

  $m  = '';
  $m .=   '<ul class="'.$category->layout.'">'."\r\n";

  foreach($items as $i){
    if($i->category_id == $category->id && $i->active){
      $m .=   '<li>
                 <div class="menu_item_info">
                   <h3>'.$i->name.'</h3>
                   <span class="menu_price">';
                     if(!empty($i->icon_image)) {
                       $m .= '<img class="wprmm_tooltip" rel="tooltip" title="'.$i->icon_description.'" alt="'.$i->icon_description.'" src="'.$i->icon_image.'" />';
                     }
                     if($i->show_price):
                       $m .= $i->price;
                       if(!empty($i->second_price)) $m .= '<span class="second_price">'.$i->second_price.'</span>';
                     endif;
      $m .=       '</span>
                 </div>';

      $m .=     '<p>'.nl2br($i->description).'</p>
                 <div class="clear"></div>
               </li>';

      $m .= ($clear)? '<li class="clear"></li>' : '';
      $clear = !$clear;
    }
  }

  $m .=   '<li class="clear"></li></ul>'."\r\n";

  return $m;
}


/******************************** Bootstrap ******************************************/


/*** One column layout Bootstrap */
function wprmm_view_one_column_bootstrap($category,$items){

  $m  = '';
  $m .=   '<div class="'.$category->layout.'">'."\r\n";
  $real_index = 1;

  foreach($items as $i){
    if($i->category_id == $category->id && $i->active){
      $iter = $real_index % 2 == 0 ? "even" : "odd";

      $m .=   '<div class="row-fluid '. $iter .'">';

      $m .=     '<div class="span12">
                   <div class="row-fluid menu_item_info">
                       <div class="span9">
                         <h3>'.$i->name.'</h3>
                       </div>';
      $m .=           '<div class="span3">';
                         if( !empty($i->second_price) ){ $m .= '<span class="menu_price second_price pull-right">'.$i->second_price.'</span>'; }
                         if($i->show_price) { $m .= '<span class="menu_price pull-right">' . $i->price . '</span>' ;} 
                         if(!empty($i->icon_image)) { $m .= '<img class="wprmm_tooltip pull-right" rel="tooltip" title="'.$i->icon_description.'" alt="'.$i->icon_description.'" src="'.$i->icon_image.'" />'; }
      $m .=           '</div>';
      $m .=       '</div>';
      $m .=     '</div>';

      $m .=     '<div class="row-fluid">';
      $m .=         '<div class="span12">';
      $m .=            nl2br( $i->description );
      $m .=         '</div>';
      $m .=     '</div>';

      $m .=   '</div>';

      $real_index += 1;
    }
  }

  $m .=   '</div>'."\r\n";

  return $m;
}



/*** Two column layout Bootstrap */
function wprmm_view_two_column_bootstrap($category,$items){

  $m  = '';
  $m .=   '<div class="'.$category->layout.'">'."\r\n";
  $real_index = 1;

  foreach($items as $i){
    if($i->category_id == $category->id && $i->active){


      $iter = $real_index % 2 == 0 ? "even" : "odd";
      if( $iter == "odd" ){
        $m .= '<div class="row-fluid">';
      }

      $m .=   '<div class="span6 '. $iter .'">
                 <div class="menu_item_info">
                   <h3>'.$i->name.'</h3>';

                   if( !empty($i->second_price) ){ $m .= '<span class="menu_price second_price pull-right">'.$i->second_price.'</span>'; }
                   if($i->show_price) { $m .= '<span class="menu_price pull-right">' . $i->price . '</span>' ;} 
                   if(!empty($i->icon_image)) { $m .= '<img class="wprmm_tooltip pull-right" rel="tooltip" title="'.$i->icon_description.'" alt="'.$i->icon_description.'" src="'.$i->icon_image.'" />'; }

      $m .=     '</div>';



      $m .=     '<p>'.nl2br($i->description).'</p>
               </div>';

      if( $iter == "even" ){
        $m .= '</div>';
      }
      $real_index += 1;

    }
  }

  if( $real_index % 2 == 0 ){ $m .= '</div>'; }
  $m .=   '</div>'."\r\n";

  return $m;
}

/****************************** End Bootstrap ****************************************/





/******************************* Foundation ******************************************/

/*** One column layout Foundation */
function wprmm_view_one_column_foundation( $category, $items ){

  $m  = '';
  $m .=   '<div class="'.$category->layout.'">'."\r\n";
  $real_index = 1;

  foreach($items as $i){
    if($i->category_id == $category->id && $i->active){
      $iter = $real_index % 2 == 0 ? "even" : "odd";

      $m .=   '<div class="row '. $iter .'">';
      $m .=     '<div class="large-12 twelve columns">
                   <div class="row menu_item_info">
                       <div class="large-9 nine columns">
                         <h3>'.$i->name.'</h3>
                       </div>';
      $m .=           '<div class="large-three three columns">';
                         if( !empty($i->second_price) ){ $m .= '<span class="menu_price second_price right">'.$i->second_price.'</span>'; }
                         if($i->show_price) { $m .= '<span class="menu_price right">' . $i->price . '</span>' ;} 
                         if(!empty($i->icon_image)) { $m .= '<img class="wprmm_tooltip right" rel="tooltip" title="'.$i->icon_description.'" alt="'.$i->icon_description.'" src="'.$i->icon_image.'" />'; }
      $m .=           '</div>';
      $m .=       '</div>';



      $m .=       '<div class="row">';
      $m .=         '<div class="large-12 twelve columns">';
      $m .=            nl2br( $i->description );
      $m .=         '</div>';
      $m .=       '</div>';

      $m .=     '</div>';
      $m .=   '</div>';

      $real_index += 1;
    }
  }

  $m .=   '</div>'."\r\n";

  return $m;
}



/*** Two column layout Zurb Foundation */
function wprmm_view_two_column_foundation( $category, $items ){

  $m  = '';
  $m .=   '<div class="'.$category->layout.'">'."\r\n";
  $real_index = 1;

  foreach($items as $i){
    if($i->category_id == $category->id && $i->active){


      $iter = $real_index % 2 == 0 ? "even" : "odd";
      if( $iter == "odd" ){
        $m .= '<div class="row">';
      }

      $m .=   '<div class="large-6 six columns '. $iter .'">
                 <div class="menu_item_info">
                   <h3>'.$i->name.'</h3>';

                   if( !empty($i->second_price) ){ $m .= '<span class="menu_price second_price right">'.$i->second_price.'</span>'; }
                   if($i->show_price) { $m .= '<span class="menu_price right">' . $i->price . '</span>' ;} 
                   if(!empty($i->icon_image)) { $m .= '<img class="wprmm_tooltip right" rel="tooltip" title="'.$i->icon_description.'" alt="'.$i->icon_description.'" src="'.$i->icon_image.'" />'; }

      $m .=      '</div>';



      $m .=     '<p>'.nl2br($i->description).'</p>
               </div>';

      if( $iter == "even" ){
        $m .= '</div>';
      }
      $real_index += 1;

    }
  }

  if( $real_index % 2 == 0 ){ $m .= '</div>'; }
  $m .=   '</div>'."\r\n";

  return $m;
}

/****************************** End Foundation ***************************************/




