<?php
defined('WPRMM_PATH') or die();
wprmm_save_global_settings();

$custom_css = get_option('wprmm_custom_css');
$custom_print_css = get_option('wprmm_custom_print_css');

?>
<div class="wrap wprmm wprmm_settings">
  <img class="left" style="margin:0 15px 0 0" src="<?php echo WPRMM_URL.'images/menumanagericon_50x50.jpg'?>" />
  <h2 class="left">Restaurant Menu Manager - Global Settings</h2>
  <div class="clear"></div>
  <hr />

  <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

    <div class="help custom_css">
      <h2>Tweaking plugin display styles</h2>

      <p>The <a href="http://www.sailabs.co/products/easy-restaurant-menu-manager-wordpress/">Easy Restaurant Menu Manager</a> plugin is designed to look great with whatever theme you're using, but some site owners may want to tweak some of the styles output by the plugin. There are two ways to do this. You can create your CSS in a file named "custom.css" and add it to the plugin's css folder. Or, enter your custom CSS directly into the box provided below. Use your browser's development tools, such as Firebug, to get the classes and IDs for the items you want to style.</p>
      <ul>
        <li>Setup your custom CSS:
          <ul>
            <li>Put your CSS in a file named custom.css and add it to the plugins's css folder <br />(<?php echo WPRMM_PATH;?>css/custom.css).</li>
            <li><strong>or</strong></li>
            <li>Use the custom field box below to input CSS into your database.</li>
          </ul>
        </li>
        <li class="wprmm_textarea">
          <textarea name="wprmm[custom_css]" class="large-text code"><?php echo $custom_css;?></textarea>
          <ul>
            <li class="description">The parent CSS class for all menus is: .wprmm_menu</li>
            <li class="description">Each menu gets a unique CSS id based on the database record: #wprmm_menu_{id}</li>
            <li class="description">The styles are outputed in the order: style.css, custom from database, and custom.css</li>
          </ul>
        </li>

      </ul>


      <h2>Custom Print CSS</h2>
      <p>Here you can add custom styles that are only applied to the print view. Use this to hide images or add a background.</p>
      <div class="wprmm_textarea">
        <textarea name="wprmm[custom_print_css]" class="large-text code"><?php echo $custom_print_css;?></textarea>
      </div>


    </div>



    <input class="button-primary" class="left" type="submit" name="save_options" value="Save Options" />&nbsp;
    <div class="clear"></div>

  </form>

</div>
