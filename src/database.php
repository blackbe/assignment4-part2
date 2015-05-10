<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","blackbe-db", "BLl9stXAmddPeF4p","blackbe-db");
if ($mysqli->connect_errno)
{
	echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
}
else
{
	echo "Connection worked!";
}


/*echo '<form method="POST">
				<div>:
					<input type="text" name="username">
				</div>
			</form>';
?>*/
?>