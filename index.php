<?php

require_once("assets/inc/config.php");

if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
    // if logged in send to dashboard page
    redirect("pages/dashboard.php");
}

$title = "Login";
$mode = $_REQUEST["mode"];
if ($mode == "login") {
    $username = trim($_POST['username']);
    $pass = trim($_POST['user_password']);

    if ($username == "" || $pass == "") {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Enter manadatory fields";
    } else {
        $sql = "SELECT * FROM system_users WHERE u_username = :uname AND u_password = :upass ";

        try {
            $stmt = $DB->prepare($sql);

            // bind the values
            $stmt->bindValue(":uname", $username);
            $stmt->bindValue(":upass", $pass);

            // execute Query
            $stmt->execute();
            $results = $stmt->fetchAll();

            if (count($results) > 0) {
                $_SESSION["errorType"] = "success";
                $_SESSION["errorMsg"] = "Du hast dich erfolgreich eingeloggt.";

                $_SESSION["user_id"] = $results[0]["u_userid"];
                $_SESSION["rolecode"] = $results[0]["u_rolecode"];
                $_SESSION["username"] = $results[0]["u_username"];
                $_SESSION["firstlogin"] = $results[0]["firstlogin"];

                redirect("pages/index.php");
                exit;
            } else {
                $_SESSION["errorType"] = "danger";
                $_SESSION["errorMsg"] = "Username or Passwort existiert nicht!";
            }
        } catch (Exception $ex) {
            $_SESSION["errorType"] = "danger";
            $_SESSION["errorMsg"] = $ex->getMessage();
        }
    }
    redirect("index.php");
}

?>


<!DOCTYPE html>
<html lang='de'>

<head>

  <meta charset='UTF-8'>
  <meta name="robots" content="noindex">
  <link rel="shortcut icon" type="image/x-icon" href="./img/icon/favicon.png" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css"
    integrity="sha256-rnmbX+ZXZml9xbNUKt/qXfgpCi6zLJX7qqR+7vX/1ZY=" crossorigin="anonymous" />
  <link rel="stylesheet" href="bootstrap/css/style.min.css">
  <link rel="stylesheet" href="style.css">

</head>

<style>
section {
  position: relative;
  background-color: black;
  height: 100vh;
  min-height: 25rem;
  width: 100%;
  overflow: hidden;
}

section video {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: 0;
  -ms-transform: translateX(-50%) translateY(-50%);
  -moz-transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
}

section .container {
  position: relative;
  z-index: 2;
}

section .overlay-wcs {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: black;
  opacity: 0.5;
  z-index: 1;
}
</style>

<body>

  <section>
    <div class="overlay-wcs"></div>
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
      <source src="videos/mountain.mp4" type="video/mp4">
    </video>
    <div class="container h-100">

      <?php if ($ERROR_MSG <> "") { ?>
      <div class="col-lg-12 mt-3">
        <div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
          <button data-dismiss="alert" class="close" type="button">x</button>
          <p><?php echo $ERROR_MSG; ?></p>
        </div>
        <div style="height: 10px;">&nbsp;</div>
      </div>
      <?php } ?>

      <div class="d-flex h-100 text-center align-items-center">
        <div class="w-100 text-white">
          <div class="login">
            <img src="img/musicapo_logo_grau_auf_gelb_500x500.png" width="160px" style="border-radius: 80px">
            <h1>Login</h1>
            <form method="post" action="" name="contact_form" id="contact_form">
              <input type="hidden" name="mode" value="login">
              <input class="col-10 p-1 m-1" type="text" name="username" id="username" placeholder="Username"
                required="required" />
              <input class="col-10 p-1 m-1" type="password" name="user_password" id="user_password"
                placeholder="Password" required="required" />
              <button type="submit" class="btn btn-primary col-10 mt-1 p-2">Laß mich rein.</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
  </script>
  <script src="bootstrap/js/main.js"></script>
</body>

</html>
