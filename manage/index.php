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
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Gestion des administrateurs</title>
    <link href="../assets/font.css" rel="stylesheet">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS  -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Material Design Bootstrap  -->
  <link rel="stylesheet" href="css/mdb.min.css">
  <!-- DataTables.net  -->
  <link rel="stylesheet" type="text/css" href="css/addons/datatables.min.css">
  <link rel="stylesheet" href="css/addons/datatables-select.min.css">

  <!-- Your custom styles (optional)  -->
<style type="text/css">
  body{
    font-family: 'Montserrat', sans-serif;
    
  }
</style>
</head>

<body class="fixed-sn white-skin">

  
  <header>

    
    <div id="slide-out" class="side-nav sn-bg-4 fixed">
      <ul class="custom-scrollbar">

        <!-- Logo  -->
        <li class="logo-sn waves-effect py-3">
          <div class="text-center">
            <a href="#" class="pl-0"><img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png"></a>
          </div>
        </li>

        <!-- Search Form  -->
        <li>
          <form class="search-form" role="search">
            <div class="md-form mt-0 waves-light">
              <input type="text" class="form-control py-2" placeholder="Search">
            </div>
          </form>
        </li>

        <!-- Side navigation links  -->

        <!-- Side navigation links  -->

      </ul>
      <div class="sidenav-bg mask-strong"></div>
    </div>

 <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">


      <!-- Navbar links  -->
      <ul class="nav navbar-nav nav-flex-icons ml-auto">
        <li class="nav-item">
          <a class="nav-link waves-effect" href="loguser.php">
           <i class="fas fa-history"></i>
            <span class="clearfix d-none d-sm-inline-block">Historique</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect" href="../Dashboard.php">
            <i class="fas fa-tachometer-alt"></i>
            <span class="clearfix d-none d-sm-inline-block">Dashboard</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect" href="../chart.php">
           <i class="fas fa-chart-line"></i>          
           <span class="clearfix d-none d-sm-inline-block">Statistique</span></a>
        </li>

        <li class="nav-item">
          <a href="index.php">
        <div class="chip pink lighten-4 waves-effect waves-effect">
          <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" alt="Contact Person"><?php echo $_SESSION['username']; ?>
            </div>
            </a>
        
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect" href="../logout.php">
        <i class="fas fa-sign-out-alt"></i>
           <span class="clearfix d-none d-sm-inline-block">logout</span></a>
        </li>

      </ul>
      <!-- Navbar links  -->

    </nav>
  </header>
  

  <!-- Main layout  -->
  <main>
    <div class="container-fluid mb-5">

      <!-- Section: Basic examples -->
      <section>

        <!-- Gird column -->
        

        <!-- Gird column -->
        <div class="col-md-12">

<div class="alert alert-info" role="alert">
 Gestion des Administrateur 
</div>
          <div class="card" style="width: 1224px;">
            <div class="card-body">
              <table id="dt-material-checkbox" class="table table-striped" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">ID
                    </th>
                    <th class="th-sm">PRENOM
                    </th>
                    <th class="th-sm">NOM
                    </th>
                    <th class="th-sm">USERNAME
                    </th>
                    <th class="th-sm">MOT DE PASSE
                    </th>
                    <th class="th-sm">EMAIL
                    </th>
                    <th class="th-sm">N°Telephone
                    </th>
                    <th class="th-sm">SERVEUR @IP
                    </th>
                    <th class="th-sm">Action
                    </th>
                  </tr>
                </thead>
                <tbody>

