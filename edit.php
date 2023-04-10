<?php
    include 'enrollment.php';
    
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: enroll-login.php");
        exit();
    }

    $id = $_GET['changedata'];
    $query_data = "SELECT * FROM student WHERE id = $id";
    $show_edit = mysqli_query($connect,$query_data);
    $list = mysqli_fetch_array($show_edit);

    if(isset($_POST['save'])){
        $fname_edit = $_POST['fname'];
        $lname_edit = $_POST['lname'];
        $mname_edit = $_POST['mid'];
        $dob_edit = $_POST['date'];
        $identity_edit = $_POST['gender'];
        $address_edit = $_POST['address'];
        $courses_edit = $_POST['course'];
        $year_edit = $_POST['year'];
        $Pnum_edit = $_POST['pnum'];
        $email_edit = $_POST['email'];
        $username_edit = $_POST['username'];
        $password_edit = $_POST['pword'];
        $id_edit = $_POST['ID'];

        $save_query = "UPDATE student SET Firstname='$fname_edit', LastName='$lname_edit', MiddleName='$mname_edit', DOB='$dob_edit', Gender='$identity_edit', Address='$address_edit', Course='$courses_edit', Year='$year_edit', `PhoneNo.` ='$Pnum_edit', Email='$email_edit', Username='$username_edit', Password='$password_edit' WHERE ID='$id_edit'";

        $save_list = mysqli_query($connect,$save_query);
        header("Location: students.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit</title>
    <link rel="icon" href="CATC.png">
    <link rel="stylesheet" type="text/css" href="edit.css">
</head>
<body>
    <section>
        <?php  include "nav.php";?>

        <div class="side">
            <div class="bordered-2">
                <img src="CATC.png">
            </div>
            <div class="bordered">
                <h2>Student Data</h2>
                <form action="edit.php?changedata=<?php echo $id;?>" method="POST">
                    <input type="hidden" name="ID" value="<?php echo $list['ID'];?>">
                    <label>FirstName:</label>&nbsp;&nbsp;
                    <input type="text" name="fname" value="<?php echo $list['FirstName'];?>">&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>LastName:</label>&nbsp;&nbsp;
                    <input type="text" name="lname" value="<?php echo $list['LastName'];?>"><br><br>
                    <label>Middle Name:</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="mid" value="<?php echo $list['MiddleName'];?>"><br><br>
                    <hr>
                    <label>DOB:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="date" name="date" value="<?php echo $list['DOB'];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>Male</label>
                    <input type="radio" name="gender" value="Male" <?php if($list['Gender'] == 'Male'){echo 'checked';}?>>
                    <label>Female</label>
                    <input type="radio" name="gender" value="Female" <?php if($list['Gender'] == 'Female'){echo 'checked';}?>><br><br>
                    <label>Address:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="address" value="<?php echo $list['Address'];?>">&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>Courses:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="course">
                        <option disabled hidden>Courses</option>
                        <?php
                            //To get all the courses from the table Course
                            $query_data = "Select * from course";
                            $course = mysqli_query($connect,$query_data);
                            $count = mysqli_num_rows($course);
                            if($count >= 1){
                                while($row = mysqli_fetch_assoc($course)){
                                    $selected = '';
                                    if($list['Course'] == $row['ID']){
                                        $selected = 'selected';
                                    }
                                    echo "<option value='".$row['ID']."' ".$selected.">".$row['Course']."</option>";  
                                }
                            }
                        ?>
                    </select>&nbsp;
                    <label>Year:</label>
                    <select name="year">
                        <option disabled hidden <?php if(empty($list['Year'])){echo 'selected';}?>>Year</option>
                        <option value="1" <?php if($list['Year'] == '1'){echo 'selected';}?>>1</option>
                        <option value="2" <?php if($list['Year'] == '2'){echo 'selected';}?>>2</option>
                        <option value="3" <?php if($list['Year'] == '3'){echo 'selected';}?>>3</option>
                        <option value="4" <?php if($list['Year'] == '4'){echo 'selected';}?>>4</option>
                    </select><br><br>
                    <label>Phone No.</label>&nbsp;&nbsp;
                    <input type="number" name="pnum" class="no" placeholder="+639524806133" value="<?php echo $list['PhoneNo.'];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>Email:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="email" value="<?php echo $list['Email'];?>"><br><br>
                    <label>Username:</label>&nbsp;
                    <input type="text" name="username" value="<?php echo $list['Username'];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>Password:</label>&nbsp;
                    <input type="password" name="pword" value="<?php echo $list['Password'];?>">
                    <input type="submit" name="save" value="Save" class="btn"> <br><br>
                    <div class="center">
                        <a class ='back' href="students.php">Back</a>
                    </div>
                </form>
            </div>
        </div>
        <?php
            include "footer.php";
        ?>
    </section>
</body>
</html>