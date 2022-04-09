
<?php

  if(isset($_POST['login'])){

		$Username = $Password = "";
		$Err = "";
		$isValid = true;
		$found = false;

		if ($_SERVER['REQUEST_METHOD'] === "POST") {
			function test($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		$Username = test($_POST['username']);
		$Password = test($_POST['password']);

		if (empty($Username)) {
				$isValid = false;
				$Err = "username can not be empty";
			}
		if (empty($Password)) {
				$isValid = false;
				$Err = "password can not be empty";
			}

			$hostname = "localhost";
			$user = "root";
			$pass = "";
			$dbname = "cafeteria";

			$conn = new mysqli($hostname, $user, $pass, $dbname);

			if ($conn->connect_error) {
				die("Connection Unsuccessful: " . $conn->connect_error);
			}

			$sql = "SELECT Username FROM user WHERE Username = '$Username' and Password = '$Password'";
			$temp_user = $conn->query($sql);
			

			if ($temp_user->num_rows > 0){
				header("location: homepage.php");
				session_start();
				$_SESSION['username']= $Username;
				$found = true;
				setcookie('Username', $Username, time()+60*10);
			}


			if($found == false)
			{
				echo "invalid username or incorrect password";
			}
	}
  }
  else{
	 header("location: login.php");

  }

$conn->close();

?>
