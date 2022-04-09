<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete Action</title>
</head>
<body>

	<h1>Delete Action</h1>

	<?php 
		
		$hostname = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$dbname = "cafeteria";

		$conn = new mysqli($hostname, $dbuser, $dbpass, $dbname);


		if ($conn->connect_error) {
			die("Connection Unsuccessful: " . $conn->connect_error);
		}
		if (isset($_GET['id'])) {		
			$id = $_GET['id'];

			$sql = "DELETE FROM staff WHERE id = '$id'";

			if ($conn->query($sql)) {
  				echo "Delete Successful";
			} else {
  				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		else {
			die("Invalid Request");
		}
	?>

	<a href="staffManage.php">Staff management</a>

</body>
</html>