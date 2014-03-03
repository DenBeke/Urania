<?php
/*
Class containing an image

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/



/**
@brief Class containing a notification

The class contains the following information:
- message
- type
*/
class Notification {
    
    public $message;
    public $type;
    
    
    /**
    Constructor
    
    @param message
    @param type
    */
    public function __construct($message, $type) {
		$this->message = $message;
		$this->type = $type;
    }
    
    
    /**
    String function
    
    @return string
    */
    public function __toString() {
        return $this->message;
    }
}


?>