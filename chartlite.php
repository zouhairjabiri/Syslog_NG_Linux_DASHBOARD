<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
$connect = mysqli_connect("127.0.0.1", "root", "", "syslogng");
$SERVERIP = mysqli_query($connect,"SELECT `host` AS SERVERIP FROM `logs` GROUP by host ORDER BY host");
$seedings = array($SERVERIP);

    FOREACH($seedings as $ps){ 
        $Totals = 0;
        while($row = mysqli_fetch_array($ps)){

            $Totals++;
 }}


$serveurip = $_GET['IP'];

$result = mysqli_query($connect,"SELECT COUNT(*) AS `count` FROM `logs` where host='$serveurip'");
$row = mysqli_fetch_assoc($result);
$count = $row['count'];


$debugT = mysqli_query($connect,"SELECT COUNT(*) AS `count` FROM `logs` WHERE level LIKE 'debug' AND host='$serveurip'");
$row = mysqli_fetch_assoc($debugT);
$debugT = $row['count'];

$infoT = mysqli_query($connect,"SELECT COUNT(*) AS `count` FROM `logs` WHERE  host='$serveurip' AND level LIKE 'info'");
$row = mysqli_fetch_assoc($infoT);
$infoT = $row['count'];

$noticeT = mysqli_query($connect,"SELECT COUNT(*) AS `count` FROM `logs` WHERE  host='$serveurip' AND level LIKE 'notice'");
$row = mysqli_fetch_assoc($noticeT);
$noticeT = $row['count'];

$warningT = mysqli_query($connect,"SELECT COUNT(*) AS `count` FROM `logs` WHERE  host='$serveurip' AND level LIKE 'warning'");
$row = mysqli_fetch_assoc($warningT);
$warningT = $row['count'];

$erreurT = mysqli_query($connect,"SELECT COUNT(*) AS `count` FROM `logs` WHERE  host='$serveurip' AND level LIKE 'erreur'");
$row = mysqli_fetch_assoc($erreurT);
$erreurT = $row['count'];

$criticalT = mysqli_query($connect,"SELECT COUNT(*) AS `count` FROM `logs` WHERE  host='$serveurip' AND level LIKE 'critical'");
$row = mysqli_fetch_assoc($criticalT);
$criticalT = $row['count'];

$alertT = mysqli_query($connect,"SELECT COUNT(*) AS `count` FROM `logs` WHERE  host='$serveurip' AND level LIKE 'alert'");
$row = mysqli_fetch_assoc($alertT);
$alertT = $row['count'];

$emergencyT = mysqli_query($connect,"SELECT COUNT(*) AS `count` FROM `logs` WHERE  host='$serveurip' AND level LIKE 'emergency'");
$row = mysqli_fetch_assoc($emergencyT);
$emergencyT = $row['count'];


?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link href="assets/font.css" rel="stylesheet">
  <script src="assets/js/chart.js"></script>

</head>
<style type="text/css">
  body{
    font-family: 'Montserrat', sans-serif;
    
  }
</style>
<body>

<div class="alert alert-primary" role="alert">
<a href="dashboard.php" class="w3-text-blue">
  <button type="button" class="btn btn-primary">Dashboard</button>
</a>
<?php
if ($_SESSION['issu'] == 1) {
echo "<a href='manage/index.php' class='w3-text-blue' style='    margin-right: 884px;'> 
  <button type='button' class='btn btn-success'>Gestion Des Utilisateur</button>
</a>";
}

?>

<?php echo $_SESSION['username']; ?>
<a href="logout.php" class="w3-text-blue">
  <button type="button" class="btn btn-danger">Logout</button>
</a>

 </div>

<br>
<br><br>
<div class="row">
  <div class="col-sm-4">
    

  </div>
   <div class="col-sm-4">
