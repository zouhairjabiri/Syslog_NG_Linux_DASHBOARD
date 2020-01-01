<?php
session_start();

$connect= mysqli_connect("127.0.0.1", "root", "", "syslogng");
$columns = array('seq', 'host', 'facility', 'priority','level', 'tag', 'datetime','program', 'msg');


$username=$_SESSION['username'];



$sqlT = "SELECT serveurIP FROM users WHERE username='$username'";

$result2=mysqli_query($connect,$sqlT);

$row=mysqli_fetch_assoc($result2);

$serveurIP = $row['serveurIP'];

$query = "SELECT * FROM logs WHERE host='$serveurIP' AND";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'datetime BETWEEN "'.$_POST["start_date"].' 00:00:00" AND "'.$_POST["end_date"].' 23:59:59" AND ';
}


if(isset($_POST["search"]["value"]))
{
 $query .= '
  (seq LIKE "%'.$_POST["search"]["value"].'%" 
  OR host LIKE "%'.$_POST["search"]["value"].'%" 
  OR level LIKE "%'.$_POST["search"]["value"].'%" 
  OR msg LIKE "%'.$_POST["search"]["value"].'%")
 ';
}

if(isset($_POST["query"]["value"]))
{
 $query .= '
  (seq LIKE "%'.$_POST["search"]["value"].'%" 
  OR host LIKE "%'.$_POST["search"]["value"].'%" 
  OR level LIKE "%'.$_POST["search"]["value"].'%" 
  OR msg LIKE "%'.$_POST["search"]["value"].'%")
 ';
}

if(isset($_POST["order"])) {
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY seq DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'AND LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));
$result = mysqli_query($connect, $query);
$data = array();
while($row =  mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["seq"];
 $sub_array[] = $row["host"];
 $sub_array[] = $row["facility"];
 $sub_array[] = $row["priority"];
 $sub_array[] = $row["level"];
 $sub_array[] = $row["tag"];
 $sub_array[] = $row["datetime"]; 
 $sub_array[] = $row["program"];
 $sub_array[] = $row["msg"];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
$username=$_SESSION['username'];
$sqlT = "SELECT serveurIP FROM users WHERE username=$username";
$row = mysqli_query($connect,$sqlT);
$serveurIP = $row['serveurIP'];
 $query = "SELECT * FROM logs WHERE host = '$serveurIP'";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
