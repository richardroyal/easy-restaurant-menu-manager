<?php
defined('WPRMM_PATH') or die();

wprmm_save_item();

$item = new WPRMM_Item((int) $_GET['item_id']);
$menu = new WPRMM_Menu((int) $item->menu_id);
$icons = WPRMM_ICON::get_all();
$category = new WPRMM_Category();
$categories = $category->get_all($menu->id);
?>
<div class="wrap wprmm">
  <img class="left" style="margin:0 15px 0 0" src="<?php echo WPRMM_URL.'images/menumanagericon_50x50.jpg'?>" />
  <h2 class="left">Restaurant Menu Manager - Edit Items</h2>
  <div class="clear"></div>
  <hr />

  <?php wprmm_get_help();?>

  <p class="wprmm-breadcrumb">
    <a href="<?php echo admin_url('admin.php?page='.WPRMM_ADMIN_URL);?>">Menus</a> &raquo; 
    <a href="<?php echo wprmm_admin_url('menu','edit-menu',$menu->id);?>"><?php echo $menu->name;?></a> &raquo; 
    <a href="<?php echo wprmm_admin_url('menu','index-item',$menu->id);?>">Items</a> &raquo;
    <a href="<?php echo $_SERVER['REQUEST_URI']; ?>"><?php echo $item->name;?></a>
  </p>

  <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

    <table class="form-table">
      <tbody>

        <tr valign="top">
          <th scope="row"><label for="wprmm[name]">Name</label></th>
          <td><input name="wprmm[name]" type="text" value="<?php echo $item->name;?>" class="regular-text">
              <span class="description">Display name for this item.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[description]">Description</label></th>
          <td><textarea name="wprmm[description]" class="large-text code"><?php echo $item->description;?></textarea>
              <span class="description">Display description for this item.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row">Upload Image</th>
          <td>
            <label for="upload_image">
              <input id="upload_image" type="text" size="36" name="wprmm[image]" value="" onclick="alert('You must upgrade to the extended version to add images to menu items.');" />
              <input id="upload_image_button" type="button" value="Upload Image" />
              <span class="description">Enter an URL or upload an image for this item.</span>
            </label>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[price]">Price</label></th>
          <td><input name="wprmm[price]" type="text" value="<?php echo $item->price;?>" class="regular-text">
              <span class="description">Displayed Price. Include denomination if desired.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[second_price]">Secondary Price</label></th>
          <td><input name="wprmm[second_price]" type="text" value="<?php echo $item->second_price;?>" class="regular-text">
              <span class="description">Use to display half and full order prices, or price with special side etc.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[show_price]">Show Price</label></th>
          <td>
            <input type="checkbox" name="wprmm[show_price]" value="1" <?php echo ($item->show_price == 1) ? 'checked' : '';?>/>
            <span class="description">Display the price for this item.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[category_id]">Category</label></th>
          <td>
            <select name="wprmm[category_id]" class="regular-text code">
              <?php foreach($categories as $cat):?>
                <option value="<?php echo $cat->id;?>" <?php echo ($item->category_id == $cat->id)? 'selected' : '';?>><?php echo $cat->name;?></option>
              <?php endforeach;?>
              <option value="0" <?php echo ($item->category_id == "0")? 'selected' : '';?>>None (hidden)</option>
            </select>
            <span class="description">Category for this item in this menu. Controls layout of items. Setup Categories and then items.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[active]">Active</label></th>
          <td>
            <input type="checkbox" name="wprmm[active]" value="1" <?php echo ($item->active == 1) ? 'checked' : '';?>/>
            <span class="description">Display this item.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[display_order]">Display Order</label></th>
          <td><input name="wprmm[display_order]" type="text" value="<?php echo $item->display_order;?>" class="regular-text">
              <span class="description">Order in which this item is displayed to users.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[icon_class]">Icon</label></th>
          <td>
            <select name="wprmm[icon_class]" class="regular-text code">
              <option value=""></option>
              <?php foreach($icons as $i):?>
                <option value="<?php echo $i->id;?>" <?php echo ($item->icon_class == $i->id) ? 'selected' : '';?>>
                  <?php echo $i->name;?>
                </option>
              <?php endforeach;?>
            </select>
            <span class="description">Special icon displayed next to item title.</span>
          </td>
        </tr>

      </tbody>
    </table>

    <br />

    <input type="hidden" name="wprmm[id]" value="<?php echo $item->id;?>" />

    <div class="wprmm-admin-nav">
      <p>
        <input class="button-primary" class="left" type="submit" name="save_item" value="Save Item" />
        <a class="button" href="<?php echo wprmm_admin_url('menu','index-item',$menu->id);?>">&laquo;back to Items</a>&nbsp;
        <span>
          <a class="button" href="<?php echo wprmm_admin_url('menu','new-item',$menu->id);?>">+ Add New Item</a>&nbsp;
          <a class="button" href="<?php echo wprmm_help_link(); ?>">help?</a>
        </span>&nbsp;
      </p>
    </div>


  </form>

</div>
