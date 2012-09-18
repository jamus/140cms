<?php include("includes/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>

<body>
	<?php include("includes/bio.php"); ?>
	
	<?php 
	if(file_exists("includes/bio.php")){
	foreach ($keywords as &$keyword) {
	
				$filename = 'includes/tweet_'.$keyword.'.php';
			
			if (file_exists($filename)) {
				include($filename);
			} else {
				echo "Can't find a tweet hash tagged ".$keyword."";
			}
		}
	}else{
		echo "If you have just installed this. You'll need to visit <a href='". $_SERVER['REQUEST_URI']."/includes/functions.php'>this page</a> to prime the page with your tweets.";
	}
	
	 ?>
	



	<?php include("includes/stats.php"); ?>
	
	
	
</body>
</html>
