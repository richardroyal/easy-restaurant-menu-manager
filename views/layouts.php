<?php

/**
 * Layout definitions that are available for each category.
 * Each layout have a name and safe_name.
 * The name is a description for using on the admin.
 * The safe_name must not contain special characters and is used in the layout function name:
 * wprmm_view_{$SafeName}
 *
 * For example, the view function fo: Two Column (two-column), is wprmm_view_two_column().
 */
function ermm_defined_layouts(){

  $layouts = array();

  $layouts[] = array( 'name' => 'One Column', 'safe_name' => 'one-column' );
  $layouts[] = array( 'name' => 'Two Column', 'safe_name' => 'two-column' );
  $layouts[] = array( 'name' => 'Responsive One Column (Twitter Bootstrap)', 'safe_name' => 'one_column_bootstrap' );
  $layouts[] = array( 'name' => 'Responsive Two Column (Twitter Bootstrap)', 'safe_name' => 'two_column_bootstrap' );
  $layouts[] = array( 'name' => 'Responsive One Column (Zurb Foundation)', 'safe_name' => 'one_column_foundation' );
  $layouts[] = array( 'name' => 'Responsive Two Column (Zurb Foundation)', 'safe_name' => 'two_column_foundation' );

  return $layouts;
}


?>
