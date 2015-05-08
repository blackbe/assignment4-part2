<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
	//$username = $_POST['username']; // you should really do some more logic to see if it's set first

if(!(isset($_POST['username']))){
	$_SESSION = array();
	session_destroy();
	$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
	$filePath = implode('/',$filePath);
	$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
	header("Location: {$redirect}/login.php", true);
	die();
}
?>
<?php
if(session_status() == PHP_SESSION_ACTIVE){
	if(isset($_POST['username'])){
		$_SESSION['username'] = $_POST['username'];
	}

	if(!isset($_SESSION['visits'])){
		$_SESSION['visits'] = 0;
	}
	//echo $username;
	//var_dump($_POST);
	$_SESSION['visits']++;
	echo "Hi $_POST[username], you have visited this page $_SESSION[visits] times.\n";
	echo '<form action="http://web.engr.oregonstate.edu/~blackbe/cs290-assignment4-part1/content1.php" method="POST">
				<div>
					<br>
					<input id="Button" type="submit" name="username" value = "Content1">
				</div>
			</form>';
}
?>
</body>
</html>