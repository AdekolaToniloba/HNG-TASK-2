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
    
    $password = symFony($_POST['password']);
$username = symFony($_POST['username']);

if(!empty($_POST['username']) && !empty($_POST['password'])) {
    
    $sql = "SELECT * FROM `users` WHERE `u_email` = '$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $user = $row['u_email'];
            $encrypted_password = $row['u_password'];
        
            if($username === $user && password_verify($password,$encrypted_password) === TRUE) {
                $access = true;
            } else {
                $access = false;
            }
        }
    } else {
        $access = false;
    }
}

if($access == true) {
    echo "Access granted";
} else {
    echo "Access denied";
}
?>
