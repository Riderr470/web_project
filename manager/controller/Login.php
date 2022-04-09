<?php
$Username = "";
if (isset($_COOKIE['Username'])) {
	$Username = $_COOKIE['Username'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>

	<?php include '../view/header.php';?>

	<form action="logValidation.php" method="post" novalidate>
		
		<fieldset>
		
		<legend> Login</legend>

			<label for="username">UserName*:</label>
			<input type="text" name="username" id="username" size="30" value="<?php echo $Username;?>">

			<br><br>

			<label for="password">Password:</label>
			<input type="password" name="password" id="password" size="30" value="">
			
			<br><br>
	
			<input type="submit" name="login" value="login">
			<br><br>

			<a href="forgetPass.php">Forgot password?</a>

			<br>

		</fieldset>

		<p>Don't have account? <a href="Registration_Action.php">Click here</a> for registration.</p>

	</form>

</body>
</html>

