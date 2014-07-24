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
	<span class="glyphicon <?php if($this->notification->type == 'success') { echo 'glyphicon-ok'; } else { echo 'glyphicon-warning-sign'; } ?>"></span> <?php echo $this->notification->message; ?>
</div>
<?php
}
?>


<h2 id="admin-albums-title">Albums</h2>


<table id="admin-albums" class="table table-striped">

	<tbody>
	
		<tr>
		
			<th></th>
		
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
		
		$imageHeight = 100;
		$imageWidth = 100;
		
		$imageHeightSmall = 60;
		$imageWidthSmall = 60;
		$limit = 4;
		
		foreach ($this->albums as $album) {
			$id = $album->getId();
			//echo "<a href=\"index.php?page=admin&album=$id\">$album</a>";
			?>
			<tr>
			
				<td>
					<a href="<?php echo SITE_URL; ?>admin/album/<?php echo $id; ?>">
						<?php if($album->getNumberOfImages() > 0 and $album->getImage(0)->getName() != 'error') { ?>
						<img src="<?php echo SITE_URL; ?>core/timthumb.php?src=<?php echo $album->getImage(0)->getFileName() . "&h=$imageHeight&w=$imageWidth"; ?>" alt="<?php echo $album->getImage(0)->getName(); ?>" width="<?php echo $imageWidth; ?>px" height="<?php echo $imageHeight; ?>px" />
						<?php 
						}
						else {
						?>
						<img src="<?php echo SITE_URL; ?>img/none.png" alt="" width="<?php echo $imageWidth; ?>px" height="<?php echo $imageHeight; ?>px" class="none" />
						<?php
						}
						?>
					</a>
				</td>
			
				<td>
					<h3>
						<a href="<?php echo SITE_URL; ?>admin/album/<?php echo $id; ?>"><?php echo $album->getName(); ?></a>
					</h3>
					
					<div class="pure-u-1 previews">
					<?php 
					for ($i = 1; $i < $album->getNumberOfImages(); $i++) {
				
					?>
					<a href="<?php echo SITE_URL; ?>admin/album/<?php echo $id; ?>">
						<img src="<?php echo SITE_URL; ?>core/timthumb.php?src=<?php echo $album->getImage($i)->getFileName() . "&h=$imageHeightSmall&w=$imageWidthSmall"; ?>" alt="<?php echo $album->getImage($i)->getName(); ?>" width="<?php echo $imageWidthSmall; ?>px" height="<?php echo $imageHeightSmall; ?>px" />
					</a>
					<?php
					
						if($i == $limit) {
							break;
						}
				
					}
					?>
					</div>
					
				</td>
				
				<td class="date">
					<?php echo date('d-m-Y', $album->getDate()); ?>
				</td>
				
				<!--
				<td class="pure-hidden-tablet pure-hidden-phone">
					<form method="post" action="<?php echo SITE_URL; ?>admin/" class="pure-form">
						<input class="pure-input" type="hidden" name="changeAlbumId" value="<?php echo $album->getId(); ?>">
						<input type="text" name="changeName" value="" placeholder="Name" />
						<input class="pure-button pure-button-primary" type="submit" value="Change name">
					</form>
				</td>
				
				<td class="pure-hidden-tablet pure-hidden-phone">
					<form method="post" action="<?php echo SITE_URL; ?>admin/">
						<input type="hidden" name="deleteAlbum" value="<?php echo $id; ?>">
						<input class="pure-button pure-button-primary" type="submit" value="Delete">
					</form>
				</td>
				-->
				
				<td>
					<a class="pure-button pure-button-primary edit-button"><span class="glyphicon glyphicon-pencil"></span></a>
					
					
					<!-- Edit box -->
					<div class="edit-box">
						<form method="post" action="<?php echo SITE_URL; ?>admin/" class="pure-form">
							<input class="pure-input" type="hidden" name="changeAlbumId" value="<?php echo $album->getId(); ?>">
							
							<input type="text" name="changeName" value="" placeholder="New album name" class="pure-u-1" />
							
							
							<div class="button-container left">
								<input class="pure-button pure-button-primary" type="submit" value="Change name">
							</div>
							
							
						</form>
						
						<form method="post" action="<?php echo SITE_URL; ?>admin/">
							<input type="hidden" name="deleteAlbum" value="<?php echo $id; ?>">
							
							<div class="button-container right">
								<input class="pure-button pure-button-warning" type="submit" value="Delete">
							</div>
							
							
						</form>
						
					</div><!-- Edit box -->
					
				</td>
				
				
				<td>
					<a href="" download="<?php echo $album->getName(); ?>" class="pure-button pure-button-primary"><span class="glyphicon glyphicon-save"></span></a>
				</td>
				
				
			</tr>
			<?php

		}
		?>
	
	
	</tbody>


</table>


<div class="panel pure-u-1-3">

	<div class="panel-header">
		<h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> Add Album</h3>
	</div>


	<div class="panel-body">

		<form id="addAlbum" name="input" action="<?php echo SITE_URL; ?>admin/" method="post" class="pure-form pure-form-stacked">
			
			
			<input class="pure-input pure-u-1" type="text" name="albumName" placeholder="Name">
			
			
			<input class="pure-button pure-button-primary" type="submit" value="Add">
			
		</form>

	</div>

</div>


<div class="pure-u-1-24"><!--Seperator--></div>


<div class="panel pure-u-1-3">


	<div class="panel-header">
		<h3 class="panel-title"><span class="glyphicon glyphicon-open"></span> Upload Photos</h3>
	</div>	
	
	
	<div class="panel-body">


	<form id="uploadImages" enctype="multipart/form-data" name="upload" action="<?php echo SITE_URL; ?>admin/" method="post" class="pure-form pure-form-stacked">

		
		<p>
			<input class="" type="file" name="file[]" multiple required>
		</p>

		<select class="pure-input pure-u-1" name="albumId">
		
		<?php
		
		foreach ($this->albums as $album) {
			$id = $album->getId();
			$name = $album->getName();
			//echo "<a href=\"index.php?page=admin&album=$id\">$album</a>";
			echo "<option value=\"$id\">$name</option>";
		}
		?>
		
		</select>
		
		<input class="pure-button pure-button-primary" type="submit" value="Upload">
		
	</form>


	</div>

</div>