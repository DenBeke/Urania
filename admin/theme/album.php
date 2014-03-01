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

<h3 class="nav"><a href="<?php echo SITE_URL; ?>admin">Albums</a> &gt; <a href="<?php echo SITE_URL; ?>admin/album/<?php echo $this->album->getId(); ?>"><?php echo $this->album->getName(); ?></a></h3>

<table id="adminAlbum">

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
		
		$imageHeight = 75;
		$imageWidth = 75;
		
		for ($i = 0; $i < $this->album->getNumberOfImages(); $i++) {
			
			?>
			
			<tr>
				<td>
					<img src="<?php echo SITE_URL; ?>core/timthumb.php?src=<?php echo $this->album->getImage($i)->getFileName() . "&h=$imageHeight&w=$imageWidth"; ?>" alt="<?php echo $this->album->getImage($i)->getName(); ?>" />
				</td>
				<td>
					<?php echo $this->album->getImage($i)->getName(); ?>
				</td>
				
				<td class="date">
					<?php echo date('d-m-Y',$this->album->getImage($i)->getDate()); ?>
				</td>
				
				<td>
					<form method="post" action="<?php echo SITE_URL; ?>admin/album/<?php echo $this->album->getId(); ?>">
						<input type="hidden" name="deleteImage" value="<?php echo $this->album->getImage($i)->getId(); ?>">
						<input type="submit" value="Delete">
					</form>
				</td>
				
				<td>
					<form method="post" action="<?php echo SITE_URL; ?>admin/album/<?php echo $this->album->getId(); ?>">
						<input type="hidden" name="changeImage" value="<?php echo $this->album->getImage($i)->getId(); ?>">
						<input type="text" name="changeName" value="" required/>
						<input type="submit" value="Change name">
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
