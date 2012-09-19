<?php include("includes/config.php"); ?>
<!doctype html>
	<!--[if lt IE 9]><html class="ie"><![endif]-->
	<!--[if gte IE 9]><!--><html><!--<![endif]-->
	<head>
	  <!-- TradeDoubler site verification 2008965 -->	
<meta name="verify-v1" content="OBI4OBr8ijoKSRdGabLd37q4WsBecIzjrRk3BKvFS5w=" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<meta name="keywords" content="john nye, john, nye, freelance, web, internet, developer, development, exeter, devon, php, xhtml, css, valid"/>
	<meta name="author" content="John Nye"/>
	<meta name='description' content='John Nye writing on Apple, Tech and web development. '/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="http://johnnye.net/" />
	<link href="http://feeds.feedburner.com/johnnyeblog" type="application/rss+xml" rel="alternate" title="RSS Feed" />
	<link href="/assets/css/style.css" rel="stylesheet" type="text/css" title="default" media="all"/>
	<title>John Nye</title>

<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	<script src="/mint/?js" type="text/javascript"></script>
	</head>
	<body lang="en">
		<header>
			<section>
<?php include("includes/bio.php");?>

			</section>
		</header>
	  	<section>
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
	

	 <div class="clear">&nbsp;</div>

	<?php include("includes/stats.php"); ?>
	
	</section>
		  <div class="clear"></div>
	<footer>
	<section>
  		<div class="footer-area">

    		<p>&nbsp;</p>
		  <p>All content copyright &copy;2009-2012 John Nye. This site is built on <a href="https://github.com/jamus/140cms">140cms</a></p>
		</div>
		<div class="footer-area">
			<h2>About</h2>
		  <p>I'm a web and iOS developer living in the South West UK, I consult and build applications at <a href="http://nimbleworks.co.uk">NimbleWorks</a> for you to download or use.</p>
		</div>

		<div class="footer-area">
			<h2>Contact</h2>
			<ul>
  				<li><a href="mailto:john@johnnye.net">john@johnnye.net</a></li>
			</ul>
			<div class="ad" id="adSpace">
  				</div>
  		</div>
  		<div class="clear"></div>
	</section>
</footer>
<script src="/assets/js/adnetwork.js"></script>
	  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8831527-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

	</body>
</html>