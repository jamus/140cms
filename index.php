<?php include("includes/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
	<article class="container">
		<header class="cols_3"><?php include("includes/bio.php"); ?>
		</header>
		<section class="cols_10">
	<?php 
	if(file_exists("includes/bio.php")){
	foreach ($keywords as &$keyword) {
	
				$filename = 'includes/tweet_'.$keyword.'.php';
			
			if (file_exists($filename)) {
				include($filename);
			} else {
				echo '<h2>UH OH!</h2>
					<p>No Tweet with <strong>#'.$keyword.'</strong> found!</p>';
			}
		}
	}else{
		echo "If you have just installed this. You'll need to visit <a href='". $_SERVER['REQUEST_URI']."includes/functions.php'>this page</a> to prime the page with your tweets.";
	}
	
	 ?>
		<section>


		<aside class="cols_10">
			<?php include("includes/stats.php"); ?>
		</aside>

		<footer class="cols_10">
			<?php include("includes/credits.php"); ?>
		</footer>
	
	</article>
</body>
</html>
