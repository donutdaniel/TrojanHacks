<?php
include_once('simple_html_dom.php');

$html = file_get_html('http://mlh.io/seasons/na-2017/events');

// $classname="blockProduct";
// $finder = new DomXPath($doc);
// $spaner = $finder->query("//*[contains(@class, '$classname')]");

// Find all images 
// foreach($html->find('img') as $element)
//  		echo $element . '<br>';


$increment = 1;

$counter = 0;
$size = 0;
foreach($html->find('h3') as $element){
	$hacks[$counter][0] = $element;
	$counter = $counter + $increment;
}
$size = $counter;

$counter = 0;
foreach($html->find('p') as $element){
	//echo $element;
	if($counter >= 1){
		if($counter % 2 != 0){
			$hacks[$counter/2][2] = $element;
		}
		else{
			$hacks[$counter/2-1][1] = $element;
		}
	}
		$counter = $counter + $increment;
	if($counter > $size*2){
		break;
	}
}

$counter = 0;
foreach($html->find('img') as $element){	
	if($counter > 3){
		if($counter % 2 != 0){
			$hacks[$counter/2-2][4] = $element;
		}
		else{
			$hacks[$counter/2-2][3] = $element;
		}
	}
	$counter = $counter + $increment;
	if($counter > $size*2+3){
		break;
	}
}

//array
	
//echo $hacks[1][0] . $hacks[1][1] . $hacks[1][2] . $hacks[1][3];
//$hacks = name, location, date, picture, icon
echo $size;
foreach($hacks as $out){
 //	echo $out[3];
	echo $out[0].', '.$out[1].', '.$out[2].', '.'<br>'.$out[3].'<br>'.', '.'<br>'.$out[4].'<br>'.'-------------';
}
echo '<br>';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Hackathon Music</title>
</head>
<body>

</body>
</html>



