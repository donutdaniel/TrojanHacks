<?php
include_once('simple_html_dom.php');
$city = "San Francisco";
$state = "CA";
// Wiki data (html)
 // Make a playlist
echo "Making playlists..." . '<br>';
$playlistName = "Taste of " . $city;
$userName = "aug2016thomasian";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/users/".$userName."/playlists");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"name\":\"".$playlistName."\",\"public\":true}");
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = "Accept: application/json";
$headers[] = "Authorization: Bearer BQBLz_MG97Uj4PGr55hgY33etdxBUbpf2xDyHV18c52WpNA89puC3kSDj2XKAA97LBV3I-LVS2RgqgPNDPL_2jcpoA8EBgFbdWm1WH8xle3giMABSZJKmKLqIh2CdOgtUDVuNStOcQ5f66mULUiKH83lBVkid0QMCPtZRC-BLwaczHrqYMx_CbCSJ4e8_dA";
$headers[] = "Content-Type: application/json";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
// Grab generated playlist
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/users/".$userName."/playlists");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$headers = array();
$headers[] = "Accept: application/json";
$headers[] = "Authorization: Bearer BQBLz_MG97Uj4PGr55hgY33etdxBUbpf2xDyHV18c52WpNA89puC3kSDj2XKAA97LBV3I-LVS2RgqgPNDPL_2jcpoA8EBgFbdWm1WH8xle3giMABSZJKmKLqIh2CdOgtUDVuNStOcQ5f66mULUiKH83lBVkid0QMCPtZRC-BLwaczHrqYMx_CbCSJ4e8_dA";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$resultjson = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
// Grab first playlist of resultjson
echo "Finding artists...". '<br>';
$resultarray = json_decode($resultjson, true);
$playlistid = $resultarray['items'][0]['id'];
// echo $playlistid . '<br>';
// Wiki data (html)
$html = file_get_html('https://www.google.com/search?q=notable+people+from+'.urlencode($city).'+'.$state.'+' . '"wiki"+musicians');
//echo $html;
// Find all images 
$counter = 0;
foreach($html->find('cite') as $line){ // Grab line from Wiki
	$url = strip_tags($line);
	break;
}
// echo $url . '<br>';
$html = file_get_html($url);
// Find all images 
$counter = 0;
foreach($html->find('li') as $line){ // Grab line from Wiki
	
	if (strpos($line, 'singer') or strpos($line, 'musician')){ // Add line if contains relevant tag
		foreach($line->find('a') as $element2)
 		$names[$counter] = $element2;
 		$counter++;
	}
}
echo "Adding tracks..." . '<br>';
foreach ($names as $artist) {
	$artist = $artist->title;
	// If artist is not blank
	if ($artist != ""){
		$artistidurl = "https://api.spotify.com/v1/search?q=".urlencode($artist)."&type=artist";
		$artistidjson = file_get_contents($artistidurl);
		$artistidarray = json_decode($artistidjson,true);
		$artistid = $artistidarray['artists']['items'][0]['id'];
		//echo $artistid . '<br>';
		if($artistid != ""){
			$toptrackurl = "https://api.spotify.com/v1/artists/".$artistid."/top-tracks?country=US";
			$toptrackjson = file_get_contents($toptrackurl);
			$toptrackarray = json_decode($toptrackjson,true);
			$track = $toptrackarray['tracks'][0]['uri'];
			echo $track . '<br>'; //printing out track
			//add track to playlist
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/users/".$userName."/playlists/".$playlistid."/tracks?position=0&uris=". urlencode($track));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			$headers = array();
			$headers[] = "Accept: application/json";
			$headers[] = "Authorization: Bearer BQBLz_MG97Uj4PGr55hgY33etdxBUbpf2xDyHV18c52WpNA89puC3kSDj2XKAA97LBV3I-LVS2RgqgPNDPL_2jcpoA8EBgFbdWm1WH8xle3giMABSZJKmKLqIh2CdOgtUDVuNStOcQ5f66mULUiKH83lBVkid0QMCPtZRC-BLwaczHrqYMx_CbCSJ4e8_dA";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			if (curl_errno($ch)) {
			    echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
		}
	}
	
}
echo "Enjoy your songs...";
// $counter = 0;
// foreach($html->find('span') as $element){
// 			$names[$counter] = $element;
// 			$counter;
// }
// foreach($names as $out){
// 			echo $out;
// }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Parser Example</title>
</head>
<body>
		
</body>
</html>