<div class="alert alert-primary" role="alert" style="    background-color: #cce5ff;
    border-color: #b8daff; color: #004085;"> 
  Les Logs du serveur <?php echo $serveurip; ?>.<br><br> Total :<?php echo $count ?> logs capturer
</div>

  </div>
   <div class="col-sm-4">
    

  </div>

</div>

<div class="row">
        <div class="col-md-6">
              <div class="card card-cascade narrower">
              <div class="card-body card-body-cascade text-center">

                <canvas id="doughnutChart" height="200px"></canvas>
<div class="alert alert-primary" role="alert" style="   color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;">
 Représentation graphique par secteur du serveur <?php echo $serveurip; ?>
</div>
              </div>
            </div>
        </div> 
        <div class="col-md-6">
           <canvas id="myChart" width="100" height="100" style="width: 100PX;height: 200px;"></canvas>
<div class="alert alert-primary" role="alert" style="    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeeba;">
Représentation graphique par le Diagramme en bâton <?php echo $serveurip; ?>
</div>
        </div>   
</div>





<?php

if ($_SESSION['issu'] == 1) {

  echo "<hr><hr><div class='row'>
  <div class='col-sm-2'>
    

  </div>
  <div class='col-sm-6'>
<div class='alert alert-primary' role='alert' style='    background-color: #cce5ff;
    border-color: #b8daff; color: #004085;'> 
  les serveurs dans Le reseau<br><br> Total :".$Totals++.
"</div>

  </div>
   <div class='col-sm-2'>
    

  </div>

</div>";
$SERVERIP = mysqli_query($connect,"SELECT `host` AS SERVERIP FROM `logs` GROUP by host ORDER BY host");
$seedings = array($SERVERIP);
echo "
<div class='row'>
  <div class='col-sm-4'>
    

  </div><div class='col-sm-4'>";
    FOREACH($seedings as $ps){ 
        $Totals = 0;
        while($row = mysqli_fetch_array($ps)){

            $Totals++;
          echo "  
  
            <a href='chartlite.php?IP=".$row['SERVERIP']."' class='w3-text-blue'>
  <button type='button' class='btn btn-warning'>".$row['SERVERIP']."</button>
</a>

  




"   ;}}
echo "</div>   <div class='col-sm-4'>
    

  </div>

</div>
";
}

?>










</body>
<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['debug ', 'info ', 'notice ', 'warning', 'erreur ', 'critical ' , 'alert  ', 'emergency '],
        datasets: [{
            label: '#Total des Logs',
            data: [<?php echo $debugT; ?>, <?php  echo $infoT; ?>, <?php  echo $noticeT; ?>, <?php  echo $warningT; ?>, <?php  echo $erreurT; ?>, <?php  echo $criticalT; ?>, <?php  echo $alertT; ?>, <?php  echo $emergencyT; ?>],
            backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#06d622" , "#7f06d6" , "#ff6e00"],
            borderColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#06d622" , "#7f06d6" , "#ff6e00"],
            borderWidth: 5
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


var ctxD = document.getElementById("doughnutChart").getContext('2d');
    var myLineChart = new Chart(ctxD, {
      type: 'doughnut',
      data: {
        labels: ['debug ', 'info ', 'notice ', 'warning', 'erreur ', 'critical ' , 'alert  ', 'emergency '],
        datasets: [{
          data: [<?php echo $debugT; ?>, <?php  echo $infoT; ?>, <?php  echo $noticeT; ?>, <?php  echo $warningT; ?>, <?php  echo $erreurT; ?>, <?php  echo $criticalT; ?>, <?php  echo $alertT; ?>, <?php  echo $emergencyT; ?>],
          backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#06d622" , "#7f06d6" , "#ff6e00"],
          hoverBackgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#06d622" , "#7f06d6" , "#ff6e00"]
        }]
      },
      options: {
        responsive: true
      }
                                          });
</script>
<script src="assets/js/bootstrap.min.js" type="text/javascript" >
    

</script>
</html>