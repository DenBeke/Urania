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

	
	private $aperture;
	private $shutterSpeed;
	private $iso;
	private $gpsLongitude;
	private $gpsLatitude;
	private $focalLength;
	private $camera;
	private $lens;
	
	
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
    
    
    /**
    Get the aperture of the image
    
    @return aperture
    */
    public function getAperture() {
    	return $this->aperture;
    }
    
    
    /**
    Get the shutterspeed of the shutter speed of the image
    
    @return shutter speed
    */
    public function getShutterSpeed() {
    	return $this->shutterSpeed;
    }
    
    
    /**
    Get the iso value of the image
    
    @return iso
    */
    public function getIso() {
    	return $this->iso;
    }
    
    
    /**
    Get the GPS longitude
    
    @return longitude
    */
    public function getGpsLongitude() {
    	return $this->gpsLongitude;
    }
    
    
    /**
    Get the GPS latitude
    
    @return latitude
    */
    public function getGpsLatitude() {
    	return $this->gpsLatitude;
    }
    
    
    /**
    Get the focal length of the image
    
    @return focal length
    */
    public function getFocalLength() {
    	return $this->focalLength;
    }
    
    
    /**
    Get the camera model of the image
    
    @return camera
    */
    public function getCamera() {
    	return $this->camera;
    }
    
    
    /**
    Get the lens of the camera
    
    @return lens
    */
    public function getLens() {
    	return $this->lens;
    }
 
} 



?>