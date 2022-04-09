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
	<title>profile</title>
</head>
<body>
		<?php include '../view/header.php';?>
	<?php 

		$hostname = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$dbname = "cafeteria";

		$conn = new mysqli($hostname, $dbuser, $dbpass, $dbname);


		if ($conn->connect_error) {
			die("Connection Unsuccessful: " . $conn->connect_error);
		}

		$id = $firstname = $lastname = $gender = $date = $religion = $address = $email = $Username = "";
		
		$Username = $_SESSION['username'];

			$sql = "SELECT * FROM user WHERE Username = '$Username'";
			$result = $conn->query($sql);

			if ($result->num_rows == 1) {
				while($row = $result->fetch_assoc()) {

					$id = $row["ID"];
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
		
		
	?>
	<?php 
		if ($_SERVER['REQUEST_METHOD'] === "POST") {

			function test($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			$id = test($_POST['id']);
			$firstname = test($_POST['firstname']);
			$lastname = test($_POST['lastname']);
			$gender = test($_POST['gender']);
			$date = test($_POST['date']);
			$religion = test($_POST['religion']);
			$address = test($_POST['PreAddress']);
			$email = test($_POST['email']);
			$Username = test($_POST['Username']);
			
			if (empty($id) or empty($firstname) or empty($lastname) or empty($gender) or empty($date) or empty($religion) or empty($address) or empty($email) or empty($Username)) {
				echo "Please fill up the form properly";
			}
			else {
				$sql="SELECT * FROM user WHERE ID ='$id'";
				$result = $conn->query($sql);

				if ($result->num_rows == 1){
					$sql="UPDATE user SET Firstname = '$firstname', Lastname = '$lastname', Gender = '$gender', Date = '$date', Religion = '$religion', Address = '$address', Email = '$email', Username = '$Username' WHERE Username='$Username'";

				if($conn->query($sql)){
					echo "Update Successful";

						}
					}
				}
				
				


		}
		$conn->close();
	?>

<fieldset>
	<h1>Profile View</h1>

	<form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post">

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

		<input type="submit" name="Update">
	</form>
	</fieldset>

	<br>

	<a href="homepage.php">home</a>
	<br>

</body>
</html>