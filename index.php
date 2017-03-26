<?php
include_once('simple_html_dom.php');

$html = file_get_html('http://mlh.io/seasons/na-2017/events');

// $classname="blockProduct";
// $finder = new DomXPath($doc);
// $spaner = $finder->query("//*[contains(@class, '$classname')]");

// Find all images 
// foreach($html->find('img') as $element)
//  		echo $element . '<br>';

$counter = array(10);
foreach($html->find('h3') as $element)
			echo $element;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Parser Example</title>
</head>
<body>
		Parser
</body>
</html>