<?php
           $sql = "SELECT * FROM users";
           $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {  
            if ($row["issu"] == 0) {     
                    $ID = $row["id"];
                    $PRENOM = $row["firstname"];
                    $NOM = $row["lastname"];
                    $USERNAME = $row["username"];
                    $MOTDEPASSE = $row["password"];
                    $EMAIL = $row["email"]; 
                    $NTelephone = $row["numtel"];
                    $ServeurIp = $row["serveurIP"]; 
                echo '<tr>';
                echo '<td>' . $ID . '</td>';
                echo '<td>' . $PRENOM. '</td>';
                echo '<td> ' .$NOM . '</td>';
                echo '<td> ' . $USERNAME . '</td>';
                echo '<td> ' . $MOTDEPASSE . '</td>';
                echo '<td> ' . $EMAIL . '</td>';
                echo '<td> ' . $NTelephone . '</td>';
                echo '<td> ' . $ServeurIp. '</td>';
                echo "
 
                <td class='update-cell'> 
                
                <a class='update' href='info.php?ID=" .$ID. "'>
                <button type='button' class='btn btn-outline-info waves-effect'>
                <i class='fas fa-edit'></i>&nbsp&nbspUpdate</button>

                </a>
                <a class='delete' href='delete.php?ID=" .$ID. "'>
                <button type='button' class='btn btn-outline-danger waves-effect'>
                <i class='fas fa-trash-alt'></i>
                &nbsp&nbspDelete</button>
</a>


                </td><br>";
                echo '</tr>';
                 }
            }
        echo '</div><br>';
        echo "<a class='insert' href='insert.php'>

<button type='button' class='btn btn-outline-success waves-effect'>
<i class='fas fa-plus'></i>&nbsp&nbspajouter</button>
        </a><br>";

        $conn->close();
        ?>

                </tbody>
              </table>
            </div>
          </div>

        </div>
        <!-- Gird column -->

      </section>
      <!-- Section: Basic examples -->

    </div>

    <!-- Section: Docs link -->
  </main>
  <!-- Main layout -->

  <!-- Footer  -->
  <!-- Footer  -->

  <!-- SCRIPTS  -->
  <!-- JQuery  -->
  <script src="js/jquery-3.4.0.min.js"></script>
  <!-- Bootstrap tooltips  -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript  -->
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <!-- MDB core JavaScript  -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- DataTables  -->
  <script type="text/javascript" src="js/addons/datatables.min.js"></script>
  <!-- DataTables Select  -->
  <script type="text/javascript" src="js/addons/datatables-select.min.js"></script>
  <!-- Custom scripts -->
  <script>
    // SideNav Initialization
    // Display a warning toast, with no title
toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!')

// Display a success toast, with a title
toastr.success('Have fun storming the castle!', 'Miracle Max Says')

// Display an error toast, with a title
toastr.error('I do not think that word means what you think it means.', 'Inconceivable!')

// Immediately remove current toasts without using animation
toastr.remove()

// Remove current toasts using animation
toastr.clear()

// Override global options
toastr.success('Page de Gestion Des Administrateurs', 'Bonjour Mr.<?php echo $_SESSION['username']; ?>', {timeOut: 5000})



    $(".button-collapse").sideNav();

    let container = document.querySelector('.custom-scrollbar');
    var ps = new PerfectScrollbar(container, {
      wheelSpeed: 2,
      wheelPropagation: true,
      minScrollbarLength: 20
    });

    $('#dtMaterialDesignExample').DataTable();

    $('#dt-material-checkbox').dataTable({

      columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
      }],
      select: {
        style: 'os',
        selector: 'td:first-child'
      }
    });

    $('#dtMaterialDesignExample_wrapper, #dt-material-checkbox_wrapper').find('label').each(function () {
      $(this).parent().append($(this).children());
    });
    $('#dtMaterialDesignExample_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').find(
      'input').each(function () {
      $('input').attr("placeholder", "Search");
      $('input').removeClass('form-control-sm');
    });
    $('#dtMaterialDesignExample_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
      'd-flex flex-row');
    $('#dtMaterialDesignExample_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
      'md-form');
    $('#dtMaterialDesignExample_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
      'custom-select custom-select-sm form-control form-control-sm');
    $('#dtMaterialDesignExample_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
    $('#dtMaterialDesignExample_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect();
    $('#dtMaterialDesignExample_wrapper .dataTables_filte, #dt-material-checkbox_wrapper .dataTables_filterr').find(
      'label').remove();

  </script>
</body>

</html>
