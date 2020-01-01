<?php session_start(); ?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        //make sure the user is in the session
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user'];
        }elseif ($_SESSION['issu'] == 0) {
         header("location: ../dashboard2.php");
        } else {
            header("location:login.php");
        }
        
       
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "syslogng";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // set superglobal variable
        $row_name = $_GET['ID'];
        
        //sql query
        $sql = "DELETE FROM users WHERE id = '$row_name'";


        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        $conn->close();

        header('location:index.php');
        ?>
    </body>
</html>
