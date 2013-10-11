<?php
/*
PHP Cache

Author: Mathias Beke
Url: http://denbeke.be
Date: June 2013
*/


/**
@brief Class for Caching data

This class caches data in a folder. You can check if a cache is still valid, read a cache and write to a cache.

Don't forget to disallow all acces of the cache folder with .htaccess, when caching important data.
*/
class Cache {

    
    private $directory;
    private $defaultTime = 500;
    private $extension = '.cache';
    
    
    /**
    Constructor
    
    @param cache directory
    */
    public function __construct($directory = './cache/') {
        $this->directory = $directory;
    }
    
    
    /**
    Check if the cache of the given query has already expired
    
    @param query
    @param time after expired
    @return bool expired
    */
    public function isNotExpired($query, $time = NULL) {
        if ( is_null($time) ) {
                $time = $this->defaultTime;
        }
        elseif ($time == 0) {
            return true;
        }
        elseif ($time == -1) {
            return false;
        }
        $fileName = $this->directory . $this->encrypt($query) . $this->extension;
        $modified = filemtime($fileName);
        $now = time();
        if(($now - $modified)  <= $time) {
            return true;
        }
        else {
            return false;
        }
    }
      
    
    /**
    Check if there is a cached file for the given query
    
    @param query
    @return bool
    */
    public function cacheExists($query) {
        $fileName = $this->directory.$this->encrypt($query) . $this->extension;
        return file_exists($fileName);
    }
    
    
    /**
    Read the cache file of the given query
    
    @param query
    @return string containing file content
    */
    public function readCache($query) {
        $fileName = $this->directory.$this->encrypt($query) . $this->extension;
        if(!file_exists($fileName)) {
            throw new exception("File does not exists");
        }
        else {
            return file_get_contents($fileName);
        }
    }
    
    
    /**
    Write the result of the query to a cache file
    
    @param query
    @param result
    */
    public function writeCache($query, $result) {
        $fileName = $this->directory.$this->encrypt($query) . $this->extension;
        file_put_contents($fileName, $result);
    }


    /**
    Encrypt string with md5
    
    @param string
    @return encrypted string
    */
    private function encrypt($string) {
        return md5($string);
    }

}

?>