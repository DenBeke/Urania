Urania
======

￼![Urania Logo](http://denbeke.be/urania/img/logo.png)

Urania is a simple CMS for Photo Albums.  
Urania, makes it really easy to have your own digital portfolio.
Visitors will be welcomed on a home page featuring your albums.
Browsing an album, they will see an overview of the pictures.
The single image view contains detailed information like the exif
information and the geolocation.

The admin can easily control the site configuration.  
Uploading images or creating albums is a matter of seconds!



Installation
============

### Requirements ###

* PHP >= 5.4
* Apache mod_rewrite
* MySQL PDO
* GD Library
* *Urania must have write access to the `upload` and `cache` folder. Your webserver must have write permission for the `core/config.php` file.*


### Install Script ###

Installing Urania can be done using the install script.
Open your webbrowser and go to `yoursite.com/install`.

The install script will guide you through the needed configuration steps.
At first you have to provide the database information.
In the next step you must create an admin user account, and set the title of your photo website.

> Make sure you remember the password, because you can not retrieve/reset it afterwards. You can however always change your admin password (as long as you know your current password).

Additional configuration, like copyright information or analytics code,
can be done in the admin control pannel: `yoursite.com/admin`. 


### Notes ###

* By default PHP has some limits, concerning file upload.
  You can change those limits in the `php.ini` file on your server. In general it can be dangerous to set those limits to high, so it is recommended to upload fewer files at once...
	* `upload_max_filesize` (should be enough for basic image uploading, but could cause problems when adding very large images)
	* `post_max_size` (the maximum total size of all image you are trying to upload)
	* `max_file_uploads` (by default you can add only 20 images at once)
	
* Your admin password is encrypted with a SHA512 hash and a Salt.

* **Remove the `Install` folder after installation!**



Administration
==============

Urania comes with a fully functional admin control panel.
You go to `yoursite.com/admin`, where you can manage the whole website (of course after logging in).

### Albums ###

Creating a new album is very easy.
At the bottom of the albums overview page, you find a *Add Album* panel, where you can create a new album.

Changing an album name, or deleting an album, can be done on the same page.
In the album list you will find a button with a pencil.
Click the button if you want to change the name of, or delete, the album.

If you want, you can also provide an album description.
The album description can be edited at the bottom of the album page, in the *Album Description* panel.
You can use the markdown syntax for the description. (More information about Markdown can be found on Wikipedia)

### Images ###

Uploading images can be done on the albums overview page,
or on the page of a single album.
Again, you will find a panel at the bottom of the page: *Upload Photos*.

Urania will try to display the exif information en geolocation of the given images.
If those information is not found,
Urania will take the current time and only display the title and time of the image.

Deleting or editing images can be done on the single album page.
Again you have to click on the edit button.


### Settings ###


#### Themes ####

Urania comes equipped with a default theme, located in `themes/default`.
You can add themes by uploading them to the `themes` folder (using your favorite FTP client).  
Once uploaded, you can activate the theme in the admin panel, on the *Themes* page.

#### Site Configuration ####

You can configure some general settings of your website.  
On the *Site Configuration* page, you can edit the site title,
site url and the copyright text, displayed in the footer. (The copyright text can be styled using Markdown)

If needed, you can also add your analytics tracking code to your website.
On the same page you have a form where you can save it.


### User Control Panel ###

You can change your password in the (very simple) user control panel.



Todo's for the next version
=========================

* Make it possible to add a caption to images
* Image  tags and/or categories
* API (using JSON objects) which makes it possible to use CMS content on other systems (i.e. have a photostream with the latest uploads, or a list with albums)
* Make it possible to sort images
* (possibility to have multiple image uploaders / users)



Acknowledgements
================

* [Pixie](https://github.com/usmanhalalit/pixie) by Muhammad Usman
* [PHP Markdown Lib](https://github.com/michelf/php-markdown) by Michel Fortin
* [TimThumb](http://www.binarymoon.co.uk/projects/timthumb/) by Ben Gillbanks and Mark Maunder
* [GluePHP](http://gluephp.com) by Joe Topjian
* [GLYPHICONS](http://glyphicons.com) by Jan Kovařík
* [Leaflet](http://leafletjs.com) by Vladimir Agafonkin and CloudMade
* [Pure](http://purecss.io) by Yahoo! Inc.
* [jQuery](http://jquery.com)
* [OpenStreetMap](http://openstreetmap.org)



Author
======

Mathias Beke - [denbeke.be](http://denbeke.be)