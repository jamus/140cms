<?php

/// general setup  - Change optiosn below to suit

	include ('config.php');
	
//// Get tweets (API 1.1)


$json = file_get_contents("http://api.twitter.com/1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=50", true); //getting the file content
$decode = json_decode($json, true); //getting the file content as array
 
/// Get stats & bio
$name = $decode[0][user][name];
//$screen_name = $decode[0][user][screen_name]; // unrequired
$description = $decode[0][user][description];
$location = $decode[0][user][location];
$url = $decode[0][user][url];


$followers_count = $decode[0][user][followers_count];
$statuses_count = $decode[0][user][statuses_count];
$friends_count = $decode[0][user][friends_count];
$listed_count = $decode[0][user][listed_count];

$profile_image_url = $decode[0][user][profile_image_url];

$timestamp = date('m.d.Y h:i:s a', time());

$bio='';
$stats='';
$footer='';



// strip off the normal size string - "_bigger.JPG" to get the full size image.
$profile_image_url = substr($profile_image_url, 0, -11);



$bio.='<h1>'.$name.'</h1>
		<h2><a href="http://twitter.com/#!/'.$twitteruser.'" target="_blank">@'.$twitteruser.'</a></h2>
		<p>' . $description . '</p>
		<p>' . $location . '</p>
		<img src="'.$profile_image_url.'.JPG" alt="'.$name.'" width="60px" />';

//echo $bio;

		$handle=fopen("bio.php","w") or die("cannot open header.php");
		if(fwrite($handle,$bio,strlen($bio)))
		  echo "<p><strong>Bio updated</strong></p>";
		fclose($handle);


/////////////// STATS 
$stats.='
			
	<ul >
		<li ><a href="http://twitter.com/#!/'.$twitteruser.'" target="_blank">'.$statuses_count.'</a> Tweets made						
		</li>
		<li ><a href="http://twitter.com/#!/'.$twitteruser.'/followers" target="_blank">'.$followers_count.'</a> Following me
		</li>
		<li ><a href="http://twitter.com/#!/'.$twitteruser.'/following" target="_blank">'.$friends_count.'</a> Followed by me
		</li>
		<li ><a href="http://twitter.com/#!/'.$twitteruser.'/lists/memberships" target="_blank">'.$listed_count.'</a> Lists feature me
		</li>
	</ul>';

//echo $stats;


		$handle=fopen("stats.php","w") or die("cannot open stats.php");
		if(fwrite($handle,$stats,strlen($stats)))
		  echo "<p><strong>Stats updated</strong></p>";
		fclose($handle);

/// Get tweets

foreach ($keywords as &$keyword) {
	 echo "<p><strong>Getting Tweets for #".$keyword."</strong><br>" ;
		$count = count($decode); 
		for($i=0;$i<$count;$i++){
		//echo $decode[$i][text]."<br>";
			if (strpos($decode[$i][text],'#'.$keyword.'') !== false) {
    			//echo $decode[$i][text]."<br>";
    				//get the id from entry
					$id = $decode[$i][id];
					echo $id;
					
    				$tweet_date = $decode[$i][created_at];  
					// format date the way we want
					$tweet_year = substr($tweet_date, 0, -6);
					$tweet_month = substr($tweet_date, 5, -3);
					$tweet_day = substr($tweet_date, -2);
				
					// $tweet_time = 
					
				
					$current_time = urlEncode(date("Y-m-d")."T".date("H:i:s")."Z"); 
    				
    				
    				$tweet = $decode[$i][text];
    			
    				//remove <b> and </b> from the tweet. If you want to show bold keyword then you can comment this line
					$tweet = str_replace(array("<b>", "</b>"), "", $tweet);
			
					// remove hash tag label
					$tweet = str_replace(array(">@"), "class='atsign'>@", $tweet);
			
					// add class to remaing hash tag links
					$tweet = str_replace(array("onclick"), "class='tag' onclick", $tweet);

					// add target blank to llinks
					$tweet = str_replace(array("<a"), "<a target=\"_blank\"", $tweet);
					
					//the result div that holds the information
					$tweetcontents ='<article class="'.$keyword.'"><h2>'.$keyword.'</h2>
					<p >'. $tweet .'</p>
						<a href="http://twitter.com/#!/'.$twitteruser.'/statuses/'.$tweetcontents_id.'" target="_blank" >
						<time datetime="'. $tweet_year .'.'. $tweet_month .'.'. $tweet_day .' '.$tweet_time.'">
						'. $tweet_day .'.'. $tweet_month .'.'. $tweet_year .'</time>
							<span > at '.$tweet_time.'</span></a>
							</article>';
							
					$handle=fopen("tweet_".$keyword.".php","w") or die("cannot open tweet_".$keyword.".php");
					if(fwrite($handle,$tweetcontents,strlen($tweetcontents)))
					echo "Found one dated " . $tweet_date . "</p>";
					fclose($handle);
    			
    				echo $tweetcontents;
    				
    			break; /// we don't want more than one so stop
			} 
			
		}
		
		
		 
		
}




/////////////// DONE LINK TO VIEW

	echo '<a href="../">Ok. You\'re all set - Click here to view your 140cms page.</a>'; 


?>