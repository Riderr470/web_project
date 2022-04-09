<?php
session_start();
if(isset($_SESSION['username'])){

}
else{
	header("location: login.php");
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
			$phone = test($_POST['phone']);
			$email = test($_POST['email']);
			$Username = test($_POST['Username']);
			$password = test($_POST['password']);

			if (empty($id) or empty($firstname) or empty($lastname) or empty($gender) or empty($date) or empty($religion) or empty($address) or empty($phone) or empty($email) or empty($Username) or empty($password)) {
				echo "Please fill up the form properly";
			}
			else {
				define("FILENAME", "..\model\Staff.json");
				$handle = fopen(FILENAME, "r");
				$fr = fread($handle, filesize(FILENAME));
				$arr1 = json_decode($fr);
				$fc = fclose($handle);

				$handle = fopen(FILENAME, "w");

				for ($i = 0; $i < count($arr1); $i++) {
					if (+$id === $arr1[$i]->id) {
						$arr1[$i]->firstname = $firstname;
						$arr1[$i]->lastname = $lastname;
						$arr1[$i]->gender = $gender;
						$arr1[$i]->date = $date;
						$arr1[$i]->religion = $religion;
						$arr1[$i]->PreAddress = $address;
						$arr1[$i]->phone = $phone;
						$arr1[$i]->email = $email;
						$arr1[$i]->Username = $Username;
						$arr1[$i]->password = $password;
					}
				}

				$data = json_encode($arr1);
				$fw = fwrite($handle, $data);
		
				$fc = fclose($handle);

				if ($fw) {
					echo "<h3>Data Update Successful</h3>";
					header("location: staffManage.php");
				}

			}

		}
	?>