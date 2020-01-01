<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}elseif ($_SESSION['issu'] == 0) {
  header("location: ../dashboard2.php");
}

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "syslogng";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$ID = $_GET['ID'];
$PRENOM = $_POST['PRENOM'];
$NOM = $_POST['NOM'];
$USERNAME = $_POST['USERNAME'];
$MOTDEPASSE = $_POST['MOTDEPASSE'];
$EMAIL = $_POST['EMAIL'];
$NTelephone= $_POST['NTelephone'];
$ServeurIp = $_POST["ServeurIp"];

$sql = "UPDATE users SET firstname='$PRENOM', lastname='$NOM', username='$USERNAME', password='$MOTDEPASSE', email='$EMAIL', numtel='$NTelephone', serveurIP='$ServeurIp' WHERE id=$ID";


if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
header("location:index.php");
mysqli_close($conn);
?>