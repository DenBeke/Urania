<?php 
/*
Class containing an image with EXIF information

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/


/**
@brief Class containing an image and it's EXIF information

The class contains the following information from the standard image:
- id
- file name
- name
- date
- album id

And the following information for the EXIF date:
- aperture
- shutterspeed
- iso
- gps coordinates
- focal length
- camera model
- lens
*/
class imageExif extends image { 

	
	/**
	Constructor
	
	@param id
	@param file name
	@param name
	@param date
	@param album id
	*/
    public function __construct($id, $fileName, $name, $date, $albumId) { 
        parent::__construct($id, $fileName, $name, $date, $albumId); 
    } 
 
} 



?>