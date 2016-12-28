# iA4 Theme Documentation

## Installation
Install iA4 by completing the following steps:

1. Put the iA4 directory in your WordPress installation’s theme folder (wp-content/themes).
2. In the WordPress backend, you should now find the theme under *Appearance* → *Themes*. 
3. Click *Activate* to activate iA4.

## Using the iA4 Theme

### Using Featured Images
iA4 supports regular and extra wide featured images. If you would like to display an extra wide image above your post or page, upload a featured image, save the post or page, then click *Expanded image* in the featured image section before hitting *Update* once more.

After saving a featured image, you will also get control over the display location: you can choose to display featured images on overview pages and on single pages, or in both locations. Featured images for portfolio pages will always show up on the portfolio overview, the overview setting will be ignored in this case.

### Portfolio
iA4 supports the Jetpack Portfolio Projects content type. If you want to set up a portfolio, proceed as follows:
- Download, install and activate Jetpack
- Enable Custom Content Types in Jetpack
- Under *Settings* → *Writing*, check *Portfolio Projects*
- Start entering your content under the new nav point *Portfolio* in the backend
- You can even define project types and assign them to your projects. Your portfolio will be sorted accordingly.

### Front Page

If you'd like to display your portfolio on the front page, set it up as described above, then proceed as follows:
- Create a single page, e.g. "Portfolio Homepage"
- Assign the "Portfolio" template to this page
- Under *Settings* → *Reading*, set this page as the front page

You can create a homepage with your own content above the "News" list by:
- Creating a single page, e.g. "News Homepage"
- Assigning the "Recent Posts" template to this page
- Setting this page as the front page under *Settings* → *Reading*

### Menus
By default, the theme will display a list of pages and a home link as the main navigation. You can define your own custom menu under *Appearance* → *Menus* in the backend. There are two menu regions available: Primary and Footer. Choose Primary to make your menu items show in top navigation bar.

If you are feeling adventurous and would like to create a site without any menus, you can define an empty menu under *Appearance* → *Menus* and assign it to the two available menu locations. Consequently, this will also make the search link disappear from the header. You can link to your search page from anywhere in the content by linking to: `yoursite.com/?s=`

### Customization
To set up the general appearance details, hit *Customize* under *Appearance* → *Themes* once iA4 is activated. There, you can modify the following:

- Site Identity
    - Set title and tagline
    - Turn display of title and tagline in header on or off
    - Set the site icon
- Header Image
    - Set the image to display in the header (your logo?)
    - Swith to logo only header (no menu!)
- Footer
    - Set a headline and message to display in the footer of every page
    - Center footer menu
- Texts
    - Customize title for News section
    - Customize title for Portfolio
- Menu Locations
    - Set up menus and menu locations (can also be done under *Appearance* → *Menus*)
- Static Front Page
    - Set a static page as the front page, can also be your portfolio (see under "Front Page" above)
    
### Permissions
On some configurations, it might be necessary to set the right permissions for the theme to work correctly. If your menu does not open on mobile or search does not work on desktop, check the permissions of the files in the "js" subdirectory: they should be executable for the web server user.

### Theme Hacking
Here are a few hints in case you want to modify the theme. 

- We use [SASS](http://sass-lang.com/) for the CSS. If you want to modify the stylesheet, do not modify style.css directly, rather set up SASS to compile our SCSS source and work from there. Applying simple changes over the whole site will become a lot easier like this.
