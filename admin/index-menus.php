<?php 
defined('WPRMM_PATH') or die();

wprmm_save_menu();

$menu = new WPRMM_Menu();
$menus = $menu->get_all();

?>
<div class="wrap wprmm">
  <img class="left" style="margin:0 15px 0 0" src="<?php echo WPRMM_URL.'images/menumanagericon_50x50.jpg'?>" />
  <h2 class="left">Restaurant Menu Manager - Setup Menus</h2>
  <div class="clear"></div>
  <hr />

  <?php wprmm_get_help(array('main'=>true));?>

  <table class="widefat">
  <thead>
    <tr>
      <th>Name</th>
      <th>Edit Menu</th>
      <th>Shortcode</th>
      <th>Edit Menu Category Set</th>
      <th>Edit Menu Items</th>
      <th>Print Friendly</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
  <tbody>
    <?php foreach($menus as $m): ?>
     <tr>
       <td><strong><?php echo $m->name; ?></strong></td>
       <td><a href="<?php echo wprmm_admin_url('menu','edit-menu',$m->id);?>"><?php echo $m->name; ?></a></td>
       <td>
         <code>[WP_Restaurant_Menu id="<?php echo htmlentities($m->id);?>"]</code>
       </td>
       <td><a href="<?php echo wprmm_admin_url('menu','index-category',$m->id);?>">Edit Categories</a></td>
       <td><a href="<?php echo wprmm_admin_url('menu','index-item',$m->id);?>">Edit Items</a></td>
       <td>
         <a href="<?php echo site_url()."?wprmm-routing=export&menu_id=".$m->id;?>" target="_blank">Print Menu</a>
       </td>
       <td>
         <form method="post" action="#">
           <input type="submit" class="button" name="wprmm_crud[menu]" value="Delete" onclick="alert('You cannot delete this menu.')" />
           <input type="hidden" name="wprmm_crud[menu_id]" value="<?php echo $m->id;?>" />
         </form>
       </td>
     </tr>
    <?php endforeach; ?>
  </tbody>
  </table>

  <div class="wprmm-admin-nav">
    <p>
      <a class="button-primary" href="#" onclick="alert('You must upgrade to the extended version in order to have more than one menu. You can edit the currently setup menu, and create and manage categories and items.');">+ Create New Menu</a>&nbsp;
      <span><a class="button" href="<?php echo wprmm_help_link(); ?>">help?</a></span>&nbsp;
    </p>
  </div>

</div>
