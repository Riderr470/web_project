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
	<title>Edit Staff details</title>
</head>
<body>
	<?php 

	$hostname = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "cafeteria";

	$conn = new mysqli($hostname, $dbuser, $dbpass, $dbname);


	if ($conn->connect_error) {
		die("Connection Unsuccessful: " . $conn->connect_error);
	}

	$id = $firstname = $lastname = $gender = $date = $religion = $address = $email = $Username = $password = "";
	$id = $_GET['id'];
		if (isset($_GET['id'])) {		
			
			$sql = "SELECT * FROM staff WHERE ID = '$id'";
			$result = $conn->query($sql);

			if ($result->num_rows == 1) {

			while($row = $result->fetch_assoc()) {
			 
			  	$firstname = $row["Firstname"];
				$lastname = $row["Lastname"];
				$gender = $row["Gender"];
				$date = $row["Date"];
				$religion = $row["Religion"];
				$address = $row["Address"];
				$email = $row["Email"];
				$Username = $row["Username"];
				$password = $row["Password"];
				}
			}
		}
		else {
			die("Invalid Request");
		}

	$conn->close();

	?>


	<h1>Edit Staff details</h1>

	<form action="editStaff_action.php" method="post">

		<label>Id*:</label>
		<input type="number" name="id" value="<?php echo $id; ?>" readonly>
		<br><br>

		<label>First Name*:</label>
		<input type="text" name="firstname" value="<?php echo $firstname; ?>">
		<br><br>

		<label>Last Name*:</label>
		<input type="text" name="lastname" value="<?php echo $lastname; ?>">
		<br><br>

		<label for="gender">Gender*:</label>
		<input type="radio" name="gender" id="male" value="Male" <?php if($gender=='Male'){ echo "checked=checked";}  ?> checked>
		<label for="male">Male</label>
		<input type="radio" name="gender" id="female" value="Female" <?php if($gender=='Female'){ echo "checked=checked";}  ?>>
		<label for="female">Female</label>
		<input type="radio" name="gender" id="others" value="Others" <?php if($gender=='Others'){ echo "checked=checked";}  ?>>
		<label for="others">Others</label>
		<br>

		<label for="date">Date*:</label>
		<input type="Date" name="date" id="date" size="30" value="<?php echo $date;?>">

		<br><br>

		<label for="religion">Religion*:</label>
		<select name="religion" id="religion">
    	<option value="Muslim">Muslim</option>
    	<option value="Hindu">Hindu</option>
    	<option value="Christian">Christian</option>
    	<option value="Budha">Budha</option>
    	<option value="Others">Others</option>
  		</select>

		<br><br>

		<label for="PreAddress">Present address*:</label>
		<textarea name="PreAddress" id="PreAddress" rows="3" cols="30"><?php echo $address;?></textarea> 

		<br><br>

		<label for="email">Email*:</label>
		<input type="text" name="email" id="email" size="30" value="<?php echo $email;?>">

		<br><br>

		<label for="Username">Username*:</label>
		<input type="text" name="Username" id="Username" size="30" value="<?php echo $Username;?>">

		<br><br>

		<label for="password">Password*:</label>
		<input type="password" name="password" id="password" size="30" value="<?php echo $password;?>">

		<br><br>

		<input type="submit" name="Update">
	</form>

	<br><br>

	<a href="staffManage.php">Staff management</a>

</body>
</html>