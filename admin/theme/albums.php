<?php
/*
Theme part for admin home page with list of albums

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

<h3 class="nav"><a href="<?php echo SITE_URL; ?>admin/">Albums</a></h3>
<table>

	<tbody>
	
	
		<tr>
		
			<th>
			Album
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
		
		foreach ($this->albums as $album) {
			$id = $album->getId();
			//echo "<a href=\"index.php?page=admin&album=$id\">$album</a>";
			?>
			<tr>
				<td>
					<a href="<?php echo SITE_URL; ?>admin/album/<?php echo $id; ?>"><?php echo $album->getName(); ?></a>
				</td>
				<td class="date">
					<?php echo date('d-m-Y', $album->getDate()); ?>
				</td>
				<td>
					<form method="post" action="<?php echo SITE_URL; ?>admin/">
						<input type="hidden" name="deleteAlbum" value="<?php echo $id; ?>">
						<input type="submit" value="Delete">
					</form>
				</td>
				<td>
					<form method="post" action="<?php echo SITE_URL; ?>admin/">
						<input type="hidden" name="changeAlbumId" value="<?php echo $album->getId(); ?>">
						<input type="text" name="changeName" value="" / required>
						<input type="submit" value="Change name">
					</form>
				</td>
			</tr>
			<?php

		}
		?>
	
	
	</tbody>


</table>


<form id="addAlbum" name="input" action="<?php echo SITE_URL; ?>admin/" method="post">
	<p>Add Album
	</p>
	<p>
		<input type="text" name="albumName" required>
	</p>
	<p class="submitButton">
		<input type="submit" value="Add">
	</p>
</form>


<form id="uploadImages" enctype="multipart/form-data" name="upload" action="<?php echo SITE_URL; ?>admin/" method="post">
	<p>
		Upload Photos
	</p>
	<p>
		<input type="file" name="file[]" multiple required>
	</p>
	<p>
	<select name="albumId">
	
	<?php
	
	foreach ($this->albums as $album) {
		$id = $album->getId();
		$name = $album->getName();
		//echo "<a href=\"index.php?page=admin&album=$id\">$album</a>";
		echo "<option value=\"$id\">$name</option>";
	}
	?>
	</select>
	</p>
	<p class="submitButton">
		<input type="submit" value="Upload">
	</p>
</form>