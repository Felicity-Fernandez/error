<?php
session_start();
@include 'signup.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$stud = $_POST['studno'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$course = $_POST['course'];
	$year = $_POST['year'];
	$section = $_POST['section'];
	$department = $_POST['department'];
	$password = $_POST['pass'];
	$rpassword = $_POST['pass2'];
	$sel = "SELECT*FROM student_users WHERE stud_num = '$stud' && password = '$password'";
	$res = mysqli_query($conn, $sel);
	if (mysqli_num_rows($res) > 0) {
		$error[] = 'User already exist.';
	}else{
		if ($password != $rpassword) {
			$error[] = 'Password not matched.';
		}else{
			$ins = "INSERT INTO student_users(stud_num, first_name, last_name, course, year, section, department, password) VALUES('$stud', '$fname', '$lname', '$course', '$year', '$section', '$department', '$password')";
			mysqli_query($conn, $ins);
			header('location:mobilelogin.php');
		}
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign Up page</title>
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
		.error-msg{
			color: red;
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
		<h1>Sign Up</h1>
		<h3>Please fill up the form below.</h3>
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
				<label for="firstname">First Name:</label>
				<input type="text" id="firstname" name="fname" maxlength="20" required>
				<label for="lastname">Last Name:</label>
				<input type="text" id="lastname" name="lname" maxlength="15" required>
				<label for="cour">Course:</label>
				<input type="text" id="cour" name="course" maxlength="8" required>
				<label for='yir'>Year:</label>
				<input type="text" id="yir" name="year" maxlength="1" required>
				<label for='sec'>Section:</label>
				<input type="text" id="sec" name="section" maxlength="1" required>
				<label for="dept">Department:</label>
				<input type="text" id="dept" name="department" maxlength="8" required>
				<label for="pass">Password:</label>
				<input type="password" id="pass" name="pass" required>
				<label for="pass2">Re-enter password:</label>
				<input type="password" id="pass2" name="pass2" required>
				<button type="submit" name="submit">Sign Up</button>
					<br><br>
	 	<hr>
	 	<br>
		<h2 style="font-size: 16px;font-family: serif;">Already have an account? <a href="mobilelogin.php">Login </a></h2>
		<br>
			</form>
		</div>
	</div>
 		
</body>

</html>