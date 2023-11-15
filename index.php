<?php
require_once("./assets/inc/config.php");
include("./assets/inc/security.php");

if (isset($_SESSION['user'])) {
	header('Location: ./globalfiles/dashboard.php');
}

if(isset($_SESSION['LOGINFEHLER']))
{
	$loginmessage = $_SESSION['LOGINFEHLER'];
}
else
{
	$loginmessage = "";
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="robots" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Login Page</title>
  <!--Made with love by Mutiullah Samim -->

	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="./assets/css/loginpage.css">

</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form action="./assets/inc/security.php" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name ="username" class="form-control" placeholder="Benutzername">

					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="Passwort">
					</div>
					<!-- <div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div> -->
					<div>
						<?php echo $loginmessage; ?>
					</div>
					<div class="form-group">
						<input type="submit" name="btnLogin" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Info!<br>Benutzername und Passwort sind jeweils der Nachname UND die ersten 3 Buchstaben vom Vornamen.<br>
					z.B. dannerjoh<br><br>
					Wer sich nicht einloggen kann, bitte um Info!<br><br>
				</div>
				<div class="d-flex justify-content-center links">
					Du hast keinen Account?<a href="mailto:johann.danner&#64;gmail.com">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="mailto:johann.danner&#64;gmail.com">Passwort vergessen?</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>
