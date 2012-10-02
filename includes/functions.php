 <?php




/// Functions required for formatting etc
 // 

 
if(!function_exists(timeBetween))
{
	function timeBetween($start_date,$end_date)
	{
		$diff = $end_date-$start_date;
 		$seconds = 0;
 		$hours   = 0;
 		$minutes = 0;
	
		if($diff % 86400 <= 0){$days = $diff / 86400;}  // 86,400 seconds in a day
		if($diff % 86400 > 0)
		{
			$rest = ($diff % 86400);
			$days = ($diff - $rest) / 86400;
     		if($rest % 3600 > 0)
			{
				$rest1 = ($rest % 3600);
				$hours = ($rest - $rest1) / 3600;
        		if($rest1 % 60 > 0)
				{
					$rest2 = ($rest1 % 60);
           		$minutes = ($rest1 - $rest2) / 60;
           		$seconds = $rest2;
        		}
        		else{$minutes = $rest1 / 60;}
     		}
     		else{$hours = $rest / 3600;}
		}

		if($days > 365){$year = $year.' Over a year '; $month=false; $days = false; $hours = false; $minutes = false; $seconds = false;}
		if($days > 30){$year = false; $month = $month.' Over a month '; $hours = false; $minutes = false; $seconds = false;}
		if($days >= 2){$year = false; $month = false; $days = $days.' days '; $hours = false; $minutes = false; $seconds = false;}
		if($days == 1){$year = false; $month = false; $days = $days.' day '; $hours = false; $minutes = false; $seconds = false;}
		if($hours > 1){$year = false; $month = false; $days = false; $hours = $hours.' hours'; $minutes = false; $seconds = false;}
		if($hours == 1){$year = false; $month = false; $year = false; $month = false; $days = false; $hours = $hours.' hour'; $minutes = false; $seconds = false;}
		if($minutes > 1){$days = false; $hours = false; $minutes = $minutes.' minutes'; $seconds = false;}
		

		return $year . '' .$month . '' .$days.''.$hours.''.$minutes.''.$seconds . ' ago';
	}
}

function insert_links($tweet) {

	$URLpattern = "@\b(https?://)?(([0-9a-zA-Z_!~*'().&=+$%-]+:)?[0-9a-zA-Z_!~*'().&=+$%-]+\@)?(([0-9]{1,3}\.){3}[0-9]{1,3}|([0-9a-zA-Z_!~*'()-]+\.)*([0-9a-zA-Z][0-9a-zA-Z-]{0,61})?[0-9a-zA-Z]\.[a-zA-Z]{2,6})(:[0-9]{1,4})?((/[0-9a-zA-Z_!~*'().;?:\@&=+$,%#-]+)*/?)@";
	$tweet = preg_replace($URLpattern, '<a href="\0" target="_blank">\0</a>', $tweet);



	return $tweet;
}

function create_tags($tweet) {

    preg_match_all('/#\S*\w/i', $tweet, $tags);
    
    $taglist = "";
	foreach( $tags[0] as $tag ) {
				global $twitteruser;
                $taglist .= '<li><a href="https://twitter.com/i/#!/search/%23'. $tag .'%20from%3A'.$twitteruser.'--" target="_blank">'. $tag .'</a></li>';
                }

    $taglist = preg_replace('/#([\w-]+)/i', '$1', $taglist); // remove #'s'
         
	return $taglist;
}

function remove_hashes($tweet) {

	$tweet = rtrim( preg_replace('/#[^\s]+\s?/', '', $tweet) );
	return $tweet;
}


 ?>





