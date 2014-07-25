Urania
======

￼![Urania Logo](http://denbeke.be/urania/img/logo.png)

Urania is a CMS for photo albums.

* The admin can create albums and upload images.
* The visitors of the site will see albums and images

Installation
============

*Create all tables in `install/install.php`.*  
*Install script will be updated.*


Notes
=====

* By default PHP has some limits.
  You can change those limits in the `php.ini` on your server.
	* `upload_max_filesize` (should be enough for basic image uploading, but could cause problems when adding very large images)
	* `post_max_size` (the maximum total size of all image you are trying to upload)
	* `max_file_uploads` (by default you can add only 20 images at once)
* Your admin password is stored in plain text, make sure this password is unique and can not cause problems for other (more important) services


TODO for the next version
=========================

* Make it possible to add a caption to certain images
* Image  tags
* Add an API (using JSON objects) which makes it possible to use CMS content on other systems (i.e. have a photostream with the latest uploads, or a list with albums)
* Make it possible to sort images
* (make an install script)
* (possibility to have multiple image uploaders)

Acknowledgements
================

* [Pixie](https://github.com/usmanhalalit/pixie) by Muhammad Usman
* [PHP Markdown Lib](https://github.com/michelf/php-markdown) by Michel Fortin
* [TimThumb](http://www.binarymoon.co.uk/projects/timthumb/) by Ben Gillbanks and Mark Maunder
* [GluePHP](http://gluephp.com) by Joe Topjian
* [GLYPHICONS](http://glyphicons.com) by Jan Kovařík
* [Pure](http://purecss.io) by Yahoo! Inc.
* [jQuery](http://jquery.com)


*Created by Mathias Beke - [denbeke.be](http://denbeke.be)*