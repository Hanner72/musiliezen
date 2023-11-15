<?php
session_start();

require_once "config.php";

$loginmessage = "";
$role="";

if(isset($_POST["btnLogin"]))
{
  $username = $_POST["username"];
  $password = $_POST["password"];
  //echo $username;
  $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $_SESSION['USERID'] = $row['ID'];
      $_SESSION['user'] = $row["username"];
      $_SESSION['vorname'] = $row["vorname"];
      $_SESSION['nachname'] = $row["nachname"];
      $_SESSION['mobil'] = $row["mobil"];
      $_SESSION['whatsappapi'] = $row["whatsappapi"];
      $_SESSION['email'] = $row["email"];
      $_SESSION['firstlogin'] = $row["firstlogin"];
      header('Location: ../../globalfiles/dashboard.php');
      //echo $_SESSION['user'];
    }
  }
  else
  {
    $_SESSION['LOGINFEHLER'] = "<p class='mt-2 bg-danger rounded p-2 text-white'>Login fehlerhaft!</p>";
    header('Location: ../../index.php');
  }

}