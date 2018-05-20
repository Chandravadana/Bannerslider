# Bannerslider

1. This module is created to control slider banners via the admin area.
2. In admin area you can find a grid list of all banners where you can
add/edit/delete/ banners.
3. Admin can upload image and provide a hyperlink to that image for any banner added.
4. This module provides a facility to add banner to any page or static block.

**Compability:** Magento 2.x.x 

**How to Install**
 1. Clone this repo under Chandu/Bannerslider directory
 2. Run command in your M2 root directory 
     - bin/magento module:enabled Chandu_Bannerslider
 3. Then run these command
 ```sh
 $ bin/magento setup:upgrade
 $ bin/magento setup:di:compile
 $ bin/magento cache:clean
 $ bin/magento cache:flush
 ```
 **User Information**
 
 1. Log in to your Magento 2 admin dashboard
 2. Go to Banner Slider->Manage Banners
 3. Click Add Banner to add Banner Image details
 4. Repeat step 2-3 to add more banners
 5. To Show banner slider, go to any cms page or block and add this block handle
 ```sh
 {{block template="Chandu_Bannerslider::bannerslider.phtml" class="Chandu\Bannerslider\Block\Bannerslider" name="banners"}}
 ```
 6. Clear cache and Refresh Page in frontend.
 
 **Reference Used on this Module**
 1. Magento Documentation
 1. Magento Devdocs
 2. Exising Magento source code
 3. Ash smith Blog
 4. Mageworld Blog
 5. Some other articles for frontend work
 
 **Resources Used to build this module**
 1. PHPStorm
 2. VagrantBox (LAMP Stack)
 3. Git Bash
 
 **Note:** This module is only tested manually.