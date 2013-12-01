Urania

Urania is a CMS for photo albums.
- The admin can create albums and upload images.
- The visitors of the site will see albums and images

Installation
- In order to install/configure Uranian, create a new database
- Add two tables to this database
    x Table for images, with 5 fields
        o id(int)(AutoIncrement)
        o fileName(text)
        o name(text)
        o date(int)
        o albumId(int)
    x Table for albums, with 3 fields
        o id(int)(AutoIncrement)
        o name(text)
        o date(int)
- Change the database config, table names, and other site info in the './core/config.php' file.
- Start creating albums!!!

Notes
- By default PHP has some limits
  You can change those limits in the php.ini on your server.
	x upload_max_filesize (should be enough for basic image uploading, but could cause problems when adding very large images)
	x post_max_size (the maximum total size of all image you are trying to upload)
	x max_file_uploads (by default you can add only 20 images at once)
- Your admin password is stored in plain text, make sure this password is unique and can not cause problems for other (more important) services

TODO for the next version
- Add the possibility to show the exif info of an image in the lightbox
- Make single view for an image
- Add map for displaying the location of the image
- Make it possible to add a caption to certain images
- Better user authentication (possibility to have multiple image uploaders)
- Separate admin part from the index.php
- Make it possible to sort images
(- store config information in the database)
(- make an install script)

Created by Mathias Beke - denbeke.be