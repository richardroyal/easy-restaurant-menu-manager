<?php 
defined('WPRMM_PATH') or die();

$menu = new WPRMM_Menu((int) $_GET['menu_id']);
$category = new WPRMM_Category();
$categories = $category->get_all($menu->id);

?>
<div class="wrap wprmm">
  <img class="left" style="margin:0 15px 0 0" src="<?php echo WPRMM_URL.'images/menumanagericon_50x50.jpg'?>" />
  <h2 class="left">Restaurant Menu Manager - Setup Categories</h2>
  <div class="clear"></div>
  <hr />

  <?php wprmm_get_help();?>

  <p class="wprmm-breadcrumb">
    <a href="<?php echo admin_url('admin.php?page='.WPRMM_ADMIN_URL);?>">Menus</a> &raquo; 
    <a href="<?php echo wprmm_admin_url('menu','edit-menu',$menu->id);?>"><?php echo $menu->name;?></a> &raquo; 
    <a href="">Categories</a>&nbsp;&nbsp;
    (<a href="<?php echo wprmm_admin_url('menu','index-item',$menu->id);?>">edit menu items</a>)
  </p>

  <table class="widefat">
  <thead>
    <tr>
      <th>Name</th>
      <th>Edit</th>
      <th>Parent Menu</th>
      <th>Layout</th>
      <th>Order</th>
      <th>Active</th>
      <th>ID</th>
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
    </tr>
  </tfoot>
  <tbody>
    <?php foreach($categories as $c): ?>
     <tr>
       <td><strong><?php echo $c->name; ?></strong></td>
       <td><a href="<?php echo wprmm_admin_url('category','edit-category',$c->id);?>">Edit Category</a></td>
       <td><?php echo $menu->name;?></td>
       <td><?php echo ermm_full_layout_name( $c->layout ); ?></td>
       <td><?php echo $c->display_order; ?></td>
       <td><?php echo ($c->active == 1) ? 'Yes' : 'No'; ?></td>
       <td><?php echo $c->id; ?></td>
       <td>
         <form method="post" action="<?php echo WPRMM_CRUD;?>">
           <input type="hidden" name="wprmm_crud[menu_id]" value="<?php echo $c->menu_id;?>" />
           <input type="hidden" name="wprmm_crud[category_id]" value="<?php echo $c->id;?>" />
           <input type="submit" class="button" name="wprmm_crud[category]" value="Delete" onclick="return confirm('Are you sure you want to delete this category?')" />
         </form>
       </td>
     </tr>
    <?php endforeach; ?>
  </tbody>
  </table>

  <div class="wprmm-admin-nav">
    <p>
      <a class="button-primary" href="<?php echo wprmm_admin_url('menu','new-category',$menu->id);?>">+ Add New Category</a>&nbsp;
      <a class="button" href="<?php echo admin_url('admin.php?page='.WPRMM_ADMIN_URL);?>">&laquo;back to Menus</a>&nbsp;
      <span><a class="button" href="<?php echo wprmm_help_link(); ?>">help?</a></span>&nbsp;
    </p>
  </div>



</div>
