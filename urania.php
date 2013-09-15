<?php 
/*
Simple CMS for image galleries

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/


require_once(dirname(__FILE__).'/album.php');
require_once(dirname(__FILE__).'/image.php');
require_once(dirname(__FILE__).'/database.php');


class Urania {
    
    private $debug = true;
    private $database;
    private $db_table_albums;
    private $db_table_images;
    
    /**
    Constructor
    
    @param path to config file
    */
    public function __construct($config = "./config.php") {
        require($config);
        $this->db_table_albums = $db_table_albums;
        $this->db_table_images = $db_table_images;
        $this->database = new Database($db_host, $db_user, $db_password, $db_database);
    }
    
    
    
    /**
    Add the given image to the database
    
    @param image
    @pre image not already in the database
    */
    public function addImage($image) {
    }
    
    
    /**
    Get a list of all albums
    
    @return albums (without images included)
    */
    public function getAllAlbums() {
        
    }
    
    
    
    /**
    Get the album with the given id
    
    @param id
    @return album
    
    @pre id exists
    */
    public function getAlbum($id) {
        if(!$this->albumExists($id)) {
            throw new Exception("There is no album with the id $id");
        }
        else {
            
        }
    }
    
    
    /**
    Get the image with the given id
    
    @param id
    @return image
    
    @pre image exists
    */
    public function getImage($id) {
        if(!$this->imageExists($id)) {
            throw new Exception("There is no image with the id $id");
        }
        else {
            
        }
    }
    
    
    
    /**
    Delete the image with the given id
    
    @param id   
    @pre image exists
    */
    public function deleteImage($id) {
        if(!$this->imageExists($id)) {
            throw new Exception("There is no image with the id $id");
        }
        else {
            
        }
    }
    
    
    
    /**
    Delete the album with the given id
    
    @param id   
    @pre album exists
    */
    public function deleteAlbum($id) {
        if(!$this->albumExists($id)) {
            throw new Exception("There is no album with the id $id");
        }
        else {
            
        }
    }
    
    
    
    private function albumExists($id) {
        
        //Create query
        $albums = $this->database->escape($this->db_table_albums);
        $id = $this->database->escape($id);
        
        $query = 
        "
        SELECT * 
        FROM  `$albums` 
        WHERE  `id` = $id
        LIMIT 0 , 30
        ";
    
        //DEBUG
        if($this->debug) {
            echo $query;
        }
        
        //Fetch query
        $result = $this->database->query($query);
        
        //Check if there is a result (album)
        if(sizeof($result) > 0) {
            return true;
        }
        else {
            return false;
        }
        
    }
    
    
    private function imageExists($id) {
        
        //Create query
        $images = $this->database->escape($this->db_table_images);
        $id = $this->database->escape($id);
        
        $query = 
        "
        SELECT * 
        FROM  `$images` 
        WHERE  `id` = $id
        LIMIT 0 , 30
        ";
        
        //DEBUG
        if($this->debug) {
            echo $query;
        }
        
        //Fetch query
        $result = $this->database->query($query);
        
        //Check if there is a result (album)
        if(sizeof($result) > 0) {
            return true;
        }
        else {
            return false;
        }
        
    }
}



?>