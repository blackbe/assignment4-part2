<?php
include 'pass.php';
?>
<!DOCTYPE html>
	<html>
	<head>
	<meta charset="UTF-8">
	<title>cs290-assignment4-part2</title>	
	</head>
	<body>
		<!-- from the Piazza post titled, "Input type required attribute not working?" -->
	<form action="addMovie.php" method="post">

			Title: <input type="text" name="title" required>

			Category: <input type="text" name="category">

			Length: <input type="number" name="length">
						
			<input type="submit" value="Add Movie">
		
			<input type="submit" name="checkout" value="Check Out/In">

			<input type="submit" name="deleteone" value="Delete">
	
	</form>
	
	<br>
	<form action="addMovie.php" method="post">
			<input type="submit" name="delete" value="Delete All">
	</form>
	<br>
<?php
//connect
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","blackbe-db", $password, "blackbe-db");
if ($mysqli->connect_errno)
{
	echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
}
else
{ 	
	//snippet borrowed from http://stackoverflow.com/questions/6179013/getting-true-false-value-returned-from-a-checkbox-error-when-false
	//if(isset($_POST['rented']) && $_POST['Rented'] == "Value"){ //where "Value" is the
          //same string given in the HTML form, as value attribute the the checkbox input
		//$rented = 1;
	//}
	//else
	//{
		$rented = 0;
	//}
	if(isset($_POST['delete'])) {

		$stmt = $mysqli->prepare("TRUNCATE TABLE video_inventory");
				/* execute prepared statement */
		$stmt->execute();
		printf("Table Deleted.\n");
		/* close statement and connection */
		$stmt->close();
	}
	else if (isset($_POST['checkout'])) {
		
		$stmt = $mysqli->prepare("SELECT * FROM  video_inventory WHERE title = ?");
		$stmt->bind_param('s', $_POST['title']);
		$stmt->execute();
		$result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result);
        if($row["rented"] == "0")
        {        
        	//MySqli Update Query
			$stmt = $mysqli->prepare("UPDATE video_inventory SET rented= '1' WHERE title = ?");
			$stmt->bind_param('s', $_POST['title']);
			$stmt->execute(); 
			$stmt->close();
        }
        if($row["rented"] == "1")
        {
        	//MySqli Update Query
			$stmt = $mysqli->prepare("UPDATE video_inventory SET rented= '0' WHERE title = ?");
			$stmt->bind_param('s', $_POST['title']);
			$stmt->execute(); 
			$stmt->close();
        }

		printf("Movie Updated.\n");
		/* close statement and connection */
		//$stmt->close();
		$stmt = $mysqli->prepare("SELECT * FROM  video_inventory");
		$stmt->execute();
		$result = mysqli_stmt_get_result($stmt);
		echo "<table border='1' cellpadding='2' cellspacing='2'";
		echo "<tr><td>ID</td><td>TITLE</td><td>CATEGORY</td><td>LENGTH(mins)</td><td>RENTED</td>";
        while ($row = mysqli_fetch_array($result))
        {
        	if($row["rented"] == "0")
        	{
        		$checked = "No";
        	}
        	if($row["rented"] == "1")
        	{
        		$checked = "Yes";
        	}
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
			echo "<td>" . $row["title"] . "</td>";
			echo "<td>" . $row["category"] . "</td>";
			echo "<td>" . $row["length"] . "</td>";
			echo "<td>" . $checked . "</td>";
    		echo "</tr>";
		}
		echo "</table>";
		/* close statement and connection */
		$stmt->close();
	}
	else if (isset($_POST['deleteone'])) {
		//MySqli Delete Query
		$stmt = $mysqli->prepare("DELETE FROM video_inventory WHERE title = ?");
		$stmt->bind_param('s', $_POST['title']);
		$stmt->execute(); 
		$stmt->close();

		printf("Movie Deleted.\n");
		/* close statement and connection */
		//$stmt->close();
		$stmt = $mysqli->prepare("SELECT * FROM  video_inventory");
		$stmt->execute();
		$result = mysqli_stmt_get_result($stmt);
		echo "<table border='1' cellpadding='2' cellspacing='2'";
		echo "<tr><td>ID</td><td>TITLE</td><td>CATEGORY</td><td>LENGTH(mins)</td><td>RENTED</td>";
        while ($row = mysqli_fetch_array($result))
        {
        	if($row["rented"] == "0")
        	{
        		$checked = "No";
        	}
        	if($row["rented"] == "1")
        	{
        		$checked = "Yes";
        	}
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
			echo "<td>" . $row["title"] . "</td>";
			echo "<td>" . $row["category"] . "</td>";
			echo "<td>" . $row["length"] . "</td>";
			echo "<td>" . $checked . "</td>";
    		echo "</tr>";
		}
		echo "</table>";
		/* close statement and connection */
		$stmt->close();
	}
	else 
	{
		if(!(is_null($_POST)) && $_POST['length'] < '0' )
		{
			print ("You must Enter a length greater than 0.\n");
		}
		else
		{
			$stmt = $mysqli->prepare("INSERT INTO video_inventory VALUES ('ssi', ?, ?, ?, ?)");
			$stmt->bind_param("ssii", $title, $cat, $len, $rented);

			$title     = $_POST['title'];
			$cat       = $_POST['category'];
			$len       = $_POST['length'];

			/* execute prepared statement */
			$stmt->execute();
			$id		  = $stmt->insert_id;
			printf("%d Row inserted.\n", $stmt->affected_rows);
		}
		$stmt = $mysqli->prepare("SELECT * FROM  video_inventory");
		$stmt->execute();
		$result = mysqli_stmt_get_result($stmt);
		echo "<table border='1' cellpadding='2' cellspacing='2'";
		echo "<tr><td>ID</td><td>TITLE</td><td>CATEGORY</td><td>LENGTH(mins)</td><td>RENTED</td>";
        while ($row = mysqli_fetch_array($result))
        {
        	if($row["rented"] == "0")
        	{
        		$checked = "No";
        	}
        	if($row["rented"] == "1")
        	{
        		$checked = "Yes";
        	}
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
			echo "<td>" . $row["title"] . "</td>";
			echo "<td>" . $row["category"] . "</td>";
			echo "<td>" . $row["length"] . "</td>";
			echo "<td>" . $checked . "</td>";
    		echo "</tr>";
		}
		echo "</table>";
		/* close statement and connection */
		$stmt->close();
	}
}
?> 
</body>
</html>