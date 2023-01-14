<?php
include "db_link.php";

function check_login($conn){
	if (isset($_SESSION['stud_num'])) {
		$id = $_SESSION['stud_num'];
		$sel = "SELECT*FROM student_users WHERE stud_num = '$id' limit 1";

		$res = mysqli_query($conn, $sel);
		if ($res && mysqli_num_rows($res) > 0) {
			$userdata = mysqli_fetch_assoc($res);
			return $userdata;
		}
	}header("location: mobilelogin.php");
	die;
}
?>