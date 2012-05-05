<?php include("includes/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>

<body>
	<?php include("includes/bio.php"); ?>
	
	<?php 
	
	foreach ($keywords as &$keyword) {
	
				$filename = 'includes/tweet_'.$keyword.'.php';
			
			if (file_exists($filename)) {
				include($filename);
			} else {
				echo "Can't find a tweet hash tagged ".$keyword."";
			}
	}			
	
	 ?>
	



	<?php include("includes/stats.php"); ?>
	
	
	
</body>
</html>
