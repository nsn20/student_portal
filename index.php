<?php
    session_start();

    if(!isset($_SESSION['RollNo'])){
        include_once('connection.php');
        $errors = "";
        $roll = "";
        $pass = "";
        if(isset($_POST["submit"]))
        {
            if(!empty($_POST["RollNo"]))
            {
                $roll = $_POST["RollNo"];
            }
            if(!empty($_POST["Password"]))
            {
                $pass = $_POST["Password"];
            }     

            $sql = "SELECT * FROM student_credentials where ROLL_NO = '$roll'";
            $result = mysqli_query($conn, $sql);
            $creds = mysqli_fetch_all($result, MYSQLI_ASSOC);
            //print_r($creds);
            if(!$creds)
            {
                $errors = 'Roll No Does Not Exist';
            }
            elseif(password_verify($pass, $creds[0]['PASSWORD']))
            {
                $_SESSION['RollNo'] = $roll;
                header("Location: profile.php");
            }
            else
            {
                $errors = 'Incorrect Password';
            }
        }
        mysqli_close($conn);
    }
    else {
        header('Location: profile.php');
    }
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>NITPY</title>
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
                var u = document.getElementById('sUser').value;
                var p = document.getElementById('sPass').value;

                var x;
                x = empty_check(p);
                if(!x)
                    return false;

                x = empty_check(u);

                if(!x)
                    return false;

                return true;

            }
        </script>
    </head>
    <body>
        <header>
            <p>NITPY</p>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Academics</a></li>
                    <li><a href="#">Faculty</a></li>
                </ul>
            </nav>
            <a class="lgn" href="#"><button class="btn">Register</button></a>
        </header>
        <div class="main">
            <div id="second" class="frm">
                <form onsubmit="return func()" action = 'index.php' method = 'POST'>
                    <input id="sUser" name = "RollNo" type="text" placeholder="Username" value = <?php echo htmlspecialchars($roll); ?>> <br>
                    <input id="sPass" name = "Password" type="password" placeholder="Password" value = <?php echo htmlspecialchars($pass); ?>> <br>
                    <div id = 'empty_err'><?php echo $errors; ?></div>
                    <input type="submit" name="submit" value = "Login">
                </form>
            </div>
        </div>
    </body>
</html>
