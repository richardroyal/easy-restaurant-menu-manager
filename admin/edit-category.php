<?php
defined('WPRMM_PATH') or die();

wprmm_save_category();

$category = new WPRMM_Category((int) $_GET['category_id']);
$menu = new WPRMM_Menu((int) $category->menu_id);
?>
<div class="wrap wprmm">
  <img class="left" style="margin:0 15px 0 0" src="<?php echo WPRMM_URL.'images/menumanagericon_50x50.jpg'?>" />
  <h2 class="left">Restaurant Menu Manager - Edit Menu Category</h2>
  <div class="clear"></div>
  <hr />

  <?php wprmm_get_help();?>

  <p class="wprmm-breadcrumb">
    <a href="<?php echo admin_url('admin.php?page='.WPRMM_ADMIN_URL);?>">Menus</a> &raquo; 
    <a href="<?php echo wprmm_admin_url('menu','edit-menu',$menu->id);?>"><?php echo $menu->name;?></a> &raquo; 
    <a href="<?php echo wprmm_admin_url('menu','index-category',$menu->id);?>">Categories</a> &raquo; 
    <a href="<?php echo $_SERVER['REQUEST_URI']; ?>"><?php echo $category->name;?></a>
  </p>

  <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

    <table class="form-table">
      <tbody>

        <tr valign="top">
          <th scope="row"><label for="wprmm[name]">Name</label></th>
          <td><input name="wprmm[name]" type="text" value="<?php echo $category->name;?>" class="regular-text">
              <span class="description">Display name for this category.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[description]">Description</label></th>
          <td><textarea name="wprmm[description]" class="large-text code"><?php echo $category->description;?></textarea>
              <span class="description">Display description for this category.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[show_title]">Show Title?</label></th>
          <td><input type="checkbox" name="wprmm[show_title]" value="1" <?php echo ($category->show_title == 1) ? 'checked' : '';?>/>
              <span class="description">Display title text on frontend for category.</span>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="wprmm[show_description]">Show Description?</label></th>
          <td><input type="checkbox" name="wprmm[show_description]" value="1" <?php echo ($category->show_description == 1) ? 'checked' : '';?>/>
              <span class="description">Display description text on frontend for category.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[layout]">Layout</label></th>
          <td>
            <select name="wprmm[layout]" class="regular-text code">
              <?php foreach( ermm_defined_layouts() as $layout ): ?>
                <option value="<?php echo $layout['safe_name'];?>" <?php echo ($category->layout == $layout['safe_name']) ? 'selected' : '';?>>
                  <?php echo $layout['name'];?>
                </option>
              <?php endforeach;?>
            </select>
            <span class="description">Layout for items in this category.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[description]">Active</label></th>
          <td>
            <input type="checkbox" name="wprmm[active]" value="1" <?php echo ($category->active == 1) ? 'checked' : '';?>/>
            <span class="description">Display items in this category.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[display_order]">Display Order</label></th>
          <td><input name="wprmm[display_order]" type="text" value="<?php echo $category->display_order;?>" class="regular-text">
              <span class="description">Order in which this category is displayed to users.</span>
          </td>
        </tr>

      </tbody>
    </table>

    <br />

    <input type="hidden" name="wprmm[id]" value="<?php echo $category->id;?>" />

    <div class="wprmm-admin-nav">
      <p>
        <input class="button-primary" class="left" type="submit" name="save_category" value="Save Category" />&nbsp;
        <a class="button" href="<?php echo wprmm_admin_url('menu','index-category',$menu->id);?>">&laquo;back</a>&nbsp;
        <span><a class="button" href="<?php echo wprmm_help_link(); ?>">help?</a></span>&nbsp;
      </p>
    </div>


  </form>

</div>
