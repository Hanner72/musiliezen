<?php

  if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
      // not logged in send to login page
      redirect("../index.php");
  }
  $status = false;
  if (
    authorize($_SESSION["access"]["VERW"]["MITGLIEDER"]["create"]) ||
    authorize($_SESSION["access"]["VERW"]["MITGLIEDER"]["edit"]) ||
    authorize($_SESSION["access"]["VERW"]["MITGLIEDER"]["view"]) ||
    authorize($_SESSION["access"]["VERW"]["MITGLIEDER"]["delete"])) {
      $status = true;
  }

  if ($status === false) {
      die("You dont have the permission to access this page");
  }
