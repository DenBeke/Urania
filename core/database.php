<?php
/*
PHP Database Interface for MySQL

Author: Mathias Beke
Url: http://denbeke.be
Date: August 2013
*/


require(dirname(__FILE__).'/cache.php');


/**
@brief Interface for MySQL Database, with cache

This class makes it easy to cache the results of MySQL queries.
The interface object is constructed and afterwards you can perform queries with the method 'query'
*/
class Database {
    
    private $db_host;
    private $db_user;
    private $db_password;
    private $db_database;
    private $link;
    private $cache;
    
    
    /**
    Constructor
    
    @param host
    @param user
    @param password
    @param database
    @param cache folder
    */
    public function __construct($db_host, $db_user, $db_password, $db_database, $cache) {
        
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
        $this->db_database = $db_database;
        $this->cache = new Cache($cache);
        
        $this->connect();
        
    }
    
    
    public function __destruct() {
    	
    	$this->disconnect();
    	
    }
    
    
    /**
    Escape characters against MySQL injection
    
    @param string
    @return escaped string
    */
    public function escape($string) {
        $out = $this->link->real_escape_string($string);
        return $out;
    }
    
    
    /**
    Execute query in the database that gets content from the database
    Special cases for the cache expiration:
    - 0: always read from cache
    - -1: never read from cache
    
    @param query
    @param cache expiration
    
    @return result
    */
    public function getQuery($query, $cache_expire = -1) {
        
        $result = array();
        
        //If cache not expired, construct array from cache
        if ($this->cache->cacheExists($query) and $this->cache->isNotExpired($query, $cache_expire)) {
            
            $result = unserialize($this->cache->readCache($query));
        
        }
        
        //Else fetch array from database and write array to the cache
        else {
            
            $mysqlResult = $this->link->query($query);
            
            
            if(!$mysqlResult) {
            	throw new Exception('MySQL Error: ' . $this->link->error);
            }
            
            while($row = $mysqlResult->fetch_assoc()){
                 $result[] = $row;
            }
               
            $this->cache->writeCache($query, serialize($result));
        }
        
        return $result;

    }
    
    
    
    /**
    Execute query in the database that changes content in the database

    @param query
    @return result
    */
    public function doQuery($query) {
        
        $this->link->query($query);
        $affectedRows = $this->link->affected_rows;
        
		if($affectedRows == -1) {
			throw new Exception('MySQL Error: ' . $this->link->error);
		}        
        return $affectedRows;
        
    }
    
    
    private function connect() {
        
        //Connect
        $this->link = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_database);
        
        // check connection
        if (mysqli_connect_errno()) {
            $error = mysqli_connect_error();
            throw new Exception("Connect failed: $error");
        }
        
    }
    
    private function disconnect() {
        
        $this->link->close();
    
    }
    
}


?>