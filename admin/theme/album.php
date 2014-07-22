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
	<span class="glyphicon <?php if($this->notification->type == 'success') { echo 'glyphicon-ok'; } else { echo 'glyphicon-warning-sign'; } ?>"></span> <?php echo $this->notification->message; ?>
</div>
<?php
}
?>


<h2 id="admin-album-title"><?php echo $this->album->getName(); ?></h2>


<div class="album-description">
	<?php
	if($this->album->getDescription() == '') {
		?>
		<span class="empty-description">No description</span>
		<?php
	}
	else {
		echo markdown_convert($this->album->getDescription());
	}
	?>
	<a href="#change-album-description" class="pure-button pure-button-primary edit-button"><span class="glyphicon glyphicon-pencil"></span></a>
	<p></p>
</div>


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
					<a href="<?php echo SITE_URL . $this->album->getImage($i)->getFileName(); ?>" class="lightbox">
						<img src="<?php echo SITE_URL; ?>core/timthumb.php?src=<?php echo $this->album->getImage($i)->getFileName() . "&h=$imageHeight&w=$imageWidth"; ?>" alt="<?php echo $this->album->getImage($i)->getName(); ?>" />
					</a>
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
				</td>
				
				<td class="date">
					<?php echo date('d-m-Y',$this->album->getImage($i)->getDate()); ?>
				</td>
				
				<!--
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
				-->
				
				
				<td>
					<a class="pure-button pure-button-primary edit-button"><span class="glyphicon glyphicon-pencil"></span></a>
					
					<div class="edit-box">
						<form method="post" action="<?php echo SITE_URL; ?>admin/album/<?php echo $this->album->getId(); ?>" class="pure-form">
							<input type="hidden" name="changeImage" value="<?php echo $this->album->getImage($i)->getId(); ?>">
							
							<input type="text" name="changeName" value="" placeholder="New image name" class="pure-u-1" />
							
							
							<div class="button-container left">
								<input class="pure-button pure-button-primary" type="submit" value="Change name">
							</div>
							
							
						</form>
						
						<form method="post" action="<?php echo SITE_URL; ?>admin/album/<?php echo $this->album->getId(); ?>" class="pure-form">
							<input type="hidden" name="deleteImage" value="<?php echo $this->album->getImage($i)->getId(); ?>">
							
							<div class="button-container right">
								<input class="pure-button pure-button-warning" type="submit" value="Delete">
							</div>
							
							
						</form>
						
					</div><!-- .edit-box -->
					
				</td>
				
				
				<td>
					<a href="<?php echo SITE_URL . $this->album->getImage($i)->getFileName(); ?>" download="<?php echo $this->album->getImage($i)->getName(); ?>" class="pure-button pure-button-primary"><span class="glyphicon glyphicon-save"></span></a>
				</td>
				
			</tr>
			
			<?php
			
		}
		
		?>
	
	
	</tbody>

</table><!-- #admin-album -->



<div class="pure-g">
	
	
	<div class="pure-u-1-3 album-upload-photos-container">
	
		<div class="panel">
	
	
			<div class="panel-header">
				<h3 class="panel-title"><span class="glyphicon glyphicon-open"></span> Upload Photos</h3>
			</div>
	
	
			<div class="panel-body">
	
				<form id="uploadImages" enctype="multipart/form-data" name="upload" action="<?php echo SITE_URL; ?>admin/album/<?php echo $this->album->getId(); ?>" method="post" class="pure-form pure-form-stacked">
	
					<p>
						<input class="pure-input pure-u-1" type="file" name="file[]" multiple required>
					</p>
	
					<input type="hidden" name="albumId" value="<?php echo $this->album->getId(); ?>">
	
	
					<input class="pure-input pure-button pure-button-primary" type="submit" value="Upload">
					<!-- <button class="pure-input pure-button pure-button-primary pure-u-1" type="submit">
						Upload
					</button>-->
	
				</form>
	
			</div>
	
	
		</div><!-- .panel -->
	
	</div>
	
	
	
	
	<div class="pure-u-2-3 album-description-edit-container">
	
		<div class="panel">
	
	
			<div class="panel-header">
				<h3 class="panel-title"><span class="glyphicon glyphicon-align-center"></span> Album Description</h3>
			</div>
	
	
			<div class="panel-body">
	
				<form id="change-album-description" name="change-description" action="<?php echo SITE_URL; ?>admin/album/<?php echo $this->album->getId(); ?>/edit-description" method="post" class="pure-form pure-form-stacked">
	
					<textarea name="description"><?php echo $this->album->getDescription(); ?></textarea>
	
					<input class="pure-input pure-button pure-button-primary" type="submit" value="Update">
					<!-- <button class="pure-input pure-button pure-button-primary pure-u-1" type="submit">
						Upload
					</button>-->
	
				</form>
	
			</div>
	
	
		</div><!-- .panel -->
	
	</div>
	
	
</div><!-- .pure-g -->







<?php include(dirname(__FILE__) . '/lightbox.php'); ?>
