<?php
/*
Class containing an image

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/



/**
@brief Class containing an image

The class contains the following information:
- id
- file name
- name
- date
- album id
*/
class Image {
    
    private $id;
    private $fileName;
    private $name;
    private $date;
    private $albumId;
    
    
    /**
    Constructor
    
    @param id
    @param file name
    @param name
    @param date
    @param album id
    */
    public function __construct($id, $fileName, $name, $date, $albumId) {
        $this->id = $id;
        $this->fileName = $fileName;
        $this->name = $name;
        $this->date = $date;
        $this->albumId = $albumId;
    }
    
    
    /**
    Get the id of the image
    
    @return id
    */
    public function getId() {
        return $this->id;
    }
    
    
    /**
    Get the file name of the image
    
    @return file name
    */
    public function getFileName() {
        return $this->fileName;
    }
    
    
    /**
    Get the name of the image
    
    @return name
    */
    public function getName() {
        return $this->name;
    }
    
    
    /**
    Get the date of the image
    
    @return date
    */
    public function getDate() {
        return $this->date;
    }
    
    
    /**
    Get the album id of the image
    
    @return album id
    */
    public function getAlbumId() {
        return $this->albumId;
    }
    
    
    /**
    String function
    
    @return string
    */
    public function __toString() {
        $output = "";
        $output = $output . "<h2>$this->name</h2>";
        $output = $output . "<p>$this->fileName</p>";
        return $output;
    }
}


?>