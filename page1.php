<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Homepage</title>
	<link rel="icon" href="CATC.png">
	<link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
	<section>
		<?php
			include  "enrollment.php";
			session_start();
			if(!isset($_SESSION['username'])){
		        header("Location: enroll-login.php");
		        exit();
		    }
		    include "nav.php";
		?>

		<div class="side">
			<div class="bordered-2">
				<img src="CATC.png">
			</div>

			<div class="bordered">
				<h2>School Enrollment</h2>
				<a href="enrollmentForm.php">Registration</a><br><br>
				<?php
					$table_data = "Select * FROM admin where Username = '".$_SESSION['username']."' AND Password = '".$_SESSION['password']."' ";
					$query = mysqli_query($connect,$table_data);
					$row = mysqli_fetch_assoc($query);

					if(mysqli_num_rows($query) > 0){

				?>
					<a href="students.php">List of Students</a>
				<?php
					}
					else{
				?>
					<a href="profile.php">Profile</a>
				<?php
					}
				?>
			</div>
		</div>
		<?php
			include "footer.php";
		?>
	</section>
</body>
</html>