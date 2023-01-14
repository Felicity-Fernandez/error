<?php
session_start();

if (isset($_SESSION['stud_num'])) {
	unset($_SESSION['stud_num']);
}
header('location: mobilelogin.php');
?>