<?php

/*
*	Creating an SQL database connection
*	using MySQLi syntax (Object-oriented)
*/
<?php
$sql_localhost = 'name_of_host';
$sql_username = 'username_of_choice';
$sql_password = 'password_of_choice';
$conn = new mysqli($sql_localhost, $sql_username, $sql_password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_db = 'name_of_database';
$conn_db = mysqli_select_db($conn, $sql_db);

if ($conn_db === FALSE) {
    die('An error occured: ' . $conn_db->error);
}
?>


//Sanitazing user input
function symFony($content)
{
    global $conn;
    $content = trim($content);
    $content = htmlspecialchars($content);
    $content = stripslashes($content);
    $content = $conn->real_escape_string($content);
    return $content;
}


$password = symFony($_POST['password']);
$username = symFony($_POST['username']);



if(!empty($_POST['username']) && !empty($_POST['password'])) {
    
    /*
        Retrieving data from database when using sql database
    
    */
    $sql = "SELECT * FROM `table_name` WHERE `column_name` = '$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
           $user = $row['username'];
           $encrypted_password = $row['password'];
        
            if($username === $user && password_verify($password,$encrypted_password) === TRUE) {
                $access = true;
                }
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
