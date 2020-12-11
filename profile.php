<?php 
    include_once('connection.php');
    session_start();
    if(isset($_SESSION['RollNo']))
    {
        if(isset($_POST['submit']))
        {
            $_SESSION['check'] = "True";
            header('Location: password_check.php');
        }
        $rollNo = $_SESSION['RollNo'];
        //fetching data
        $query =  "SELECT * FROM student_details WHERE ROLL_NO = '$rollNo'";
        //making query and getting result
        $result = mysqli_query($conn, $query);
        //converting result into an associative array
        $details = mysqli_fetch_assoc($result);

        $name = $details['NAME_OF_CANDIDATE'];
        $name1 = $details['NAME_OF_CANDIDATE_10TH'];
        $dob = $details['DATE_OF_BIRTH'];
        $gender = $details['GENDER'];
        $quota = $details['QUOTA'];
        $state_elig = $details['STATE_ELIGIBILTY'];
        $rel = $details['RELIGION'];
        $caste = $details['CASTE'];
        $category = $details['CATEGORY'];
        $seat_allot = $details['SEAT_ALLOTTED_CATEGORY'];
        $pwd = $details['PWD'];
        $doj = $details['DATE_OF_JOINING'];
        $course = $details['COURSE_ALLOTTED'];
        $phno1 = $details['MOB_NO'];
        $phno2 =  $details['ALT_NO'];
        $email =  $details['EMAIL_ID'];
        $father = $details['FATHER_NAME'];
        $father_mob = $details['FATHER_MOB_NO'];
        $parent_email = $details['PARENT_EMAIL_ID'];
        $mother = $details['MOTHER_NAME'];
        $addr = $details['ADDRESS'];
        $state = $details['STATE'];
   }
   else
    {
        header("Location: index.php");
    }
?>
    
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Student Details</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <p>NITPY</p>
            <nav>
                <ul>
                    <li><a class="selected" href="profile.php">Profile</a></li>
                    <li><a href="attendance.php">View Attendance</a></li>
                    <!-- <li><a href="#">Faculty</a></li> -->
                </ul>
            </nav>
            <a class="lgn" href="logout.php"><button class="btn">Logout</button></a>
        </header>
        <div class="main">
            <div class="heading">
                <h2>Profile Page</h2>
            </div>
            <br>

            <div class="container">
                <div id="left">
                    <div class="entry1">
                        <label>Name </label>
                    </div>

                    <div class="entry1">
                        <label>Name(As Per 10th) </label>
                    </div>

                    <div class="entry1">
                        <label>Roll Number </label>
                    </div>

                    <div class="entry1">
                        <label>DOB </label>
                    </div>

                    <div class="entry1">
                        <label>Gender </label>
                    </div>

                    <div class="entry1">
                        <label>Quota </label>
                    </div>

                    <div class="entry1">
                        <label>State Eligibilty </label>
                    </div>

                    <div class="entry1">
                        <label>Religion </label>
                    </div>
                    
                    <div class="entry1">
                        <label>Caste </label>
                    </div>

                    <div class="entry1">
                        <label>Category </label>
                    </div>

                    <div class="entry1">
                        <label>Seat Allotted Category </label>
                    </div>

                    <div class="entry1">
                        <label>PWD </label>
                    </div>

                    <div class="entry1">
                        <label>Date of Joining </label>
                    </div>

                    <div class="entry1">
                        <label>Course Allotted </label>
                    </div>

                    <div class="entry1">
                        <label>Phone Number </label>
                    </div>

                    <div class="entry1">
                        <label>Alternate Number </label>
                    </div>

                    <div class="entry1">
                        <label>Email ID </label>
                    </div>

                    <div class="entry1">
                        <label>Fathers Name </label>
                    </div>

                    <div class="entry1">
                        <label>Fathers Phone Number</label>
                    </div>

                    <div class="entry1">
                        <label>Parent Email ID</label>
                    </div>

                    <div class="entry1">
                        <label>Mothers Name</label>
                    </div>

                    <div class="entry1">
                        <label>Address</label>
                    </div>

                    <div class="entry1">
                        <label>State</label>
                    </div>
                </div>
                <div id="right">
                    <div class="entry">
                        <?php 
                            echo $name;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $name1;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $rollNo;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $dob;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $gender;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $quota;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $state_elig;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $rel;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $caste;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $category;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $seat_allot;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $pwd;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $doj;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $course;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $phno1;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $phno2;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $email;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $father;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $father_mob;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $parent_email;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $mother;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $addr;
                        ?>
                    </div>

                    <div class="entry">
                        <?php 
                            echo $state;
                        ?>
                    </div>
                </div>
                <div id="dummy">
                </div>
            </div>
            <form action="profile.php" method="POST">
                <input type="submit" name="submit" value="Edit info" />
            </form>
        </div>
    </body>
</html>
