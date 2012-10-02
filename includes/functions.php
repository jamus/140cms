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
		//if($hours > 0){$hours = $hours.' hours, ';}
		//else{$hours = false;}
		//if($minutes > 0){$minutes = $minutes.' minutes, ';}
		//else{$minutes = false;}
		//$seconds = $seconds.' seconds'; // always be at least one second
		//else {days = false; $hours = false; $minutes = false; $seconds = false;}

		return $year . '' .$month . '' .$days.''.$hours.''.$minutes.''.$seconds . ' ago';
	}
}


function create_tags($tweet) {

	
    preg_match_all('/#\S*\w/i', $tweet, $tags);
    
    $taglist = "";
	foreach( $tags[0] as $tag ) {
                $taglist .= '<li>'. $tag .'</li>';
                }
    //echo $taglist;
	return $taglist;
}


 ?>





