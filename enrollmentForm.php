<?php
	include "enrollment.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EnrollmentForm</title>
	<link rel="icon" href="CATC.png">
	<link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>
	<section>
		<?php
			session_start();
			include "nav.php";
		?>

	<div class="side">
		<div class="bordered-2">
			<img src="CATC.png">
		</div>

		<div class="bordered">
			<div class="center">
				<?php
					if(isset($_SESSION['username']) || isset($_SESSION['password'])){
				?>

				<a href="page1.php">Back</a>

				<?php
					}
				?>
			</div>
			<br>
		<h2>Enrollment Form</h2>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			<label>FirstName:</label>&nbsp;&nbsp;
			<input type="text" name="fname" placeholder="First Name" required>&nbsp;&nbsp;&nbsp;&nbsp;
			<label>LastName:</label>&nbsp;&nbsp;
			<input type="text" name="lname" placeholder="Last Name" required><br><br>
			<label>Middle Name:</label>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="mid" placeholder="Middle Name" required><br><br>
			<hr>
			<label>DOB:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="date" name="date" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>Male</label>
			<input type="radio" name="gender" value="Male" required>
			<label>Female</label>
			<input type="radio" name="gender" value="Female" required><br><br>
			<label>Address:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="address" placeholder="Address" required>&nbsp;&nbsp;&nbsp;&nbsp;
			<label>Courses:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="course" required>
				<option disabled selected hidden>Courses</option>
					<?php
					//To get all the courses from the table Course
					$query_data = "Select * from course";
					$course = mysqli_query($connect,$query_data);
					$count = mysqli_num_rows($course);
					if($count >= 1){
						while($row = mysqli_fetch_assoc($course)){
							echo "<option value = ".$row['ID'].">".$row['Course']."</option>";
						}
					}
				?>
			</select>&nbsp;
			<label>Year:</label>
			<select name="year" required>
				<option disabled selected hidden>Year</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select><br><br>
			<label>Phone No.</label>&nbsp;&nbsp;
			<input type="number" name="pnum" class="no" placeholder="+639524806133" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>Email:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="email" name="email" placeholder="Email" required> <br><br>
			<label>Username:</label>&nbsp;
			<input type="text" name="username" placeholder="Username" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>Password:</label>&nbsp;
			<input type="password" name="pword" placeholder="Password" required>
			<input type="submit" name="register" value="Register" class="btn"> <br>
		<?php
			if(isset($_POST['register'])){
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$mname = $_POST['mid'];
				$dob = $_POST['date'];
				$identity = $_POST['gender'];
				$address = $_POST['address'];
				$courses = $_POST['course'];
				$year = $_POST['year'];
				$Pnum = $_POST['pnum'];
				$email = $_POST['email'];
				$username = $_POST['username'];
				$password = $_POST['pword'];

				//Insert data from the table Student
				$insert_data = mysqli_query($connect,"INSERT INTO student VALUES ('','$fname','$lname','$mname','$dob','$identity','$address','$courses','$year','$Pnum','$email','$username','$password')");
				
				//if the insert_data is not empty it will be saved else not saved
				if($insert_data == true){
		?>
				<p style="font-size: 16px; font-family: sans-serif; margin-left: 16rem; color: green;">Saved!</p>
				<?php
					}
					else{
				?>

				<p style="font-size: 16px; font-family: sans-serif; margin-left: 16rem; color: red;">Not Saved!</p>

				<?php
				}
			}
				?>
		</form>
	</div>
	</div>
	<?php
		include "footer.php";
	?>
	</section>
</body>
</html>