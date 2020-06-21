=== WP Shopify ===
Contributors: andrewmrobbins
Donate link: https://wpshop.io/purchase/
Tags: shopify, ecommerce, store, sell, products, shop, purchase, buy, wpshopify
Requires at least: 4.7
Requires PHP: 5.6
Tested up to: 5.4.2
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Sell and build custom Shopify experiences on WordPress.

== Description ==

WP Shopify allows you to sell your [Shopify](https://www.shopify.com/?ref=wps&utm_content=links&utm_medium=website&utm_source=wpshopify) products on any WordPress site. Your store data is synced as custom post types giving you the ability to utilize the full power of native WordPress functionality. On the front-end we use the [Shopify Buy Button](https://www.shopify.com/?ref=wps&utm_content=links&utm_medium=website&utm_source=wpshopify) to create an easy to use cart experience without the use of any iFrames.

= Features =
* Sync your products and collections as native WordPress post
* Templates
* No iFrames
* Over 100+ actions and filters allowing you to customize any part of the storefront
* Display your products using custom pages and shortcodes
* Built-in cart experience using [Shopify's Buy Button](https://www.shopify.com/?ref=wps&utm_content=links&utm_medium=website&utm_source=wpshopify)
* SEO optimized
* Advanced access to your Shopify data saved in custom database tables

See the [full list of features here](https://wpshop.io/how/)

https://www.youtube.com/watch?v=v3AC2SPK40o

= WP Shopify Pro =
WP Shopify is also available in a Pro version which includes 80+ Templates, Automatic Syncing, Order and Customer Data, Cross-domain Tracking, Live Support, and much more functionality! [Learn more](https://wpshop.io/purchase)

= We want to hear from you! (Get 10% off WP Shopify Pro) =
Our next short-term goal is to clearly define the [WP Shopify roadmap](https://www.surveymonkey.com/r/3P55HXX). A crucial part of this process is learning from you! We'd love to get your feedback in a [short three question survey](https://www.surveymonkey.com/r/3P55HXX).

The questions are surrounding: 
- How you're using WP Shopify
- What problems you're solving by using the plugin
- What you like the most about the plugin

To show our appreciation, we'll send you a 10% off discount code that will work for any new purchases or renewals of WP Shopify Pro. Just add your email toward the bottom. Thanks! 🙏

[Take the WP Shopify user survey](https://www.surveymonkey.com/r/3P55HXX)

= Links =
* [Website](https://wpshop.io/)
* [Documentation](https://docs.wpshop.io)
* [WP Shopify Pro](https://wpshop.io/purchase)


== Installation ==
From your WordPress dashboard

1. Visit Plugins > Add New
2. Search for *WP Shopify*
3. Activate WP Shopify from your Plugins page
4. Create a [Shopify private app](https://docs.wpshop.io). More [info here](https://help.shopify.com/manual/apps/private-apps)
5. Back in WordPress, click on the menu item __WP Shopify__ and begin syncing your Shopify store to WordPress.
6. We've created a [guide](https://docs.wpshop.io) if you need help during the syncing process

== Screenshots ==
[https://wpshop.io/screenshots/1-syncing-cropped.jpg  Easy and fast syncing process]
[https://wpshop.io/screenshots/2-settings-cropped.jpg  Many settings and options to choose from]
[https://wpshop.io/screenshots/3-posts-cropped.jpg  Sync your store as native WordPress posts]


== Frequently Asked Questions ==

Read the [full list of FAQ](https://wpshop.io/faq/)

= How does this work? =
You can think of WordPress as the frontend and [Shopify](https://www.shopify.com/?ref=wps&utm_content=links&utm_medium=website&utm_source=wpshopify) as the backend. You manage your store (add products, change prices, etc) from within Shopify and those changes sync into WordPress. WP Shopify also allows you to sell your products and is bundled with a cart experience using the [Shopify Buy Button SDK](https://www.shopify.com/?ref=wps&utm_content=links&utm_medium=website&utm_source=wpshopify).

After installing the plugin you connect your Shopify store to WordPress by filling in your Shopify API keys. After syncing, you can display / sell your products in various ways such as:

1. Using the default pages “yoursite.com/products” and “yoursite.com/collections“
2. Shortcodes [wps_products] and [wps_collections]

We also save your Shopify products as Custom Post Types enabling you to harness the native power of WordPress.

= Doesn’t Shopify already have a WordPress plugin? =
Technically yes but it [has been discontinued](https://wptavern.com/shopify-discontinues-its-official-plugin-for-wordpress).

Shopify has instead moved attention to their [Buy Button](https://www.shopify.ca/buy-button) which is an open-source library that allows you to embed products with snippets of HTML and JavaScript. The main drawback to this is that Shopify uses iFrames for the embeds which limit the ability for layout customizations.

WP Shopify instead uses a combination of the Buy Button and Shopify API to create an iFrame-free experience. This gives allows you to sync Shopify data directly into WordPress. We also save the products and collections as Custom Post Types which unlocks the native power of WordPress.

= Is this SEO friendly? =
We’ve gone to great lengths to ensure we’ve conformed to all the SEO best practices including semantic alt text, Structured Data, and indexable content.

= Does this work with third party Shopify apps? =
Unfortunately no. We rely on the main Shopify API which doesn’t expose third-party app data. However the functionality found in many of the Shopify apps can be reproduced by other WordPress plugins.

= How do I display my products? =
Documentation on how to display your products can be [found here](https://docs.wpshop.io/#/getting-started/displaying).

= How does the checkout process work? =
WP Shopify does not handle any portion of the checkout process. When a customer clicks the checkout button within the cart, they’re redirected to the default Shopify checkout page to finish the process. The checkout page is opened in a new tab.

More information on the Shopify checkout process can be [found here](https://help.shopify.com/manual/sell-online/checkout-settings).

= Does this work with Shopify's Lite plan? =
Absolutely! In fact this is our recommendation if you intend to only sell on WordPress. More information on Shopify's [Lite plan](https://www.shopify.com/lite)


== Changelog ==
Our full changelog can be [found here](https://wpshop.io/changelog/)

= 3.0.5 =
- **Fixed:** Bug causing default pages to be repeatedly created if `wps_settings_general` table is empty

= 3.0.4 =
- **Fixed:** bug causing product single pages to hide variants and descriptions
- **Fixed:** issue causing sale notice to show when reg price and sale price match
- **Fixed:** missing color variant button when color is white
- **Fixed:** removed `row` and `col-` classes to prevent theme collisions

= 3.0.3 =

- **Fixed:** Bug causing license key issues

= 3.0.2 =

- **Fixed:** Bug causing broken add to cart functionality
- **Fixed:** Bug causing missing notice CSS

= 3.0.0 =

🙌 It's finally here! After months of hard work, I'm super excited to share WP Shopify 3.0. Not only is this the biggest release to date, it also represents a major step forward to becoming what I always envisioned the plugin to be.

I really hope this update helps everyone out during this difficult time. Ecommerce is now more important than ever, and I don't suspect that will change anytime soon.

Many more updates to come. Enjoy!

- **Feature** Cart Discount Codes (Pro only)
- **Feature** Variant Button Style (Pro only)
- **Feature** Plugin Translations for German, Spanish, French, Dutch, and Chinese
- **Feature** Conditional Cart Loading (Pro only)
- **Feature** Setup Wizard
- **Feature** Sale Notice (Pro only)
- **Feature** "Left in stock" Notice (Pro only)
- **Feature** Default Pages as native WordPress pages
- **Feature** Products can now link in new or same tab
- **Feature** Product shortcodes now allow for filtering by collections
- **Feature** Added ability to filter products using a prefix search
- **Feature** Refactored Admin Pages
- **Fixed** Bug cusinig "No route was found ..." error when permalinks were set to plain
- **Fixed** Bug causing various loading issues
- **Fixed** Bug preventing the rewrite rules from flushing after changing permalinks
- **Fixed** Bug causing some product shortcode attributes to not be available in storefront and search shortcode
- **Fixed** Bug causing checkout button to hang if .Linker not enabled 
- **Fixed** Bug causing available_for_sale attribute to fail
- **Fixed** Bug causing load more button to show an endless spinner
- **Fixed** Bug causing webbook callback URL to fail due to missing .php extension on admin_url('admin-ajax.php')
- **Fixed** Bug causing cart not to load if theme does not use body_class()
- **Fixed** Bug causing variant options not to show when only one exists
- **Fixed** Bug causing the cart line item quantity input increment and decrement to fail
- **Fixed** Bug causing quantity inputs to fail when entering an alpha character instead of number
- **Fixed** Bug preventing cart from proceeding to Shopify checkout page when Google Analyics is missing the Linker plugin
- **Fixed** Bug causing the cart loading dots to overflow vertically
- **Fixed** Bug causing infinite scrolling to sometimes fail
- **Fixed** Bug causing the browser's native increment / decrement arrows to show witin cart line items
- **Improved** The Storefront component now alphabatizes the order of tags / vendors / types
- **Improved** Added show_featured_only="" attribute to storefront shortcode
- **Improved** The "Products per page" admin setting now has a hard cap of 250
- **Improved** Introduced better codesplitting to ensure only the nessesary JavaScript is loaded
- **Improved** Product images are now preloaded on thumbnail hover which fixes image loading delay
- **Improved** Changed the range pricing label to "Price:" instead
- **Improved** Added price animations 
- **Improved** Added content loading placeholders
- **Improved** Product image zoom can now be disabled on mobile
- **Improved** Remove bootstrap css from plugin 
- **Improved** Remove the wrapping [class^="wps-"] selector
- **Improved** Product descriptions are now hidden by default
- **Improved** Moved many CSS rules into the JS to prevent theme conflicts
- **Improved** Move JS action 'after.shop.ready' to proper place
- **Improved** Plugin CSS now loads with priority of 1 before theme CSS
- **Improved** Removed the yellow "Make sure to activate your license ..." notice
- **Improved** Fixed typo under webhooks list and ensured all names are capitalized
- **Improved** Plugin now shows only the add to cart button if no variants exist
- **Improved** When only one variant exists, the plugin now shows the variant selections instead of nothing
- **Improved** Renamed the "Resync Shopify" tool to "Sync Product & Collection Detail Pages" to lessen confusion surrounding what it does
- **Improved** Now using encodeURI on the checkout product URLs for international characters
- **Improved** Removed the unused wps-templates partials to lessen confusion for Pro users
- **Dev** Added react-error-boundary to components
- **Dev** Removed React and React DOM from front-end assets
- **Dev** Removed fetch-polyfill from front-end as wp includes this by default
- **Dev** Added a data-wpshopify-is-available-for-sale attribute to each product
- **Dev** Global wpshopify variable is now frozen via Object.freeze()
- **Dev** Cleaned up unused Classes like Routes
- **Dev** Added new PHP action "wps_finished_syncing_products"
- **Dev** Added new PHP action "wps_finished_syncing_collections"
- **Dev** Added new JS action: 'after.app.init'
- **Dev** Added new JS action: 'before.payload.update'
- **Dev** Added new JS action: 'after.payload.update'
- **Dev** Added new JS filter: 'pagination.loadMore.text'
- **Dev** Added new JS filter: 'cart.lineItems.maxQuantity'
- **Dev** Added new JS filter: 'cart.lineItems.minQuantity'
- **Dev** Added new JS filter: 'cart.lineItems.quantityStep'
- **Dev** Added new JS filter: 'buyButton.quantityStep'
- **Dev** Added new JS filter: 'misc.link.target'
- **Dev** Added new JS filter: 'misc.inventory.leftInStock.total'
- **Dev** Added new JS filter: 'product.variant.styles.colorSwatch.names'
- **Dev** Added new JS filter: 'product.variant.styles.colorSwatch.value'
- **Dev** Added new JS filter: 'product.variant.styles'
- **Dev** Added new JS filter: 'default.image.zoom.options' [Available options](https://github.com/imgix/drift#options--defaults)

= 2.2.7 =

* 🛠 Fixed: Bug causing admin page conflicts with other plugins

= 2.2.6 =

* 🛠 Fixed: Compatibility bug with various plugins like Ninja Forms causing broken admin pages

= 2.2.5 =

* 🛠 Fixed: Bug preventing cart from proceeding to the Shopify checkout page when Google Analyics is missing the Linker plugin.

= 2.2.4 =

Hello! Today's update contains an important bug fix and preparations for 3.0!

* 🛠 Fixed: Bug causing load more button to show an endless spinner
* 📣 Updated: Added WordPress 5.4 compatibility

= 2.2.3 =

* 🛠 Fixed: Bug causing validation error when entering Shared Secret: "Must contain only numbers and letters"

= 2.2.2 =

* 🛠 Fixed: Bug causing "No products found" during sync

= 2.2.1 =

* 🛠 Fixed: Bug causing disappearing cart icon
* 🛠 Fixed: Bug causing loading indicator overflow on cart icon 
* 🛠 Fixed: Bug causing media to sync when not syncing products or collections (Pro only)
* 🛠 Fixed: Bug causing syncing to fail when "sync by collections" is turned on, and products are assigned to more than one collection (Pro only)
* 🛠 Fixed: causing cart terms, custom attributes, and cart notes to sometimes fail to load (Pro only)
* 📣 Updated: Added version to API endpoints for better flexibility
* 📣 Updated: No longer showing syncing warning when zero "collects" are found
* 💻 Dev: Added unit tests for config constant values
* 💻 Dev: Added new PHP filter: wps_collections_single_args
* 💻 Dev: Added new PHP filter: wps_collections_all_args
* 💻 Dev: Added new JS filter: cart.maxQuantity
* 💻 Dev: Added new SEO Meta fields for future (Pro only)
* 💻 Dev: Updated JS dependencies

= 2.2.0 =

* 📦 New Feature: Sync featured images (Pro only)
* 🛠 Fixed: Bug causing plugin settings to wipe out occasionally
* 🛠 Fixed: Bug causing fatal errors when activating free and pro versions at the same time
* 🛠 Fixed: Preventing Add to cart button width from spilling out of container
* 📣 Updated: Now deleting custom plugin options from options table during uninstall
* 📣 Updated: Improved the UI progress bars during sync
* 📣 Updated: Miscellaneous plugin settings copy
* 💻 Dev: Added opt-in plugin usage tracking 
* 💻 Dev: Added new JS action: before.checkout.redirect
* 💻 Dev: Updated dependencies

= 2.1.4 =

* 📣 Updated: WordPress 5.3.1 compatibility
* 💻 Dev: Added new JS filter: 'product.buyButton.before'
* 💻 Dev: Added new JS filter: 'product.buyButton.after'

= 2.1.3 =

* 🛠 Fixed: Bug causing plugin updates to not show within pro version
* 💻 Dev: Added new JS filter: 'set.checkout.discount'
* 💻 Dev: Added new JS filter: 'before.directCheckout.lineItems'

= 2.1.2 =

Greetings! Lots of a good bug fixes today.

* 📦 New Pro Feature: Webhooks are now available as templates within the wps-templates folder
* 📦 New Pro Feature: Added a new `Remove Automatic Post Syncing` tool
* 🛠 Fixed: Bug causing the custom menu item "cart icon" to not render
* 🛠 Fixed: Bug causing add to cart buttons to not load when "load cart" setting not enabled
* 🛠 Fixed: Bug causing "Loading ..." to show indefinitely for some users
* 🛠 Fixed: Bug causing selective sync options to not persist during save
* 🛠 Fixed: Bug in visual builder causing custom Shopify credentials to fail when removing old credentials 
* 📣 Updated: Refactored the way automatic post syncing / webhooks work 
* 📣 Updated: Adjusted styling of inline cart notice
* 📣 Updated: Temporarily removed add_role() for Customers integration
* 📣 Updated: Removed holiday sale copy
* 💻 Dev: Added favicons to demo and docs site 
* 💻 Dev: Added new JS filter: `cart.empty.text`
* 💻 Dev: Added new JS filter: `cart.lineItems.link`
* 💻 Dev: Added new JS filter: `cart.lineItems.disableLink`

= 2.1.1 =

* 📦 New Feature: Added "Direct Checkout" for Pro users
* 🛠 Fixed Ninja forms plugin conflict by loading JS in footer instead of defer
* 🛠 Fixed bug causing selected admin tabs not to persist after page reloads
* 🛠 Fixed bug causing Sync posts to be checked upon initial install 
* 🛠 Fixed bug in pro version where plugin updates wouldn't show until plugin is deactivated
* 🛠 Fixed removed unused add-ons settings menu item 
* 📣 Updated: Holiday sale and promotion notifications
* 📣 Updated: Default cache time from 5mins to 2mins
* 💻 Dev: New JS filter: 'product.addToCart.text'

= 2.1.0 =

Hello wonderful people! 👋

Really excited about this release. `2.1` brings a lot of great enhancements and some much needed fixes.

Some of the most notable updates are faster load times, compatibility fixes to plugins like Jetpack, image lazy loading, and an annoying bug preventing the back button from working on product pages.

Finally, you can now use the visual builder with your own product data! [Take a look!](https://demo.wpshop.io/builder)

* 📦 New feature: Ability to toggle product descriptions for the default PLP pages
* 📦 New feature: Ability to hide decimals in product prices
* 📦 New feature: Added lazy loading to product images to speed up loading
* 🛠 Fixed: Issue causing back button from working properly when variant dropdowns are selected
* 🛠 Fixed: Cart spacing issues with certain WordPress themes
* 🛠 Fixed: Variant dropdown styling conflicts with certain WordPress themes
* 🛠 Fixed: Missing default width and height for product feature images
* 🛠 Fixed: Missing default width and height for collection image
* 🛠 Fixed: bug causing Utils::get_site_url() to return wrong URL for multi-site
* 🛠 Fixed: Visual builder bug causing bad values to appear within shortcode
* 🛠 Fixed: Bug preventing the Jetpack gallery from loading
* 🛠 Fixed: CSS theme conflicts with classes like .row and .container
* 🛠 Fixed: Bug causing the user-defined "sort_by" value to not show in Storefront component
* 🛠 Fixed: Bug causing Search component to return invalid query string when form is empty
* 🛠 Fixed: Removed webhooks and disabled the legacy autosync to prevent settings removal bug
* 📣 Updated: Speed improvements to during initial load time
* 📣 Updated: Changed Plugin menu links within Dashboard
* 📣 Updated: Changed "No products found" to "No products left to show" to reduce confusion
* 📣 Updated: Various copy changes to the plugin Settings
* 📣 Updated: Temporarily hiding customer plugin settings until feature is finished
* 📣 Updated: Now showing products and collections plugin menu items by default
* 📣 Updated: Added a notice on the products and collections edit screen if Sync posts is not enabled
* 📣 Updated: Changed wording from "Shortcode builder" to "Visual builder"
* 📣 Updated: Compatibility updates for WordPress 5.3
* 📣 Updated: Compatibility updates for Twenty Twenty theme
* 💻 Dev: Conditional plugin bootstrap depending on whether is_admin() or not.
* 💻 Dev: Added 'compareAtPriceV2' to product variant
* 💻 Dev: Added 'sku' to product variant
* 💻 Dev: Added 'requiresShipping' to product variant
* 💻 Dev: Added 'weight' to product variant
* 💻 Dev: Added 'weightUnit' to product variant
* 💻 Dev: Added 'priceV2' to product variant
* 💻 Dev: Added 'availableForSale' to product variant
* 💻 Dev: Added new PHP filter: wps_products_all_args
* 💻 Dev: Added new PHP filter: wps_products_single_args
* 💻 Dev: Added new JavaScript action 'after.cart.ready' that fires when the cart is finished loading
* 💻 Dev: Added new JavaScript action 'after.shop.ready'
* 🧩 Visual Builder: Created ability to add your own products to the builder
* 🧩 Visual Builder: Added ability to "reset" selections easily
* 🧩 Visual Builder: Now persisting selections after page reloads
* 📚 Documentation: Added new section called "Features" with descriptions of notable plugin functionality
* 📚 Documentation: Added "comparison chart" showcasing the features between the Pro and free version
* 📚 Documentation: Added icons to highlight different sections

= 2.0.17 =

* 🛠 Fixed: Syncing failure when max_input_vars exceeded.
* 🛠 Fixed: Bug causing plugin to fail when WordPress installed under nested sub directories.
* 📦 Added: New JavaScript action 'on.checkout.update' allowing for getting the current checkout state.
* 📦 Added: New JavaScript action 'items.init' allowing for access to initial state of products.
* 📣 Updated: Removed the debug plugin settings section in favor of the WordPress Site Health
* 💻 Dev: Adjusted the handle_fatal_errors method to whitelist error codes instead of only checking NULL

= 2.0.16 =

* 🛠 Fixed: Bug causing Customer Accounts to load improperly
* 📦 Added: Shortcode builder links throughout admin settings

= 2.0.15 =

Hello wonderful people! 👋

This release contains a decent amount of bug fixes and overall plugin stability changes. Also along for the ride are new shortcode attributes that allow you to change colors and font sizes. Highly demanded!

We also just released a new [shortcode builder](https://demo.wpshop.io/builder/) tool!. At the moment, this tool will only be available on the demo site linked above, but will eventually be incorporated into the WordPress dashboard.

Have a great evening!

* 📣 Updated: Better error handling during the syncing process
* 📣 Updated: Change lookup key for customers to email instead of customer_id
* 📣 Updated: Changed style of empty cart notice
* 🛠 Fixed: Syncing failure when variant fields option1, option2, or option3 are too long
* 🛠 Fixed: Bug causing collection single pages to only show one product
* 🛠 Fixed: Error when installing the plugin within certain subdirectory setups
* 🛠 Fixed: Notice styles showing during content loading
* 🛠 Fixed: Bug causing general settings custom table to be cleared after deleting free version when pro is activated 
* 📦 Added: More customer integration updates
* 📦 Added: New [wps_products] shortcode attribute: "title_size"
* 📦 Added: New [wps_products] shortcode attribute: "title_color"
* 📦 Added: New [wps_products] shortcode attribute: "description_color"
* 📦 Added: New [wps_products] shortcode attribute: "description_size"
* 📦 Added: New [wps_products] shortcode attribute: "description_length"
* 📦 Added: New [wps_products] shortcode attribute: "align_height"
* 📦 Added: Ability to open cart with new JavaScript action hook: "cart.toggle"
* 💻 Dev: Added data attribute to cart describing when cart is empty or not

= 2.0.14 =
Bug fixes and WordPress 5.2.3 support. Have a great weekend everyone!

* 🛠 Fixed: Layout spacing issues caused by empty HTML elements
* 📦 Added: Ability to fully customize the page URL for collections and products
* 📦 Added: New JavaScript filter: default.cart.notes.label
* 💻 Dev: Added instagram link to Help tab

= 2.0.13 =
Bug fixes and WordPress 5.2.3 support. Have a great weekend everyone!

* 🛠 Fixed: Incorrectly loading <Customers> component in free version
* 🛠 Fixed: Removed hardcoded shopify domain for customer requests
* 🛠 Fixed: Bug in Pro version causing blank modal screen when clicking: View version details 
* 🛠 Fixed: ABSPATH error when plugin is activated on a subdirectory WP installation
* 📦 Added: Support for WordPress 5.2.3
* 📦 Added: A new 'wpshopify' namespace to all get_footer() and get_header() calls
* 💻 Dev: Removed unused Customers code
* 💻 Dev: No longer caching the Shopify JS SDK client in localStorage
* 💻 Dev: Removed localForage library in favor of store library

= 2.0.12 =
Greetings! Lots of a good bug fixes today. Also for Pro users, the new Customer Accounts is available as a beta! Just turn it on under the plugin settings. Over the coming weeks we'll be adding more stability and features. Stay tuned.

* 🛠 Fixed: Bug preventing free version uninstall when Pro version was activated 
* 🛠 Fixed: Function name collisions within autoloader when both free and pro version are installed
* 🛠 Fixed: Issue causing duplicates to appear on product and collection single pages
* 📦 Added: New JavaScript filter hook: 'product.title.before'
* 📦 Added: New JavaScript filter hook: 'product.title.after'
* 📦 Added: Cart state data to both the 'cart.checkout.before' and 'cart.checkout.after' hooks
* 📦 Added: Set limit to one on product and collection single pages to prevent duplicates 
* 📦 Added: Customer Accounts beta
* 📣 Updated: Changed various links within the readme.txt of free version
* 💻 Dev: Replaced wp.hooks conditional checks with a single consistent function

= 2.0.11 =

* 🛠 Fixed: version issue

= 2.0.10 =

Hello! A couple of important bug fixes today. Customer accounts coming soon!

* 📦 Added: New JS filter hook: 'cart.checkout.before'
* 📦 Added: New JS filter hook: 'cart.checkout.after'
* 🛠 Fixed: Storefront filter not taking more than one value on initial load
* 🛠 Fixed: Unable to reverse products order when using the [wps_collections] shortcode
* 💻 Dev: Foundation for Customer Accounts integration
* 💻 Dev: Updated npm dependencies

= 2.0.9 =

* 📣 Add: Cache clearing after plugin update to prevent JavaScript errors
* 💻 Dev: Added unit tests for after_upgrader_process_complete method
* 💻 Dev: Added unit tests for wps_collections shortcode

= 2.0.8 =

* 🛠 Fixed: Bug in the [wps_collections] shortcode where the `products_` attributes fail to work properly
* 🛠 Fixed: The plugin setting "Show fixed cart icon" was not working
* 🛠 Fixed: Bug inside class-attributes->attr() causing default values to override user values
* 📣 Updated: Removed extra whitespace on the product single template
* 💻 Dev: Added type checking for capitalizeFirstLetter()
* 💻 Dev: Added unit tests for [wps_collections] shortcode 

= 2.0.7 =

Hey folks,

Today's update contains another round of bug fixes. If you're having trouble with products not linking to Shopify, custom domains not working, or issues the Storefront shortcode please update!

* 📦 Added: Animation for Storefront products
* 🛠 Fixed: Bug causing product and collection single pages to not properly use all shortcode attributes
* 🛠 Fixed: Broken slider styles
* 🛠 Fixed: Bug causing "Products link to Shopify" to not work
* 🛠 Fixed: Bug causing enable custom domain not to work
* 🛠 Fixed: Bug causing product variant dropdowns to show beneath the image of the product below it
* 💻 Dev: Added ESLint with React Hooks plugin
* 💻 Dev: Improved performance of Storefront component by implementing an in-memory caching

= 2.0.6 =

Hey everyone,

This release contains important updates for overall plugin stability. Please upgrade as soon as you can.

* 🛠 Fixed missing "checkbox" in the cart terms
* 🛠 Fixed bug causing incorrect error message(s) to display during syncing process
* 📦 Added default value for getPageSizeFromComponentOptions
* 📦 Added empty data validation checks to update_shop()
* 📦 Added new filter hook for the loading text: wps_loading_text
* 📦 Added better sanitization and validation of REST endpoints
* 📦 Added unregister_post_type during plugin deactivation
* 📣 Updated WPS_ namespace to WP_Shopify throughout plugin
* 📣 Updated webhooks URL to webhooks domain to more accurately describe what it is
* 📣 Updated loading element from span to div 
* 📣 Updated "Reconnect Automatic Syncing" to "Reconnect Automatic Post Syncing"
* 📣 Updated the way we're determining plugin paths and directories
* 📣 Updated WP_SHOPIFY_PLUGIN_FILE_RELATIVE_TO_PLUGINS_DIR to WP_SHOPIFY_BASENAME
* 📣 Removed unused REST endpoints
* 📣 Removed unused constants
* 📣 Removed externally loaded jquery-ui css 

= 2.0.5 =

⚠️ Important security patch. Please update ASAP!

* 🛠 Fixed: Bug causing cart notes not to work after typing.
* 🛠 Fixed: Major XSS security vulnerability.
* 🛠 Fixed: 500 error caused by improper wp_shopify_cache_cleared checks.
* 🛠 Fixed: When products have more than one image, links to product single pages were not working.
* 🛠 Fixed: Bug with dirname() when not using PHP 7+.
* 💻 Dev: Added proper permission_callbacks to REST API endpoints.
