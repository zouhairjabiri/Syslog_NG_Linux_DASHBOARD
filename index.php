<?php

session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
require 'includes/helperutils.class.php';
require_once 'includes/meekrodb.2.3.class.php'; 

date_default_timezone_set('Africa/Casablanca');
$date = date('Y-m-d H:i:s', time());
DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'syslogng';

$inst = new helperUtils();

$username = '';
$password = '';
$username_err = '';
$password_err = '';
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty($_POST["username"])){
        $username_err = "Entrer Votre Nom.";
    } else {
        $username = $inst->clean_input($_POST["username"]);
    }
    
    if(empty($_POST["password"])){
        $password_err = "Entrer votre mot de passe.";
    } else {
        $password = $inst->clean_input($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)) {
        $query = DB::query("SELECT id, username, password, email, issu FROM users WHERE username=%s", $username);
        if(count($query) >= 1) {
            if( $password == $query[0]['password']) {
                if(!isset($_SESSION)) 
                { 
                    session_start(); 
                } 
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $query[0]['id'];
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $query[0]['email'];
                $_SESSION['issu'] = $query[0]['issu'];
                if($_SESSION['issu'] == 0 || $query[0]['issu'] == 0) {
                   $sqllog = "INSERT INTO loguser SET user='$username', log_in='$date'";
                   DB::query($sqllog);
                   $query2 = DB::query("SELECT * FROM loguser ORDER BY ID DESC LIMIT 1");        
                     $_SESSION['idlog'] = $query2[0]['id'];
                     header("location: dashboard2.php");
                }
                header("location: dashboard.php");
            } else {
                $password_err = 'Verfier le mot de pass.';
            }
        } else {
            $username_err = 'aucun Administrateur trouvé avec cet Username.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dashboard Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="login/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
	      <link href="assets/font.css" rel="stylesheet">

<!--===============================================================================================-->
</head>
<style type="text/css">
	
	  body{
    font-family: 'Montserrat', sans-serif;
  }
</style>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="login/images/img-01.png" alt="IMG">
				</div>

				<form action="index.php"  method="post" class="login100-form validate-form">
					<span class="login100-form-title">
Espace Administrateur					</span>

					<div class="wrap-input100 validate-input <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" name="username" type="text" placeholder="Username" value="<?php echo $username; ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>

						</span>
					</div>
						<?php echo $username_err; ?>

					<div class="wrap-input100 validate-input <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>" data-validate = "Password is required">
						<input class="input100" name="password" type="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
											<?php echo $password_err; ?>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
						</span>
						<a class="txt2" href="#">
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">

						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>