<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>MultTable</title>
</head>
<body>
<?php
//Variables
$minPlier = $_GET["min-multiplier"];                                           

$maxPlier = $_GET["max-multiplier"];                                           

$minCand = $_GET["min-multiplicand"];                                           

$maxCand = $_GET["max-multiplicand"]; 


if (!ctype_digit($minPlier)){
	echo "Min-multiplier must be an integer.";
	echo '<br>';
	if ($minPlier >= $maxPlier || $minCand >= $maxCand) {
		echo "Minimum [multiplicand|multiplier] larger than maximum.";
	}
}
else if (!ctype_digit($maxPlier)){
	echo "Max-multiplier must be an integer.";
	echo '<br>';
	if ($minPlier >= $maxPlier || $minCand >= $maxCand) {
		echo "Minimum [multiplicand|multiplier] larger than maximum.";
	}
}
else if (!ctype_digit($minCand)){
	echo "Min-multiplicand must be an integer.";
	echo '<br>';
	if ($minPlier >= $maxPlier || $minCand >= $maxCand) {
		echo "Minimum [multiplicand|multiplier] larger than maximum.";
	}
}
else if (!ctype_digit($maxCand)){
	echo "Max-multipliplicand must be an integer.";
	echo '<br>';
	if ($minPlier >= $maxPlier || $minCand >= $maxCand) {
		echo "Minimum [multiplicand|multiplier] larger than maximum.";
	}
}
else if ($minPlier >= $maxPlier || $minCand >= $maxCand) {
	echo "Minimum [multiplicand|multiplier] larger than maximum.";
}
else {
	echo '<p><h3>Multiplication Table</h3>
	<p>
	<table border="1">';
	    echo '<tr><th></th>';
 	       for ($x = $minCand; $x <= $maxCand; $x++):
    	        echo '<th>'.$x.'</th>';
        	endfor;
    	echo '</tr>';
        	for ($y = $minPlier; $y <= $maxPlier; $y++):
            	echo '<tr><th>'.$y.'</th>';
                	for ($z = $minCand; $z <= $maxCand; $z++):
                    	echo '<td>'.($y * $z).'</td>';
                	endfor;
            	echo '</tr>';
        	endfor;
	echo '</table>';
}
?>
</body>
</html>