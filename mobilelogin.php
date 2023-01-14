<?php
session_start();
@include 'signup.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$stud = $_POST['studno'];
	$password = $_POST['password'];
	$sel = "SELECT*FROM student_users WHERE stud_num = '$stud' limit 1";
	$res = mysqli_query($conn, $sel);
	if($res){
	if ($res && mysqli_num_rows($res) > 0) {
		$userdata = mysqli_fetch_assoc($res);
		if ($userdata['password'] === $password) {
			$_SESSION['stud_num'] = $userdata['stud_num'];
			header("location:dashboardpage.php");
			die;
		}else{
			$error[] = 'Incorrect Student No. or password.';
		}
	}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login page</title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body{
			text-align: center;
			font-family: 'Open Sans', sans-serif;
			background-color: #373D47;
			overflow: hidden;
		}
		.cont{
			max-width: 440px;
			padding: 0 20px;
			margin: 170px auto;
		}
		.block {
				width: 380px;
				background-color: #63B877;
				margin: auto;
				border-radius: 10px;
				box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);
			}
		h1{
			text-align: center;
			padding-top: 20px;
			color: #fff;
		}
		form {
			width: 300px;
			color: white;
			margin-left: 20px;
		}
		form label{
			display: flex;
			margin-top: 10px;
			font-size: 18px;
		}
		form input{
			width: 100%;
			padding: 7px;
			border: none;
			border-radius: 6px;
			outline: none;
		}
		button{
			width: 320px;
			height: 35px;
			margin-top: 25px;
			border: none;
			background-color: white;
			color: #63B877;
			font-size: 18px;
			border-radius: 6px;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div class="cont">
	<div class="block">
		<h1>Login</h1>
			<form action="" method="POST">
					<?php
				if (isset($error)) {
					foreach ($error as $error) {
						echo '<span class="error-msg">'.$error.'</span';
					}
				}
				?>
				<br>
				<label for='stud'>Student Number:</label>
				<input type="text" id="stud" name="studno" maxlength="9" required>
					<label for="password">Password: </label>
					<input type="password" name="password" value=" pass"required>
				<button type="submit" name="submit">Login</button>
					<br><br>
	 	<hr>
	 	<br>
		<h2 style="font-size: 16px;font-family: serif;">Haven't Regitered Yet? <a href="mobilesignup.php">Register </a></h2>
		<br>
			</form>
		</div>
	</div>
 		
 		
</body>

</html>