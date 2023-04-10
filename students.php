<?php
	//To delete data from the table
	include "enrollment.php";

	session_start();
    if(!isset($_SESSION['username'])){
        header("Location: enroll-login.php");
        exit();
    }

    

	if(isset($_POST['submit'])){
		$delete_id = $_POST['delete'];
		foreach($delete_id as $id){
			mysqli_query($connect, "DELETE FROM student WHERE ID='$id'");
		}
		header("Location: students.php");
	}
	//To close the previous opened database connection
	mysqli_close($connect);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>List of Students</title>
	<link rel="icon" href="CATC.png">
	<link rel="stylesheet" type="text/css" href="student.css">
</head>
<body>
	<section>
		<?php  include "nav.php";?>

		<div class="bordered">
			<div class="border">
				<a class="home" href="page1.php">Back</a>
			</div>
			<div class="bordered-2">
				<img src="CATC.png">
			</div>
			<div class="fortable">
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
					<table border="1px">
						<tr>
							<th></th>
							<th>FirstName</th>
							<th>LastName</th>
							<th>MiddleName</th>
							<th>DOB</th>
							<th>Gender</th>
							<th>Address</th>
							<th>Course</th>
							<th>Year</th>
							<th>PhoneNo.</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
						<?php
							//To get all the data from the table students
							include "enrollment.php";

							$query_data = "SELECT * FROM student";
							$get_data = mysqli_query($link, $query_data);
							$count = mysqli_num_rows($get_data);
							if($count > 0){
								while ($row = mysqli_fetch_array($get_data)){
						?>
						<tr>
							<td><input type="checkbox" name="delete[]" value="<?= $row['ID']; ?>"></td>
							<td><?= $row['FirstName'];?></td>
							<td><?= $row['LastName'];?></td>
							<td><?= $row['MiddleName'];?></td>
							<td><?= $row['DOB']; ?></td>
							<td><?= $row['Gender'];?></td>
							<td><?= $row['Address'];?></td>
							<?php
								//To get all the courses from the table Course
								$id = $row['Course'];
								$courses = mysqli_query($connect, "Select * From course where ID = '$id' ");
								$course = mysqli_fetch_assoc($courses);

								echo "<td>". $course['Course'] . "</td>";
							?>
							<td><?= $row['Year'];?></td>
							<td><?= $row['PhoneNo.'];?></td>
							<td><?= $row['Email'];?></td>
							<td><a class="edit" href="edit.php?changedata=<?php echo $row['ID']; ?>">Edit</a></td>
						</tr>
						<?php
								}
							} else {
						?>
						<tr>
							<td colspan="14">No records found</td>
						</tr>
						<?php
							}
							//To close the previous opened database connection
							mysqli_close($link);
						?>
					</table>
					<br>
					<?php
						if ($count > 0) {
						
					?>
					<input type="submit" name="submit" value="Delete" class="del" onclick="return confirm('Are you sure you want to delete this data?')">
					<?php
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
