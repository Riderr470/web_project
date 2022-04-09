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
	<title>Update User</title>
</head>
<body>
	<?php include '../view/header.php';?>
	<?php 

		$Username = $Opassword = $Npassword = $passErr = $OpassErr = "";
		$err = false;
		$Username = $_SESSION['username'];

		if ($_SERVER['REQUEST_METHOD'] === "POST") {

			function test($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			$Opassword = test($_POST['Opassword']);
			$Npassword = test($_POST['Npassword']);

			$hostname = "localhost";
			$dbuser = "root";
			$dbpass = "";
			$dbname = "cafeteria";

			$conn = new mysqli($hostname, $dbuser, $dbpass, $dbname);

			if ($conn->connect_error) {
				die("Connection Unsuccessful: " . $conn->connect_error);
			}

			
			
			if (empty($Npassword)) {
				$err = true;
				$passErr = "password can not be empty";
			}
			else{
				$sql="SELECT * FROM user WHERE Password='$Opassword'";
				$result = $conn->query($sql);

				if ($result->num_rows == 1){
				$sql="UPDATE user SET Password='$Npassword' WHERE Username='$Username'";
				if($conn->query($sql)){
					echo "Update Successful";

						}
					}
				else{
					$OpassErr = "password doesn't match with old password";
				}

				}

			$conn->close();
			
		}
				
	?>

	<h1>Update User</h1>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<fieldset>

		<label>User Name:</label>
		<input type="text" name="username" value="<?php echo $Username; ?>" readonly>
		<br><br>

		<label>Old Password:</label>
		<input type="password" name="Opassword" value="<?php echo $Opassword; ?>">
		<span><?php echo $OpassErr; ?></span>
		<br><br>

		<label>New Password:</label>
		<input type="password" name="Npassword" value="<?php echo $Npassword; ?>">
		<span><?php echo $passErr; ?></span>
		<br><br>

		<input type="submit" name="Change password">
	</form>

	<br><br>

	<a href="homepage.php">go back</a>
	</fieldset>

</body>
</html>