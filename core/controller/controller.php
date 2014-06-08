<?php 
/*
Abstract Class for the Controllers

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/



namespace Controller {


	require_once( __DIR__ . '/../urania.php' );	
	
	
	abstract class Controller {
	
		protected $themeDir = THEME_DIR;
		protected $data = array();
		protected $theme;
		public $pageName;
		public $pageTitle;
		public $urania;
		
		
		
		public function __construct() {
			$this->urania = new \Urania;
		}
	
				
		/**
		Render the template part of the view
		
		@exception theme file does not exist
		*/
		public function template() {
			if(is_array($this->data)) {
				extract($this->data);
			}
			
			if(file_exists($this->themeDir . '/' . $this->theme)) {
				include($this->themeDir . '/' . $this->theme);
			}	
		}
		
		
		/**
		Call GET methode with parameters
		
		@param params
		*/
		public function GET($args) {
			if(is_array($args)) {
				$this->data = $args;
			}
		}
		
		
		/**
		Call GET methode with parameters
		
		@param params
		*/
		public function POST() {
		}
		
	}




}



?>