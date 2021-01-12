<?php 

/*
  Import Brightlocal JSON Review Feed to UL
*/

$feed = "https://your-brightlocal-feed-url";
$json = file_get_contents($feed);
$feedarray = json_decode($json, true);
/*
	Keys
	- source
	- sourceId
	- reviewType
	- reviewTitle
	- reviewBody
	- ratingValue
	- datePublished
	- author
	- reviewLink
	
*/
if ($feedarray["issuccess"] == "true") {
	$feedvalues = $feedarray["results"];
	$o = '<div class="reviews>';
	$o .= '<ul>';
	foreach ($feedvalues as $key => $value) {
		$o .= "";
		
	    echo $value["source"] . ", " . $value["reviewType"] . "<br>";
	} 
} else {
	$o = "<p>Error: Loading reviews failed.</p>";
}

echo $o;

?>
