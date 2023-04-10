<?php
	$link = mysqli_connect("localhost","root","") or die('Unable to connect to database');
	$db = mysqli_select_db($link,"enrollmentform") or die('Unable to select database');

	$connect = mysqli_connect("localhost","root","","enrollmentform");
?>