<?php

if (isset($_POST['deleteImage'])) {
	echo "<b>Deleting image width id " . $_POST['deleteImage'] . '</b>';
	$u->deleteImage(intval($_POST['deleteImage']));
}


$albumId = intval($_GET['album']);
$album = $u->getAlbum($albumId);

?>

<table>

	<tbody>
	
		<?php
		
		for ($i = 0; $i < $album->getNumberOfImages(); $i++) {
			
			?>
			
			<tr>
				<td>
					<?php echo $album->getImage($i)->getName(); ?>
				</td>
				
				<td>
					<?php echo date('d-m-Y',$album->getImage($i)->getDate()); ?>
				</td>
				
				<td>
					<form method="post" action="index.php?page=admin&album=<?php echo $album->getId(); ?>">
						<input type="hidden" name="deleteImage" value="<?php echo $album->getImage($i)->getId(); ?>">
						<input type="submit" value="Delete">
					</form>
				</td>
				
			</tr>
			
			<?php
			
		}
		
		?>
	
	
	</tbody>

</table>


