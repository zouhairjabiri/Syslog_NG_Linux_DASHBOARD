<?php
session_start();

date_default_timezone_set('Africa/Casablanca');
$date = date('Y-m-d H:i:s', time());

if($_SESSION['issu'] == 0 ){
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "syslogng";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$idlog=$_SESSION['idlog'];     
echo $idlog;     
$sql = "UPDATE loguser SET log_out='$date' WHERE id=$idlog";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}


}


$_SESSION = array();
 
session_destroy();
header("location: index.php");

exit;
?>
