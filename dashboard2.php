 <?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}elseif ($_SESSION['issu'] == 1) {
  header("location: dashboard.php");
}

$connect = mysqli_connect("127.0.0.1", "root", "", "syslogng");

$username = $_SESSION['username'];
$query = "SELECT serveurIP FROM users WHERE username='$username'";
$result = mysqli_query($connect,$query);
$row = mysqli_fetch_assoc($result);
$IP = $row['serveurIP'];
?>

<html>
 <head>
  <title>Centralisation Des Logs</title>
        <link href="assets/font.css" rel="stylesheet">

  <script src="assets/js/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css" />
  <script src="assets/js/bootstrap-datepicker.js"></script>
  <style>
   body
   {
    margin:0;
    padding:0;
    background-color:#f1f1f1;
   }
   .box
   {
    width:1270px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
  </style>
 </head>
 <body>
<div class="container box">
<div class="alert alert-primary" role="alert">

<a href="chartlite.php?IP=<?php echo $IP; ?>" class="w3-text-blue">
  <button type="button" class="btn btn-primary">Voir les statistiques</button>
</a>

<?php
if ($_SESSION['issu'] == 1) {
echo "<a href='manage/index.php' class='w3-text-blue' style='margin-right: 731px;'> 
  <button type='button' class='btn btn-success'>Gestion Des Utilisateur</button>
</a>";
}

?>
<?php echo $_SESSION['username']; ?>
<a href="logout.php" class="w3-text-blue">
  <button type="button" class="btn btn-danger">Logout</button>
</a>

 </div>






   <h1 align="center">
   <img alt="ZAIB Logo" height="30" src="assets/logo.png" width="69"><br>
   Centralisation Des Logs </h1>

  
   <br />
<div class="row">
  <div class="col-sm-4">
    

  </div>
   <div class="col-sm-4">
<div class="alert alert-primary" role="alert" style="    background-color: #cce5ff;
    border-color: #b8daff; color: #004085;"> 
  Utilisateur : <?php echo $username; ?><br><br> Serveur Affecté <?php echo $IP; ?>
</div>

  </div>
   <div class="col-sm-4">
    

  </div>

</div>



   <div class="table-responsive">
    <br />
    <div class="row">
     <div class="input-daterange">
      <div class="col-md-2">
       <input type="text" name="start_date" placeholder="date debut " id="start_date" class="form-control" />
      </div>
      <div class="col-md-2">
       <input type="text" name="end_date" placeholder="date fin"id="end_date" class="form-control" />
      </div>
     </div>
     <div class="col-md-2">

      <input type="button" name="search" id="search" value="Chercher par une date" class="btn btn-info" />
     </div>
    </div>
    <br />
    <table id="order_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>SeqID</th>
       <th>host</th>
       <th>facilty</th>
       <th>priority</th>
       <th>level</th>
       <th>tag</th>
       <th>datetime</th>
       <th>program</th>
       <th>Message</th>
      </tr>
     </thead>
    </table>
   </div>
  </div>
  <p class="text-center">Powered by Jabiri Zouhair</p>
 </body>
</html>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });

 fetch_data('no');

 function fetch_data(is_date_search, start_date='', end_date='')
 {
  var dataTable = $('#order_data').DataTable({
   "processing" : true,
   "serverSide" : true,
   "order" : [],
   "ajax" : {
    url:"fetch2.php",
    type:"POST",
    data:{
     is_date_search:is_date_search, start_date:start_date, end_date:end_date
    }
   }
  });
 }
 $('#search').click(function(){
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  if(start_date != '' && end_date !='')
  {
   $('#order_data').DataTable().destroy();
   fetch_data('yes', start_date, end_date);
  }
  else
  {
   alert("Les deux dates Sont obligatoires");
  }
 });
});
</script>




