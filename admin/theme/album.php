<?php
/*
Theme part for admin single album

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2013
*/
?>


<?php

if($this->notification != NULL) {
?>
<div class="notification <?php echo $this->notification->type ?>">
	<?php echo $this->notification->message; ?>
</div>
<?php
}
?>


<h2 id="admin-album-title"><?php echo $this->album->getName(); ?></h2>


<table id="admin-album" class="table table-striped">

	<tbody>
	
	
		<tr>
		
			<th>
	
			</th>
			
			<th>
				Photo
			</th>
			
			<th>
				Date
			</th>
			
			<th>
			
			</th>
		
			<th>
			
			</th>
		
		</tr>
	
		<?php
		
		$imageHeight = 100;
		$imageWidth = 100;
		
		for ($i = 0; $i < $this->album->getNumberOfImages(); $i++) {
			
			?>
			
			<tr>
				<td>
					<img src="<?php echo SITE_URL; ?>core/timthumb.php?src=<?php echo $this->album->getImage($i)->getFileName() . "&h=$imageHeight&w=$imageWidth"; ?>" alt="<?php echo $this->album->getImage($i)->getName(); ?>" />
				</td>
				<td>
					<?php 
					echo $this->album->getImage($i)->getName(); 
					$image = new imageExif($this->album->getImage($i));
					$image->readExifFromFile();
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
								<?php echo $image->getIso(); ?>
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
					</div>
				</td>
				
				<td class="date">
					<?php echo date('d-m-Y',$this->album->getImage($i)->getDate()); ?>
				</td>
				
				<td>
					<form method="post" action="<?php echo SITE_URL; ?>admin/album/<?php echo $this->album->getId(); ?>" class="pure-form">
						<input type="hidden" name="changeImage" value="<?php echo $this->album->getImage($i)->getId(); ?>">
						<input type="text" name="changeName" value=""/>
						<input class="pure-button pure-button-primary" type="submit" value="Change name">
					</form>
				</td>
				
				<td>
					<form method="post" action="<?php echo SITE_URL; ?>admin/album/<?php echo $this->album->getId(); ?>" class="pure-form">
						<input type="hidden" name="deleteImage" value="<?php echo $this->album->getImage($i)->getId(); ?>">
						<input class="pure-button pure-button-primary" type="submit" value="Delete">
					</form>
				</td>
				
			</tr>
			
			<?php
			
		}
		
		?>
	
	
	</tbody>

</table>





<form id="uploadImages" enctype="multipart/form-data" name="upload" action="<?php echo SITE_URL; ?>admin/album/<?php echo $this->album->getId(); ?>" method="post">
	<p>
		Upload Photos
	</p>
	<p>
		<input type="file" name="file[]" multiple required>

		<input type="hidden" name="albumId" value="<?php echo $this->album->getId(); ?>">
	</p>
	<p class="submitButton">
		<input type="submit" value="Upload">
	</p>
</form>
