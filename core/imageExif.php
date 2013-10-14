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
        
        if(func_num_args() != 1 and func_num_args() != 5) {
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
    Read the exif data from a file.
    When no file given, the data will be read from the image file
    
    @param input file
    @return bool true (exif read) / false (no exif read)
    
    @pre file exists
    @post exif data will be added to the image
    */
    public function readExifFromFile($fileName = NULL) {
    	if ($fileName == NULL) {
    		//If no filename given, we read exif date from the image file
    		$fileName = $this->getFileName();
    	}
    	if(!file_exists($fileName)) {
    		throw new exception('The given file does not exist');
    	}
    	else {
    		//TODO read exif data and clean it up
    		//TODO Check for each individual exif info if it can be read
    		//If it couldn't read the efix date, the NULL will be assigned to the values
    		try {
    			if(function_exists("exif_read_data") && exif_read_data($fileName)){ 
    				
    				$exif = exif_read_data($fileName);
    				
					//Get the camera
					$this->camera = $exif['Model'];
					
					//Get the aperture
					$this->aperture = $exif['FNumber'];
					
					//Get the shutter speed
					$this->shutterSpeed = $exif['ExposureTime'];
					
					//Get the ISO value
					$this->iso = $exif['ISOSpeedRatings'];
					
					//Get the focal length
					$this->focalLength = $exif['FocalLength'];
					
					//TODO GPS
					$GPSLatitude = $exif['GPSLatitude'];
					$GPSLongitude = $exif['GPSLongitude'];
					
					$this->gpsLatitude = ImageExif::toDecimal($GPSLatitude[0], $GPSLatitude[1], $GPSLatitude[2], $exif['GPSlatitudeRef']);
					$this->gpsLongitude = ImageExif::toDecimal($GPSLongitude[0], $GPSLongitude[1], $GPSLongitude[2], $exif['GPSLongitudeRef']);
					
					return true;
    			}
    			else {
    				echo "Couldn't read exif";
    			}
    		}
    		catch (exception $exception) {
    			//Set NULL and return false
    			//TODO
    			return false;
    		}
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
 
 


    public function __toString() {
        $output = parent::__toString();
        $output = $output . '<ul>';
        $output = $output . "<li>Camera: $this->camera</li>";
        $output = $output . "<li>Aperture: $this->aperture</li>";
        $output = $output . "<li>Shutterspeed: $this->shutterSpeed</li>";
        $output = $output . "<li>ISO: $this->iso</li>";
        $output = $output . "<li>Focallength: $this->focalLength</li>";
        $output = $output . "<li>GPS Longitude: $this->gpsLongitude</li>";
        $output = $output . "<li>GPS Latitude: $this->gpsLatitude</li>";
        $output = $output . '</ul>';
        return $output;
    }
    
    
    static private function toDecimal($deg, $min, $sec, $hem) {
        
        //Get degrees
        $deg = explode('/', $deg);
        $deg = intval($deg[0])/intval($deg[1]);
        
        //Get minutes
        $min = explode('/', $min);
        $min = intval($min[0])/intval($min[1]);
        
        //Get seconds
        $sec = explode('/', $sec);
        $sec = intval($sec[0])/intval($sec[1]);
        
        //Calculate decimal coordinate
        $dec = $deg + ((($min*60) + ($sec))/3600);
        
        //Check if we don't need to take inverse
        if ($hem=='S' || $hem=='W') {
            return $dec * -1;
        }
        else {
            return $dec;
        }
    }
    
    
} 



?>