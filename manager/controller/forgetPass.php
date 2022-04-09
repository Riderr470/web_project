<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Forgot Password</title>
</head>
<body>
	<?php include '../view/header.php';?>

	<?php

	$Username = $email = $password = $Cpass = "";
	$err = false;

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
			function test($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			$Username = test($_POST['username']);
			$email = test($_POST['email']);
			$password = test($_POST['password']);
			$Cpass = test($_POST['Cpass']);

			$hostname = "localhost";
			$dbuser = "root";
			$dbpass = "";
			$dbname = "cafeteria";

			$conn = new mysqli($hostname, $dbuser, $dbpass, $dbname);

			if ($conn->connect_error) {
				die("Connection Unsuccessful: " . $conn->connect_error);
			}

			if(empty($Username) or empty($email) or empty($password) or empty($Cpass)){
				echo "fill up empty feilds properly";
			}
			else{
				$sql="SELECT * FROM user WHERE Username ='$Username' and Email = '$email'";
				$result = $conn->query($sql);

				if ($result->num_rows == 1){
					if ($password === $Cpass) {
								$sql = "UPDATE user SET Password='$password' WHERE Email='$email'";
								if($conn->query($sql)){
									echo "Update Successful";

								}
								else {
  								echo "Error: " . $conn->error;
								}								
							}
					else{
						$err = true;
						echo "password and confirm password mismatch";
					}
							
				}
				else{
					echo "User not found";
				}

				
			}
			$conn->close();

		}

	?>

	<form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post" novalidate>
		
		<fieldset>
		

			<label for="username">UserName:</label>
			<input type="text" name="username" id="username" size="30" value="<?php echo $Username;?>">

			<br><br>

			<label for="email">Email:</label>
			<input type="text" name="email" id="email" size="30" value="<?php echo $email;?>">

			<br><br>

			<label for="password">Password:</label>
			<input type="password" name="password" id="password" size="30" value="<?php echo $password;?>">
			
			<br><br>

			<label for="Cpass">Confirm Password:</label>
			<input type="password" name="Cpass" id="Cpass" size="30" value="<?php echo $Cpass;?>">

			<br><br>

			<input type="submit" name="submit" value="submit">

		</fieldset>
		<br>
		<a href="Login.php">login</a>

	</form>

</body>
</html>

