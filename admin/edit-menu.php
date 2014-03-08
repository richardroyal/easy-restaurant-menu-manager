<?php
defined('WPRMM_PATH') or die();

wprmm_save_menu();

$menu = new WPRMM_Menu((int) $_GET['menu_id']);

?>
<div class="wrap wprmm">
  <img class="left" style="margin:0 15px 0 0" src="<?php echo WPRMM_URL.'images/menumanagericon_50x50.jpg'?>" /><h2 class="left">Restaurant Menu Manager - Edit Menu</h2>
  <div class="clear"></div>
  <hr />

  <?php wprmm_get_help();?>

  <p class="wprmm-breadcrumb">
    <a href="<?php echo admin_url('admin.php?page='.WPRMM_ADMIN_URL);?>">Menus</a> &raquo; <a href=""><?php echo $menu->name;?></a>&nbsp;&nbsp;
    (<a href="<?php echo wprmm_admin_url('menu','index-category',$menu->id);?>">edit categories</a>, <a href="<?php echo wprmm_admin_url('menu','index-item',$menu->id);?>">edit items</a>)
  </p>


  <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

    <table class="form-table">
      <tbody>

        <tr valign="top">
          <th scope="row"><label for="wprmm[name]">Name</label></th>
          <td><input name="wprmm[name]" type="text" value="<?php echo $menu->name;?>" class="regular-text">
              <span class="description">Display name for this menu.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[show_title]">Show title on frontend?</label></th>
          <td>
            <input type="checkbox" name="wprmm[show_title]" value="1" <?php echo ($menu->show_title == 1) ? 'checked' : '';?>/>
            <span class="description">Display menu title?</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[description]">Description</label></th>
          <td><textarea name="wprmm[description]" class="large-text code"><?php echo $menu->description;?></textarea>
              <span class="description">Display description for this menu.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="shortcode">Shortcode</label></th>
          <td>
              <input name="shortcode" type="text" class="regular-text" 
                     value='[WP_Restaurant_Menu id="<?php echo htmlentities($menu->id);?>"]' readonly="readonly" />
              <span class="description">Put this shortcode into a Page or Post for this menu to appear.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[show_link]">Show print link?</label></th>
          <td>
            <input type="checkbox" name="wprmm[show_link]" value="1" <?php echo ($menu->show_link == 1) ? 'checked' : '';?>/>
            <span class="description">Shows the link to the printer friendly version of the menu on the frontend.</span>
          </td>
        </tr>
        
        <tr valign="top">
          <th scope="row"><label for="wprmm[rss2]">Turn on RSS?</label></th>
          <td>
            <input type="hidden" name="wprmm[rss2]" value="0" />
            <input type="checkbox" name="wprmm[rss2]" value="1" <?php echo ($menu->rss2 == 1) ? 'checked' : '';?> />
            <span class="description">
              Allow RSS feed of menu. RSS2 Feed URL:<br />
              <a href="<?php echo $menu->rss2_url;?>" target="_blank"><?php echo $menu->rss2_url;?></a>
            </span>
          </td>
        </tr>        
        

      </tbody>
    </table>

    <input type="hidden" name="wprmm[id]" value="<?php echo $menu->id;?>" />
    
    <div class="wprmm-admin-nav">
      <p>
        <input class="button-primary" class="left" type="submit" name="save_menu" value="Save Menu" />&nbsp;
        <a class="button" href="<?php echo admin_url('admin.php?page='.WPRMM_ADMIN_URL);?>">&laquo;back</a>&nbsp;
        <span><a class="button" href="<?php echo wprmm_help_link(); ?>">help?</a></span>&nbsp;
      </p>
    </div>

  </form>

</div>
