<?php
/*
Theme part for footer

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2013
*/
?>

	<div class="footer-wrapper">

		<footer>
			<p>
				<?php echo markdown_convert(COPYRIGHT); ?>
			</p>
		</footer>
		
		
	</div>

	<?php include( __DIR__ . '/lightbox.php') ?>
	
	
	<!-- Analytics -->
	<?php echo ANALYTICS; ?>
	
		
</body>
</html>