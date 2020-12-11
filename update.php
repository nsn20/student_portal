<?php
    include_once('connection.php');
    session_start();

    if(isset($_SESSION['RollNo']) && isset($_SESSION['change'])){
        $rollNo = $_SESSION['RollNo'];

        $query1 = "SELECT EMAIL_ID, MOB_NO, ALT_NO FROM student_details WHERE ROLL_NO = '$rollNo'";
        $query2 = "SELECT PASSWORD FROM student_credentials WHERE ROLL_NO= '$rollNo'";

        $result1 = mysqli_query($conn, $query1);
        $result2 = mysqli_query($conn, $query2);

        $details1 = mysqli_fetch_assoc($result1);
        $details2 = mysqli_fetch_assoc($result2);

        $email = $details1['EMAIL_ID'];
        $mob = $details1['MOB_NO'];
        $alt = $details1['ALT_NO'];
        $password = $details2['PASSWORD'];

        if(isset($_POST['update']))
        {
            if(!empty($_POST['email'])) 
            {
                $email = $_POST['email'];
            }
            if(!empty($_POST['password'])) 
            {
                $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            }
            if(!empty($_POST['mobileNo'])) 
            {
                $mob = $_POST['mobileNo'];
            }
            if(!empty($_POST['altNo'])) 
            {
                $alt = $_POST['altNo'];
            }
            //Updting query for student_details table
            $query3 = "UPDATE student_details SET MOB_NO='$mob', EMAIL_ID='$email', ALT_NO='$alt' WHERE ROLL_NO = '$rollNo'";
            //Updting query for student_credentials table
            $query4 = "UPDATE student_credentials SET PASSWORD='$password' WHERE ROLL_NO = '$rollNo'";

            //Executing query
            $query3_run = mysqli_query($conn,$query3); 
            $query4_run = mysqli_query($conn,$query4); 

            if($query3_run && $query4_run){
                unset($_SESSION['change']);
                echo "<script> alert('Data Updated'); window.location.href='profile.php';</script>";
            }
            // sleep(2);
            // header("Location:profile.php");
        }
    }
    else {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Update Details</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <script>
            function empty_check(x) {
                if(x == "" || x == null){
                    return 0;
                }
                return 1;
            }

            function checkMail(x){
                var i, at=0;
                for(i=0; i<x.length; i++)
                {
                    if(x[i] == '@')
                    {
                        at = 1;
                        if(typeof x[i+1] === 'undefined' && typeof x[i+2] === 'undefined' && typeof x[i+3] === 'undefined')
                        {
                            return 0;
                        }

                    }
                    if(x[i] == "." && typeof x[i+1] === 'undefined' && typeof x[i+2] === 'undefined')
                    {
                        return 0;
                    }
                }
                if(at == 0){
                    return 0;
                }

                return 1;
            }

            function checkPhone(x){
                var i;
                if(x.length < 13)
                    return 0;
                else if(x[0] != "+" && x[1] != "9" && x[2] != "1")
                    return -1;

                return 1;
            }

            function func() {
                var e = document.getElementById('sEmail').value;
                var p = document.getElementById('sPass').value;
                var m = document.getElementById('sMob').value;
                var a = document.getElementById('sAlt').value;

                var c1 = empty_check(e); 
                var c2 = empty_check(p); 
                var c3 = empty_check(m); 
                var c4 = empty_check(a); 
                
                if(!(c1 || c2 || c3 || c4))
                {
                    document.getElementById("empty_err").innerHTML = "At least one field must be filled";
                    return false;
                }

                if(c1){
                    var x = checkMail(e);
                    if(!x){
                        document.getElementById("empty_err").innerHTML = "Email is not in correct format";
                        return false;
                    }
                }
                
                if(c2){
                    if(p.length < 8) {
                        document.getElementById("empty_err").innerHTML = "Password must have a minimum of 8 characters";
                        return false;
                    }
                }

                if(c3){
                    if(checkPhone(m) == 0){
                        document.getElementById("empty_err").innerHTML = "Phone number must be 10 digits without +91";
                        return false;
                    }
                    else if(checkPhone(m) == -1){
                        document.getElementById("empty_err").innerHTML = "Phone number must include +91";
                        return false;
                    }
                }

                if(c4){
                    if(checkPhone(a) == 0){
                        document.getElementById("empty_err").innerHTML = "Phone number must be 10 digits without +91";
                        return false;
                    }
                    else if(checkPhone(a) == -1){
                        document.getElementById("empty_err").innerHTML = "Phone number must include +91";
                        return false;
                    }
                }

                return true;
            }
        </script>
    </head>
    <body>
        <!-- <header>
            <p>NITPY</p>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Academics</a></li>
                    <li><a href="#">Faculty</a></li>
                </ul>
            </nav>
            <a class="lgn" href="#"><button class="btn">Register</button></a>
        </header> -->
        <div class="main1">
            <div id="second" class="frm">
                <h2>Update Info</h2> <br><br>
                <form onsubmit="return func()" action='update.php' method = 'POST'>
                    <input type="text" name="email" id="sEmail" placeholder="Update your email"><br>
                    <input type="password" name="password" id="sPass" placeholder="Update your password"><br>
                    <input type="text" name="mobileNo" id="sMob" placeholder="Update your mobile number"><br>
                    <input type="text" name="altNo" id="sAlt" placeholder="Update your alternate number"><br>
                    <div id = 'empty_err'></div>
                    <input type="submit" name="update" value="Update Data">
                </form>
            </div>
        </div>
    </body>
</html>