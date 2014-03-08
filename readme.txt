=== Easy Restaurant Menu Manager ===
Contributors: sarahtebo, richardroyal
Donate link: http://www.sailabs.co/products/easy-restaurant-menu-manager-wordpress/
Tags: restaurant, eatery, menus, hotel, bar, list
Requires at least: 3.1.1
Tested up to: 3.8.1
Stable tag: 1.0.0

Makes it easy for a restaurant to maintain an online menu. Includes categories, prices and descriptions that are a snap to update.

== Description ==

= Easy Restaurant Menu Manager =

Tired of using PDFs to post your restaurant's menus online? Easy Restaurant Menu Manager makes it simple to add and update all your dishes in a way that's easy for your site's visitors to read and easy for you to maintain. You can add categories like appetizers, entrees or desserts -- name them whatever you want -- and set the order those categories should display in. Include a description for each item, and decide whether or not you want to display the price. Want to tweak the display? Add CSS right from the plugin, without fiddling with theme files. This plugin isn't just for restaurants. Spas, service stations and others can use it to share their menu of services.

= Docs & Support =

* [Project Homepage](http://www.sailabs.co/products/easy-restaurant-menu-manager-wordpress/)
* [Extended Version](http://www.sailabs.co/products/easy-restaurant-menu-manager-wordpress/)
* [Free Support](https://sailabs.zendesk.com/hc/en-us/categories/200015454-Easy-Restaurant-Menu-Manager-for-WordPress)
* [Daily Specials Add-on](http://www.sailabs.co/products/easy-restaurant-menu-manager-daily-specials-widget/)
* [Customizing Fonts](https://sailabs.zendesk.com/hc/en-us/articles/200463870-Custom-fonts-using-CSS)

= Demos =

* [Example Lunch Menu](http://product-demo.wp-easy-restaurant-menu-manager.sailabs.co/lunch-menu)
* [Example Dinner Menu](http://product-demo.wp-easy-restaurant-menu-manager.sailabs.co/dinner-menu)

= Features =

We offer a free version of ERMM, as well as an extended paid version. Your purchase allows us to continue developing and improving the plugin, while providing free support through our Zen Desk support forum.

**Free Version**

* Easy restaurant menu management
* Place restaurant menus anywhere with shortcodes
* Built in print view with printer friendly stylesheet
* RSS Feed for each menu
* Multiple layouts for items
* Easily activate and deactivate menu items to match your inventory
* Easy CSS customizations of views
* Easy HTML/PHP customizations of views for full control
* Supports common responsive frameworks like Twitter Bootstrap and Foundation
* Filter which categories get shown through the shortcode

**Extended Version**

* Create multiple menus
* WYSIWYG editor on menu and category descriptions
* Media Uploader on menu item image fields
* Create and edit your own icons for labeling items like new or spicy

= Extend =

* There is an [Extended Version](http://www.sailabs.co/products/easy-restaurant-menu-manager-wordpress/) with more features and better support.
* There is a [Daily Specials Add-on](http://www.sailabs.co/products/easy-restaurant-menu-manager-daily-specials-widget/) widget that connects to existing menus and allows you to set specials for each day of the week!
* Add your feature requests through the SAI Digital Labs forum and we will put them on the dev list! Note: SAI Digital Labs Plugin development is funded through purchases of the extended version and donations.

== Installation ==

1. Unzip the plugin and upload it to your site's wp-content/plugins folder.
2. Activate Easy Restaurant Menu Manager through the "plugins" area in your WordPress dashboard.
3. A new menu item called "Manage Menus" will appear in your dashboard navigation. You can go there to start creating menus, categories and items.

== Frequently Asked Questions ==

= Where can I get support? =
We offer free support from our Zendesk-powered Help Center: [Easy Restaurant Menu Manager for WordPress Support Forum](http://sailabs.zendesk.co)

= What will the menu look like on my site? =
The Easy Restaurant Menu Manager plugin is designed to work with your WordPress site's theme, using your fonts and colors to seamlessly fit in with the rest of your site. If you want to tweak how the menu displays, you can enter custom CSS into the plugin from the settings panel.

= Can I include images of menu items? =
The free version doesn't include an option to upload photos, but that feature is available in the extended version.

= What size should my image be? =
It's best to not upload giant versions of your photos, since they are being downsized to 100px wide on the menu. A width of around 600px is a good target, since the file size won't be unmanageable and visitors can still get a good look at the item when they click on the thumbnail.

= How are menu items organized? =
You probably have your menu organized into categories like appetizers, entrees and desserts on your printed menu, and you can do the same thing with this plugin. You can even add extra text that will display below the category name, such as note explaining that all entrees come with two sides.

= Is there a way to note if an item is special, like it's new or spicy? =
Not in the free version, but in the extended version, you can use icons to show that items are new, spicy, vegetarian, healthy or house specialities. Extended version users can also add their own icons!

= Can I hide items or categories, such as seasonal items, without deleting them? =
Yes! You can deactivate items and categories so you don't want to show. This allows you to remove an item from your menu without losing all the information you've added. 

= How many menus can I create? =
Using the free version, you can create one menu only. However, with the extended version, you can create unlimited menus.

= How do I insert my menu into a page or post? =
Just use the shortcode [WP_Restaurant_Menu id="{DB id}"], the id and entire shortcode is made available on the menu edit screen on the WordPress backend.

= Can I use a shortcode to only show certain categories? =

Yes. Add a 'categories' key to the shortcode including a comma separted list of numeric ids for the categories you want to show from within the menu. For example: [WP_Restaurant_Menu id="1" categories="1,2,6,8"] would show items in categories 1,2,6,8, and [WP_Restaurant_Menu id="1" categories="1"] only shows items from category 1. The category ids can be found on the admin category index.

= What about printing the menu? =
We know many restaurants want to provide a version of their menu that customers can print and keep on hand. With the Easy Restaurant Menu Manager plugin, you can choose to include a "Print this menu" link that will generate a printer-friendly version of your menu.

= What about 3rd party integration? =
Each menu has its own RSS feed, which means customers can easily keep track of changing, special menus!

== Screenshots ==

1. Item index admin 
2. Item admin
3. Edit category
4. Print on frontent
5. Menu in theme
6. Menu in theme
7. Menu in theme
8. Menu in theme
9. Menu as viewed in an RSS feed reader

== Changelog ==

= 1.5.0 =
* Added category shortcodes to allow easy modification of which categories are shown.
* Added shortcode to menu index.
* Added link to items index on item edit.
* Fixed minor encoding bug on menu XML RSS feed.
* Combed through plugin functions with debug on to remove warnings. 

= 1.4.1 =
* Added new links to Zen Desk support Help Center in plugin and on readme.

= 1.4.0 =
* Made it easier to add custom layouts.
* Added responsive layouts for Twitter Bootstrap and Zurb Foundation.

= 1.3.0 =
* Added better breadcrumb navigation for admin.
* Buffered delete clicks with JS pop-up alert.
* Fixed checkbox saving issue on new records.

= 1.2.2 =
* Cleaned up PHP notices with WordPress DEBUG feature for new items form.

= 1.2.1 =
* Cleaned up PHP notices with WordPress DEBUG feature. 

= 1.1.1 =
* Added dynamic print stylesheet that is easily customizable on backend.
* Used CSS !important tag to forcibly remove bullets points from ul and li elements.
* Clearified Default Category meaning on backend.

= 1.1.0 =
* Added RSS2 Feed for each menu.

= 1.0.9 =
* Fixed bug preventing users with editor role from editing menu content.

= 1.0.8 =
* Converted newlines to HTML break tags on output of menu, category, and item descriptions on frontend view.

= 1.0.7 =
* Allowed editors, not just admins to edit menus.

= 1.0.6 =
* Added boolean for choosing whether to display menu title on frontend.

= 1.0.5 =
* Added unique CSS ID to each menu.

= 1.0.4 =
* Improved directions on backend for item category.
* Fixed spelling issue on backend.
* Forced new items to have display_order = 0.
* Made $item->display_order = 0 when POST'ed as blank.

= 1.0.3 =
* Added secondary menu price for full and half order etc prices. 
* Improved the admin Settings page directions.

= 1.0.2 =
* Fixed bug in print friendly view in pulling correct menu by id. Added meta charset UTF-8 on printer friendly output.

= 1.0.1 =
* Fixed bug relating to items table SQL pull (thanks ngreenwood).

= 1.0.0 =
* Originating version.

== Upgrade Notice ==

= 1.1.0 =
Requires Deactivation and then Activation to flush database change. You will not lose any data.

= 1.0.6 =
Requires Deactivation and then Activation to flush database change. You will not lose any data.

= 1.0.3 =
Adds ability to have two prices for an item, for example: Full Price, Half Price etc. Requires that you Deactivate and then Activate plugin to flush database change for extra field. You will not lose any currently setup menus.

= 1.0.0 =
Originating version.
