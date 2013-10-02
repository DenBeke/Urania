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

Created by Mathias Beke - denbeke.be