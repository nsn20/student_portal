<?php
    include_once('connection.php');
    session_start();
    $error = "";
    if(isset($_SESSION['RollNo']) && isset($_SESSION['check'])){
        if(isset($_POST['pass_check'])){
            $rollNo = $_SESSION['RollNo'];
            
            $enteredPassword = $_POST['password'];

            //Read password from database
            $query =  "SELECT PASSWORD FROM student_credentials WHERE ROLL_NO = '$rollNo'";
            //making query and getting result
            $result = mysqli_query($conn, $query);
            //converting result into an associative array
            $details = mysqli_fetch_assoc($result);
            
            $password = $details['PASSWORD']; //need to the decryption thing shone mirzin said

            
            if(password_verify($enteredPassword, $password)){
                unset($_SESSION['check']);
                $_SESSION['change'] = "True";
                header("Location: update.php");
            }
            else{
                $error = "Password is incorrect!";
            }
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
        <title>Verify Password</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <script>
            function empty_check(x) {
                if(x == "" || x == null){
                    document.getElementById("empty_err").innerHTML = "All fields are required";
                    return 0;
                }
                return 1;
            }
            function func() {
                var p = document.getElementById('sPass').value;

                var x;
                x = empty_check(p);
                if(!x)
                    return false;

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
                We need to check if this is really you before you can edit data. <br><br>
                <form onsubmit="return func()" action = 'password_check.php' method = 'POST'>
                    <input type="password" name="password" id="sPass" placeholder="Enter your password"> 
                    <div id = 'empty_err'><?php echo $error; ?></div>
                    <input type="submit" name="pass_check" value="Submit">
                </form>
            </div>
        </div>
    </body>
</html>
