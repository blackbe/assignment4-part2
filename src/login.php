<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>login</title>
</head>
<body>
<?php
echo '<form action="http://web.engr.oregonstate.edu/~blackbe/cs290-assignment4-part1/content1.php" method="POST">
				<div>Input Name and login:
					<input type="text" name="username">
					<input id="LogInButton" type="submit" value = "Content1">
				</div>
			</form>';
/*if(isset($_POST['action']) && $_POST['action'] == 'end'){
	$_SESSION = array();
	session_destroy();
	$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
	$filePath = implode('/',$filePath);
	$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
	header("Location: {$redirect}/Logout.html", true);
	die();
}

if(session_status() == PHP_SESSION_ACTIVE){
	if(isset($_POST['name'])){
		$_SESSION['name'] = $_POST['name'];
	}

}*/
?>
</body>
</html>