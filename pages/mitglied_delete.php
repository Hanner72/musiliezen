<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: index.php");
  exit;
}
?>


<?php
include "../assets/inc/config.php";

if(isset($_GET['mglid']) > 0) {
  $mglid = $_GET['mglid'];
} else {
  $mglid = " ";
}

$sql = "DELETE FROM mitglieder WHERE mglid = $mglid; ";
$stmt= $DB->exec($sql);
/* $stmt->execute($mitglied); */

?>
<script>
// Angabe in Millisekunden (10000 = 10 Sekunden)
window.setTimeout("location.href='mitglieder.php';", 0);
</script>
<?php

// Von Post Abfrage die Ausgabe anzeigen
/* echo '<pre>';
print_r( $_GET );
echo '</pre>'; */

?>