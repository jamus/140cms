<?php

/// general setup  - Change optiosn below to suit

	include ('config.php');

/// Get tweets

foreach ($keywords as &$keyword) {
   echo "Getting Tweets for ".$keyword."\n" ;
   
   $request_one = "http://search.twitter.com/search.atom?q=from%3A".$twitteruser."+%23".$keyword;
	$q = urlencode("twitter");
	$curl= curl_init();
	curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($curl, CURLOPT_URL,$request_one);
	$response = curl_exec ($curl);
	curl_close($curl);
	$response = str_replace("twitter:", "", $response);
	$xml = simplexml_load_string($response);


		//just get the first entry for feed
		for($i=0;$i<1;$i++)
		{
			
			//get the id from entry
			$id = $xml->entry[$i]->id;
			
			//explode the $id by ":"
			$id_parts = explode(":",$id);
			
			//the last part is the tweet id
			$tweetcontents_id = array_pop($id_parts);
			
			//get the account link
			$account_link = $xml->entry[$i]->author->uri;
			
			//get the image link
			//$image_link = $xml->entry[$i]->link[1]->attributes()->href;
			
			//get name from entry and trim the last ")"
			$name = trim($xml->entry[$i]->author->name, ")");	
			
			//explode $name by the rest "(" inside it
			$name_parts = explode("(", $name);	
			
			//get the real name of user from the last part
			$real_name = trim(array_pop($name_parts));
			
			//the rest part is the screen name
			$screen_name = trim(array_pop($name_parts));
			
			//get the published time, replace T & Z with " " and trim the last " "
			$published_time = trim(str_replace(array("T","Z")," ",$xml->entry[$i]->published));

				$array = explode ( ' ' , $published_time ) ; // This will split $string by the space character ' '
				$tweet_date = $array[0] ; // date e.g 2010-10-01 
				
				echo $tweet_date . "<br>";
				
				// format date the way we want
				$tweet_year = substr($tweet_date, 0, -6);
				$tweet_month = substr($tweet_date, 5, -3);
				$tweet_day = substr($tweet_date, -2);
				
				$tweet_time = $array[1] ; // time e.g 14:16:26
				$tweet_time = substr($tweet_time, 0, -3); // remove seconds
				
				$current_time = urlEncode(date("Y-m-d")."T".date("H:i:s")."Z"); 


			//get the status link
			if ($status_link) {  /// make sure there is one
			$status_link = $xml->entry[$i]->link[0]->attributes()->href;
			}	
						
			//get the tweet	
			$tweet = $xml->entry[$i]->content;
			
			//remove <b> and </b> from the tweet. If you want to show bold keyword then you can comment this line
			$tweet = str_replace(array("<b>", "</b>"), "", $tweet);
			
			// remove hash tag label
			$tweet = str_replace(array(">@"), "class='atsign'>@", $tweet);
			
			// add class to remaing hash tag links
			$tweet = str_replace(array("onclick"), "class='tag' onclick", $tweet);

			// add target blank to llinks
			$tweet = str_replace(array("<a"), "<a target=\"_blank\"", $tweet);
			
			//get the source link
			$source = $xml->entry[$i]->source;
			
				
			//the result div that holds the information
			$tweetcontents ='<article class="'.$keyword.'"><h2>'.$keyword.'</h2>
					<p >'. $tweet .'</p>
						<a href="http://twitter.com/#!/'.$twitteruser.'/statuses/'.$tweetcontents_id.'" target="_blank" >
						<time datetime="'. $tweet_year .'.'. $tweet_month .'.'. $tweet_day .' '.$tweet_time.'">
						'. $tweet_day .'.'. $tweet_month .'.'. $tweet_year .'</time>
							<span > at '.$tweet_time.'</span></a>';
		}
		
		// echo $tweetcontents . "<br><br>";
		
		// Check if there was a matching tweet - if not dont write the new file
		if ($id) {
			
			//echo "We got one! =";
			echo "tweet_".$keyword.".php";
					$handle=fopen("tweet_".$keyword.".php","w") or die("cannot open tweet_".$keyword.".php");
					if(fwrite($handle,$tweetcontents,strlen($tweetcontents)))
					  echo "tweet_".$keyword.".php updated<br>\n";
					fclose($handle);
				
			
		} else {
			//echo "no recent matching tweet so we'll keep the old one.";
		}
		
}

/// Get stats & bio

$timestamp = date('m.d.Y h:i:s a', time());

$bio='';
$stats='';
$footer='';


function twitter_get_file($name, $credentials=false){
 $res = '';
 if($credentials === false)
 $res = @file_get_contents($name);
 if($res === false || $res == ''){
 $ch = curl_init();

 curl_setopt($ch, CURLOPT_URL, $name);
 if($credentials !== false)
 curl_setopt($ch, CURLOPT_USERPWD, $credentials);

 curl_setopt($ch, CURLOPT_AUTOREFERER, 0);
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

 $res = curl_exec($ch);

 if(!$res)
 twitter_log('Failed to read feeds from twitter');
 curl_close($ch);
 }
 return $res;
 }

 $api_url_reply = 'http://twitter.com/users/'.urlencode($twitteruser).'.xml';
 $req = twitter_get_file($api_url_reply);
 $xml = @new SimpleXMLElement($req);

$screen_name = (string)$xml->screen_name;
$description = (string)$xml->description;
$url = (string)$xml->url;
$profile_background_image_url = (string)$xml->profile_background_image_url;
$profile_background_tile = (string)$xml->profile_background_tile;

$followers_count = (string)$xml->followers_count;
$statuses_count = (string)$xml->statuses_count;
$friends_count = (string)$xml->friends_count;
$listed_count = (string)$xml->listed_count;


$profile_image_url = (string)$xml->profile_image_url;
// take of the normal size - bigger.JPG added below
$profile_image_url = substr($profile_image_url, 0, -10);



$name = (string)$xml->name;


$bio.='<h1>'.$name.'</h1>
		<h2><a href="http://twitter.com/#!/'.$twitteruser.'" target="_blank">@'.$twitteruser.'</a></h2>
		<p>' . $description . '</p>
		<img src="'.$profile_image_url.'reasonably_small.JPG" alt="'.$name.'" width="60px" />';

//echo $bio;

		$handle=fopen("bio.php","w") or die("cannot open header.php");
		if(fwrite($handle,$bio,strlen($bio)))
		  echo "bio updated<br>\n";
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
		  echo "stats updated<br>\n";
		fclose($handle);



/////////////// FOOTER 


?>