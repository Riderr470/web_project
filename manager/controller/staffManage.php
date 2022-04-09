<?php
session_start();
if(isset($_SESSION['username'])){

}
else{
	header("location: login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Staff Management</title>
</head>
<body>
	<?php include '../view/header.php';?>

<?php
				define("FILENAME", "..\model\Staff.json");
?>
<fieldset>
	<h2>Staff list</h2>

	<br><br>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" novalidate>

		<input type="text" name="search" placeholder="Search" size="30" value=""><input type="submit" name="searchB" value="Search">
		<br><br>

		<?php

	$search = "";

	if ($_SERVER['REQUEST_METHOD'] === "POST") {

			function test($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			$search = test($_POST['search']);

			if (empty($search)) {
				echo "search feild empty";
			}
			else{

				$handle = fopen(FILENAME, "r");
				$fr = fread($handle, filesize(FILENAME));
				$arr1 = json_decode($fr);
				$fc = fclose($handle);

				if ($arr1 === NULL) {
					echo "No record(s) found";
					}
			else {
			echo "<table border='1'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>Id</th>";
			echo "<th>First Name</th>";
			echo "<th>Last Name</th>";
			echo "<th>Gender</th>";
			echo "<th>Date</th>";
			echo "<th>Religion</th>";
			echo "<th>Address</th>";
			echo "<th>Phone</th>";
			echo "<th>Email</th>";
			echo "<th>Username</th>";
			echo "<th>Password</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			for ($i = 0; $i < count($arr1); $i++) {
				if($search === $arr1[$i]->firstname or $search === $arr1[$i]->Username){
				echo "<tr>";
				echo "<td>" . $arr1[$i]->id . "</td>";
				echo "<td>" . $arr1[$i]->firstname . "</td>";
				echo "<td>" . $arr1[$i]->lastname . "</td>";
				echo "<td>" . $arr1[$i]->gender . "</td>";
				echo "<td>" . $arr1[$i]->date . "</td>";
				echo "<td>" . $arr1[$i]->religion . "</td>";
				echo "<td>" . $arr1[$i]->PreAddress . "</td>";
				echo "<td>" . $arr1[$i]->phone . "</td>";
				echo "<td>" . $arr1[$i]->email . "</td>";
				echo "<td>" . $arr1[$i]->Username . "</td>";
				echo "<td>" . $arr1[$i]->password . "</td>";
				echo "<td>" . "<a href='DeleteAction.php?id=" . $arr1[$i]->id . "'>Delete</a>" . "|" . "<a href='editStaff.php?id=" . $arr1[$i]->id . "'>Edit</a>" . "</td>";
				echo "</tr>";
			}
			}
			echo "</tbody>";
			echo "</table>";
		}
			}
		}
	?>

		<br><br>
	</form>

<?php 

		$hostname = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$dbname = "cafeteria";

		$conn = new mysqli($hostname, $dbuser, $dbpass, $dbname);


		if ($conn->connect_error) {
			die("Connection Unsuccessful: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM staff";
		$result = $conn->query($sql);

		if ($result->num_rows > 0){
			echo "<table border='1'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>Id</th>";
			echo "<th>First Name</th>";
			echo "<th>Last Name</th>";
			echo "<th>Gender</th>";
			echo "<th>Date</th>";
			echo "<th>Religion</th>";
			echo "<th>Address</th>";
			echo "<th>Email</th>";
			echo "<th>Username</th>";
			echo "<th>Password</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" . $row["ID"] . "</td>";
				echo "<td>" . $row["Firstname"] . "</td>";
				echo "<td>" . $row["Lastname"] . "</td>";
				echo "<td>" . $row["Gender"] . "</td>";
				echo "<td>" . $row["Date"] . "</td>";
				echo "<td>" . $row["Religion"] . "</td>";
				echo "<td>" . $row["Address"] . "</td>";
				echo "<td>" . $row["Email"]. "</td>";
				echo "<td>" . $row["Username"] . "</td>";
				echo "<td>" . $row["Password"] . "</td>";
				echo "<td>" . "<a href='DeleteAction.php?id=" . $row["ID"]. "'>Delete</a>" . "|" . "<a href='editStaff.php?id=" . $row["ID"] . "'>Edit</a>" . "</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
		}
		else{
			echo "No record(s) found";
		}

?>


	<br><br>
	</fieldset>

	<a href="homepage.php">Home</a>

</body>
</html>