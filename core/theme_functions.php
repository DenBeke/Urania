<?php
/*
Theme functions

Author: Mathias Beke
Url: http://denbeke.be
Date: July 2014
*/

/**
Theme functions

This functions are used to generate theme parts
(or to get information needed in a theme)
*/
class Theme {
	
	/**
	Output the upper nav for the given controller
	
		e.g.
		Admin > Album > My Pictures
	
	*/
	static public function nav(& $controller) {
		
		$type = explode( '\\', get_class($controller) );
		$nav = [];
		
		if(isset($type[1])) {
			
			if($type[1] == 'Admin') {
				$nav[] = [
					'name' => 'Admin',
					'url' => SITE_URL . 'admin'
				];
				
			}
			
			
			if(isset($type[2])) {
				
				if($type[2] == 'Album') {
					
					$nav[] = [
						'name' => 'Albums',
						'url' => SITE_URL . 'admin/albums'
					];
					
					$nav[] = [
						'name' => $controller->album->getName(),
						'url' => ''
					];
					
					
				}
				else {
					
					$nav[] = [
						'name' => $type[2],
						'url' => ''
					];
					
				}
				
			}
			
		}
		
		?>
		<ol class="level-nav" style="margin-bottom: 5px;">
		<?php
		foreach ($nav as $item) {
			
			?>
			<li <?php if($item['url'] == '') { echo 'class="active"'; } ?>>
				<?php if($item['url'] != ''): ?>
				<a href="<?php echo $item['url']; ?>">
					<?php echo $item['name']; ?>
				</a>
				<?php else: ?>
					<?php echo $item['name']; ?>
				<?php endif; ?>
			</li>
			<?php
			
		}
		?>
		</ol>
		<?php
		
	}
	
	
	
	static public function exif(& $image) {
		
		if(get_class($image) != 'Model\imageExif') {
			
			$image = new \Model\imageExif($image);
			$image->readExifFromFile();
			
		}
		
		
		?>
		
		<div id="exif">
			<ul>
				<?php 
				if($image->getCamera() != NULL) {
				?>
				<li>
					<?php echo $image->getCamera(); ?>
				</li>
				<?php 
				}
				
				if($image->getIso() != NULL) {
				?>
				<li>
					ISO <?php echo $image->getIso(); ?>
				</li>
				
				<?php 
				}
				
				if($image->getAperture() != NULL) {
				?>
				<li>
					&fnof;/<?php echo $image->getAperture(); ?>
				</li>
				<?php
				}
				
				if($image->getShutterSpeed() != NULL) {
				?>
				<li>
					<?php echo $image->getShutterSpeed(); ?>"
				</li>
				
				<?php 
				}
				
				if($image->getFocalLength() != NULL) {
				?>
				<li>
					<?php echo $image->getFocalLength(); ?>
				</li>
				<?php } ?>
			</ul>
		</div><!-- #exif -->
		
		<?php
		
	}
	
	
}


?>