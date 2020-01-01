<?php session_start();

//make sure the user is in the session
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
}elseif ($_SESSION['issu'] == 0) {
  header("location: ../dashboard2.php");
}else {
    header("location:login.php");
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

//define post variables

$PRENOM= $_POST['PRENOM'];
$NOM= $_POST['NOM'];
$USERNAME= $_POST['USERNAME'];
$MOTDEPASSE= $_POST['MOTDEPASSE'];
$EMAIL= $_POST['EMAIL'];
$NTelephone= $_POST['NTelephone'];
$SERVEURIP= $_POST['SERVEURIP'];

//sql query
$sql = "INSERT INTO users SET firstname='$PRENOM', lastname='$NOM', username='$USERNAME', password='$MOTDEPASSE', email='$EMAIL', numtel='$NTelephone', SERVEURIP='$SERVEURIP'";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header('location:index.php');

?>
