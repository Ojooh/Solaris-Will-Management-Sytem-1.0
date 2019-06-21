<?php 

$config = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/will/core/willdbCon.ini');
$db = mysqli_connect("localhost",$config['username'],$config['password'],$config['db']);
if(mysqli_connect_errno())
{
  echo 'Database connection failed with following errors: '. mysqli_connect_error();
  die();
}
//to start session
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/will/helper/helpers.php';


if(isset($_SESSION['SLOwner'])){
  $user_id1 = $_SESSION['SLOwner'];
  $sessionQuery1 = $db->query("SELECT * FROM users WHERE `id` = '{$user_id1}'");
  $user_data = mysqli_fetch_assoc($sessionQuery1);
  $sum = mysqli_fetch_assoc($db->query("SELECT SUM(assets.dollars) AS total FROM  assets WHERE `user_id` = '{$user_data['id']}' AND `deleted` = 0"));
  $total = $sum['total'];
  $db->query("UPDATE owners SET `net_worth` = '{$total}' WHERE `name` = '{$user_data['id']}'");
}

if(isset($_SESSION['SLAdmin'])){
  $user_id = $_SESSION['SLAdmin'];
  $sessionQuery = $db->query("SELECT * FROM users WHERE `id` = '{$user_id}'");
  $user_data1 = mysqli_fetch_assoc($sessionQuery);
}

if(isset($_SESSION['SLAllowed'])){
  $user_id2 = $_SESSION['SLAllowed'];
  $permissions = explode('-', $user_id2);
  $demain = $permissions[0];
  $sessionQuery2 = $db->query("SELECT * FROM users WHERE `id` = '{$demain}'");
  $user_data2 = mysqli_fetch_assoc($sessionQuery2);
  $user_name = "Allowed Friends";
}



  


?>