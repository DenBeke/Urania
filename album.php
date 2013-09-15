<?php 
/*
Class containing an album

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/


require_once(dirname(__FILE__).'/image.php');


/**
@brief Class containing an album

The class contains the following information:
- id
- name
- date
- images
*/
class Album {
    
    private $id;
    private $name;
    private $images = array();
    private $date;
    
    
    /**
    Constructor
    
    @param id
    @param name
    @param date
    */
    public function __construct($id, $name, $date) {
        $this->id = $id;
        $this->name = $name;
        $this->date = $date;
    }
    
    
    /**
    Add an image to the album
    
    @param Image
    
    @pre image not already in album
    @post image is added to the album
    */
    public function addImage($image) {
        //Check if image is unique
        foreach ($this->images as $i) {
            if($image->getId() == $i->getId()) {
                throw new Exception("There is already an image with id $i->getId() in the album");
            }
            else {
                continue;
            }
        }
        //Add image to the album
        $this->images[] = $image;
    }
    
    
    /**
    Get all images from the album
    
    @return images
    */
    public function getAllImages() {
        return $this->images;
    }
    
    
    /**
    Get the number of images in the album
    
    @return number of images
    */
    public function getNumberOfImages() {
        return sizeof($this->images);
    }
    
    
    /**
    Get the image on the given index
    
    @param index
    @param image
    
    @pre index < number of items
    */
    public function getImage($index) {
        if(!($index < $this->getNumberOfImages())) {
            throw new Exception("Image index $index out of range");
        }
        else {
            return $this->images[$index];
        }
    }
    
    
    /**
    Get the id of the album
    
    @return id
    */
    public function getId() {
        return $this->id;
    }
    
    
    /**
    Get the name of the album
    
    @return name
    */
    public function getName() {
        return $this->name;
    }
    
    
    /**
    Get the date of the album
    
    @return date
    */
    public function getDate() {
        return $this->date;
    }
    
    
    /**
    String function
    
    @return string
    */
    public function __toString() {
        $output = '<ol>';
        foreach ($this->images as $image) {
            $output = $output . "<li>$image</li>";
        }
        $output = $output . '</ol>';
        return $output;
    }
    
}



?>