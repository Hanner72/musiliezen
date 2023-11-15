<?php

session_start();	

require_once './vendor/owasp/phprbac/PhpRbac/src/PhpRbac/Rbac.php';
$rbac = new PhpRbac\Rbac();

$userid = $_SESSION['USERID'];


?>

<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
<title>STRABAG AG - Direktion AH - Tools</title>
</head>
<body>

  <div class="p-4 bg-danger rounded-0">
    <div class="container-fluid py-3">
      <h1 class="display-5 fw-bold text-light">STRABAG AG - Direktion AH - Tools</h1>
    </div>
  </div>

  <?php
    include "./inc/pre.inc.php"; 
  ?>

  <div class="p-3">
    <div class="row row-cols-3 g-4" data-masonry='{"percentPosition": true }'>
      <div class="col">
        <div class="card h-100 border-dark">
          <img src="..." class="card-img-top bg-light" alt="...">
          <div class="card-header">
            Sportstättenbau FF-WW
          </div>
          <ul class="list-group list-group-flush">
            <?php
            if($rbac->Users->hasRole('DirAH-Admin', $userid)==1){ ?>
              <a name="" id="" class="btn btn-primary m-1" href="#" role="button">Rechte AH</a>
            <?php }
            if($rbac->Users->hasRole('FF-Admin', $userid)==1){ ?>
              <a name="" id="" class="btn btn-primary m-1" href="#" role="button">Rechte FF</a>
            <?php }
            if($rbac->Users->hasRole('WW-Admin', $userid)==1){ ?>
            <a name="" id="" class="btn btn-primary m-1" href="#" role="button">Rechte WW</a>
            <?php }
            if($rbac->Users->hasRole('WW-Mod', $userid)==1){ ?>
            <a name="" id="" class="btn btn-primary m-1" href="#" role="button">ff-bearbeiten</a>
            <?php }
            if($rbac->Users->hasRole('WW-User', $userid)==1){ ?>
            <a name="" id="" class="btn btn-primary m-1" href="#" role="button">löschen</a>
            <?php }  ?>
          </ul>
        </div>
      </div>
      <div class="col">
        <div class="card h-100 border-dark">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <a name="" id="" class="btn btn-primary m-1" href="./admin/roles.php" role="button">Userrechte Admin</a>
          </div>
        </div></div>
      <div class="col">
        <div class="card h-100 border-dark">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
        </div></div>
    </div>
  </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });
    
    $(function () {
        jQuery('[data-toggle="tooltip"]').tooltip()
    })

</script>

</body>

</html>