<?php 
/*
Class containing an image with EXIF information

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/


require_once(dirname(__FILE__).'/image.php');

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

	@param basic image
	
	@pre number of arguments is 1 or 5
	@pre if number only one argument given, argument is basic image
	*/
    public function __construct($idOrBasicImage, $fileName = NULL, $name = NULL, $date = NULL, $albumId = NULL) { 
        
        if(func_num_args() != 1 or func_num_args() != 5) {
        	throw new exception('Number of arguments must be 1 or 5');
        }
        if(func_num_args() == 1) {
        	if(get_class($idOrBasicImage) != 'Image') {
        		throw new exception('When only one argument given, the argument must be of type Image');
        	}
        	//Construct basic image from given image
        	parent::__construct($idOrBasicImage->getId(), $idOrBasicImage->getFileName(), $idOrBasicImage->getName(), $idOrBasicImage->getDate(), $idOrBasicImage->getAlbumId());
        }
        else {
        	//Construct basic images from params
        	parent::__construct($idOrBasicImage, $fileName, $name, $date, $albumId);
        }
         
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