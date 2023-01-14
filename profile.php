<?php
session_start();
@include 'db_link.php';
@include 'signup.php';

if (isset($_POST["submit"])) {
	$stud = mysqli_real_escape_string($conn, $_POST['studno']);
	$fname = mysqli_real_escape_string($conn, $_POST['fname']);
	$lname = mysqli_real_escape_string($conn, $_POST['lname']);
	$course = mysqli_real_escape_string($conn, $_POST['course']);
	$year = mysqli_real_escape_string($conn, $_POST['year']);
	$section = mysqli_real_escape_string($conn, $_POST['section']);
	$department = mysqli_real_escape_string($conn, $_POST['department']);
	$password = mysqli_real_escape_string($conn, $_POST['pass']);
	$rpassword = mysqli_real_escape_string($conn, $_POST['pass2']);
		if ($password === $rpassword) {
				$pic_name = $_FILES["pic"]["name"];
				$pic_tmp_name = $_FILES["pic"]["tmp_name"];
				$pic_size = $_FILES["pic"]["size"];
				$new_pic = rand() . $pic_name;

				if ($pic_size > 5242880) {
					$error[] = 'Image maximum file size is 5MB only.';
				}else{
					$sel = "UPDATE student_users SET stud_num='$stud', first_name='$fname', last_name='$lname', course='$course', year='$year', section='$section', department='$department', password='$password', pic='$new_pic' WHERE stud_num='{$_SESSION["stud_num"]}'";
					$res = mysqli_query($conn, $sel);
					if ($res) {
						move_uploaded_file($pic_tmp_name, "imagesfold/" . $new_pic);
					}
				}
		}else{
			$error[] = 'Incorrect Student No. or password.';
		}
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit Profile</title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body{
			text-align: center;
			font-family: 'Open Sans', sans-serif;
			background-color: #63B877;
			overflow: hidden;
		}
		.cont{
			max-width: 440px;
			padding: 0 20px;
			margin: 170px auto;
		}
		h1{
			text-align: center;
			color: #fff;
		}
		form {
			width: 300px;
			color: white;
			margin-left: 40px;
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
		.back{
			font-size: 16px;
			background: #fff;
			color: #63B877;
			width: 120px;
			padding: 10px;
			text-align: center;
			border-radius: 5px;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div class="cont">
		<h1>Edit your profile.</h1>
			<form action="" method="POST" enctype="multipart/form-data">
				<?php
				if (isset($error)) {
					foreach ($error as $error) {
						echo '<span class="error-msg">'.$error.'</span';
					}
				}
				?>
				<?php
				$sel = "SELECT*FROM student_users WHERE stud_num = '{$_SESSION["stud_num"]}'";
				$res = mysqli_query($conn, $sel);
				if (mysqli_num_rows($res) > 0) {
					while ($row = mysqli_fetch_assoc($res)) {
				?>
				<label for="pic">Image:</label>
				<input type="file" accept="image/*" id="pic" name="pic">
				<img src="imagesfold/<?php echo $row["pic"]; ?>" width= "100px" height= "100px" alt="">
				<label for='stud'>Student Number:</label>
				<input type="text" id="stud" name="studno" maxlength="9" value="<?php echo $row['stud_num']; ?>"required>
				<label for="firstname">First Name:</label>
				<input type="text" id="firstname" name="fname" maxlength="20" value="<?php echo $row['first_name']; ?>" required>
				<label for="lastname">Last Name:</label>
				<input type="text" id="lastname" name="lname" maxlength="15" value="<?php echo $row['last_name']; ?>" required>
				<label for="cour">Course:</label>
				<input type="text" id="cour" name="course" maxlength="8" value="<?php echo $row['course']; ?>" required>
				<label for='yir'>Year:</label>
				<input type="text" id="yir" name="year" maxlength="1" value="<?php echo $row['year']; ?>" required>
				<label for='sec'>Section:</label>
				<input type="text" id="sec" name="section" maxlength="1" value="<?php echo $row['section']; ?>" required>
				<label for="dept">Department:</label>
				<input type="text" id="dept" name="department" maxlength="8" value="<?php echo $row['department']; ?>" required>
				<label for="pass">Password:</label>
				<input type="password" id="pass" name="pass" value="<?php echo $row['password']; ?>" required>
				<label for="pass2">Re-enter password:</label>
				<input type="password" id="pass2" name="pass2" value="<?php echo $row['password']; ?>" required>

				<?php
					}
				}
				?>
				
				<button type="submit" name="submit">Save</button>
			</form>
			<br>
				<a href="dashboardpage.php" class="back">Go Back</a>
	</div>
 		
</body>
</html>