<?php 
defined('WPRMM_PATH') or die();

$menu = new WPRMM_Menu((int) $_GET['menu_id']);
$item = new WPRMM_Item();
$items = $item->get_all($menu->id);
$category = new WPRMM_Category();
$categories = $category->get_all($menu->id);
?>
<div class="wrap wprmm">
  <img class="left" style="margin:0 15px 0 0" src="<?php echo WPRMM_URL.'images/menumanagericon_50x50.jpg'?>" />
  <h2 class="left">Restaurant Menu Manager - Setup Items</h2>
  <div class="clear"></div>
  <hr />

  <?php wprmm_get_help();?>

  <p class="wprmm-breadcrumb">
    <a href="<?php echo admin_url('admin.php?page='.WPRMM_ADMIN_URL);?>">Menus</a> &raquo; 
    <a href="<?php echo wprmm_admin_url('menu','edit-menu',$menu->id);?>"><?php echo $menu->name;?></a> &raquo; 
    <a href="">Items</a>&nbsp;&nbsp;
    (<a href="<?php echo wprmm_admin_url('menu','index-category',$menu->id);?>">edit menu categories</a>)
  </p>

  <table class="widefat">
  <thead>
    <tr>
      <th>Name</th>
      <th>Parent Menu</th>
      <th>Category</th>
      <th>Price</th>
      <th>Image</th>
      <th>Order</th>
      <th>Active</th>
      <th>Edit</th>
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
      <th></th>
      <th></th>
    </tr>
  </tfoot>
  <tbody>
    <?php foreach($items as $i): ?>
     <tr>
       <td><strong><?php echo $i->name; ?></strong></td>
       <td><a href="<?php echo wprmm_admin_url('menu','edit-menu',$menu->id);?>"><?php echo $menu->name;?></a></td>
       <td><?php echo wprmm_get_name_from_id($i->category_id,$categories);?></td>
       <td><?php echo $i->price;?></td>
       <td>
         <?php if(!empty($i->image)):?>
           <img class="wprmm_preview_index_image" src="<?php echo $i->image;?>"/>
         <?php endif;?>
       </td>
       <td><?php echo $i->display_order; ?></td>
       <td><?php echo ($i->active == 1) ? 'Yes' : 'No'; ?></td>
       <td><a href="<?php echo wprmm_admin_url('item','edit-item',$i->id);?>">Edit Item</a></td>
       <td>
         <form method="post" action="<?php echo WPRMM_CRUD;?>">
           <input type="hidden" name="wprmm_crud[menu_id]" value="<?php echo $i->menu_id;?>" />
           <input type="hidden" name="wprmm_crud[item_id]" value="<?php echo $i->id;?>" />
           <input type="submit" class="button" name="wprmm_crud[item]" value="Delete" onclick="return confirm('Are you sure you want to delete this item?')"/>
         </form>
       </td>
     </tr>
    <?php endforeach; ?>
  </tbody>
  </table>

  <div class="wprmm-admin-nav">
    <p>
      <a class="button-primary" href="<?php echo wprmm_admin_url('menu','new-item',$menu->id);?>">+ Add New Item</a>&nbsp;
      <a class="button" href="<?php echo admin_url('admin.php?page='.WPRMM_ADMIN_URL);?>">&laquo;back to Menus</a>&nbsp;
      <span><a class="button" href="<?php echo wprmm_help_link(); ?>">help?</a></span>&nbsp;
    </p>
  </div>

</div>
