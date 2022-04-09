<?php
session_start();
if(isset($_SESSION['username'])){
	if(isset($_COOKIE['Username'])){
		
	}
	else{
		session_destroy();
	}

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
	<title>Home</title>
</head>
<body>
	<fieldset>
	<?php include '../view/header.php';?>
	
	<h2>Manager Lobby</h2>
<h2>Welcome <?php echo $_SESSION['username'];?></h2>	

<fieldset>
<a href="profile.php">Profile details</a> ||
<a href="changePass.php">Change password</a> ||
<a href="logout.php">Logout</a>
</fieldset>
<br><br>
<a href="staffManage.php">Staff management</a>
<br><br>
<a href="Reg_staff.php">Add Staff</a>
<br><br>
<a href="review.php">Suggest/Complaint</a>
<br><br>



<?php require '../view/footer.php';?>
</fieldset>


</body>
</html>