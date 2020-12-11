<?php
    include_once('connection.php');
    session_start();
    if(isset($_SESSION['RollNo']))
    {
        $roll = $_SESSION['RollNo'];
        $sql = "SELECT DISTINCT COURSE_ID FROM attendances WHERE ROLL = '$roll'";
        $result = mysqli_query($conn, $sql);
        $course = "";
        if(isset($_POST['submit']))
        {
            $course = $_POST['course'];
            $query = mysqli_query($conn, "SELECT COURSE_ID, CLASS_START, ATTENDANCE from attendances where roll = '$roll' AND COURSE_ID = '$course' ");
            while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
            {
                $resultAttendance [] = $row["ATTENDANCE"];
                $resultStartTime [] = $row["CLASS_START"];    
            }

            $total=0;
            $presentDays=0;
            foreach($resultAttendance as $attendance)
            {   $total+=1;
                if($attendance == 'PRESENT')
                    $presentDays+=1;
            }
            $percentage = ($presentDays/$total)*100;
            $result1 = array_combine($resultStartTime, $resultAttendance);
        }
        mysqli_close($conn);
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
        <title>Attendance</title>
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
                    <li><a href="profile.php">Profile</a></li>
                    <li><a class="selected" href="attendance.php">View Attendance</a></li>
                    <!-- <li><a href="#">Faculty</a></li> -->
                </ul>
            </nav>
            <a class="lgn" href="logout.php"><button class="btn">Logout</button></a>
        </header>
        <div class="main">
            <div id="second" class="frm">
                <form action="attendance.php" method="POST">
                    <select style="outline: 0; padding: 10px; background-color: rgba(0, 0, 0, 0.2); color: #edf0f1; border: 2px solid #0088a9; border-radius: 20px; " name="course">
                        <?php 
                            while($row = mysqli_fetch_array($result)) {
                        ?>

                        <option value = "<?php echo $row['COURSE_ID']; ?>" <?php if($course == $row['COURSE_ID']): ?>  selected="selected" <?php endif; ?>  >
                            <?php echo $row['COURSE_ID']; ?>
                        </option>
                    
                        <?php 
                            }
                        ?>
                    </select>
                    <input type="submit" name="submit" />
                </form>
            </div>
               <br><br>
               <?php if(isset($_POST['submit'])): ?>
                <div class="frm">
                    ATTENDANCE FOR THE COURSE <?php echo $course?> is <?php echo $percentage?>% <br/><br/> 
                </div>
                <table border=1 style="margin-left: auto; margin-right: auto;border:3px solid #24252A; border-collapse: collapse;">
                <tr>
                    <?php foreach($result1 as $startTime=>$attendance): ?>
                        <td style="padding: 15px; color: #0088a9;"> <?php echo $startTime; ?> </td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach($result1 as $startTime=>$attendance): ?>
                        <td style="padding: 15px;"> <?php echo $attendance; ?> </td>
                    <?php endforeach; ?>
                </tr>
                </table>
                <?php endif; ?>

        </div>
    </body>
</html>