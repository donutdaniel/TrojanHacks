<?php
include_once('simple_html_dom.php');

$html = file_get_html('http://mlh.io/seasons/na-2017/events');

// Find all images 
foreach($html->find('img') as $element)
 		echo $element . '<br>';

foreach($html->find('') as $name)

?>

<!DOCTYPE html>
<html>
<head>
	<title>Parser Example</title>
</head>
<body>

</body>
</html>
