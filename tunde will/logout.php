<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/will/core/init.php';
  unset($_SESSION['SLOwner']);
  unset($_SESSION['SLAllowed']);
  header('Location: /will/tunde will/login.php');
?>