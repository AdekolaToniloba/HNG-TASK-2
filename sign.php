<?php
$con = mysqli_connect("localhost","id10946536_yamatouser","p3QHLwuKydmiW","id10946536_yamatodb");

// Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    function password($pass) {
        return md5(sha1($pass));
    }
    
    // var_dump($con);die();
    
    if(isset($_POST)) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $hashed_pass = password($_POST['password']);
        $sql="SELECT * FROM users WHERE u_email = '$email'";
        $result = mysqli_query($con,$sql);
        if($result->num_rows > 0){
            echo 'User Already Exist';
        }else{
            $sql3 = "INSERT INTO users (`u_username`, `u_email`, `u_password`) VALUES ('$username', '$email', '$hashed_pass')";
            // $result3 = mysqli_query($con, $sql3);
        // var_dump($sql3);die();
            if(mysqli_query($con,$sql3)){
                header('Location: index.html');
            } else{
                echo "ERROR: Could not able to execute sql";
            }
        }
    }
?>
