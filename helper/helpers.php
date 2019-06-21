<?php
//security and cleanup function FOR input
function sanitize($dirty){
  $dirty = trim($dirty);
  //$dirty = stripslashes($dirty);
  $dirty = htmlspecialchars($dirty);
  $dirty = htmlentities($dirty,ENT_QUOTES,"UTF-8");
  return $dirty;
}

function create_group(){
  $let = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
  $gid = "";
  global $db;
  $get_idQuery = $db->query("SELECT * FROM asset_category ORDER BY ID DESC LIMIT 1");
  $get_id = mysqli_fetch_assoc($get_idQuery);
  if($get_id === null){
    return $let[0];
  }
  else{
    $g_id = $get_id['id'] + 1;
    if($g_id <= 26){
      return $let[$g_id - 1];
    }
    else{
      $gee = strval($g_id);
      $geeArray = str_split($gee);
      foreach($geeArray as $g){
        $gid.= $let[$g];
      }
      return $gid;
    }
    
  }
}

function recycle($tablename, $row_id){
  global $db;
  $db->query("UPDATE `{$tablename}` SET deleted = 1 WHERE id = '$row_id'");
  return true;
}

//to make our date look pretty
function pretty_date($date){
  return date("M d, Y h:i A", strtotime($date));
}

//to make our date look pretty
function pretty_date_only($date){
  return date("M d, Y", strtotime($date));
}

//log in functions
function ownerLogin($user_id){
  $_SESSION['SLOwner'] = $user_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  $db->query("UPDATE users SET last_login = '$date' WHERE id = '$user_id'");
  echo '<script>location.replace("/will/tunde will/index.php");</script>';

}

function adminLogin($user_id){
  $_SESSION['SLAdmin'] = $user_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  $db->query("UPDATE users SET last_login = '$date' WHERE id = '$user_id'");
  echo '<script>location.replace("/will/admin/index.php");</script>';
}

function friendLogin($user_id){
  $_SESSION['SLAllowed'] = $user_id;
  echo '<script>location.replace("/will/tunde will/index.php");</script>';
}

function is_logged_in(){
  if(isset($_SESSION['SLOwner']) && $_SESSION['SLOwner'] > 0){
    return true;
  }
  return false;
}

function is_logged_in_admin(){
  if(isset($_SESSION['SLAdmin']) && $_SESSION['SLAdmin'] > 0){
    return true;
  }
  return false;
}

function is_logged_in_special(){
  if(isset($_SESSION['SLAdmin']) || isset($_SESSION['SLOwner'])){
    return true;
  }
  return false;
}

function is_logged_in_friend(){
  if(isset($_SESSION['SLAllowed']) || isset($_SESSION['SLOwner'])){
    return true;
  }
  return false;
}

function has_permission(){
  global $user_data1;
  if(isset($_SESSION['SLAdmin']) && $user_data1['permission'] == "S"){
    return true;
  }
  return false;
}

//redirect you after log in function
function login_error_redirect(){
  unset($_SESSION['SLOwner']);
  unset($_SESSION['SLAllowed']);
  echo '<script>location.replace("/will/tunde will/login.php");</script>';
}

//if you have permisison to view page function
function permission_error_redirect($url = '/will/tunde will/login.php'){
  unset($_SESSION['SLAdmin']);
  echo '<script>alert("You do not have permission to access that page");</script>';
  echo '<script>location.replace("' .$url. '");</script>';
}


//create reference number
function create_refNumber($ref){
  $like =$ref."%";
  global $db;
  $get_refQuery = $db->query("SELECT * FROM assets WHERE asset_no LIKE '{$like}' ORDER BY id DESC LIMIT 1");
  $get_ref = mysqli_fetch_assoc($get_refQuery);
  if($get_ref === null){
    $n = 0;
    $y = str_pad($n + 1, 5, 0, STR_PAD_LEFT);
    return $ref."-".$y;

  }else{
    $div = explode("-", $get_ref['asset_no']);
    $h = $div[1];
    $n = ltrim($h, '0');
    $y = str_pad($n + 1, 5, 0, STR_PAD_LEFT);
    return $ref."-".$y;
  }
}

//money format
function money($symbol, $number){
  $numbre = number_format($number,0);
  return $symbol." ". $numbre;
}

function encrypt($id){
  $boohoo = array("a", "e", "i", "o", "u");
  global $db;
  $get_pee = $db->query("SELECT * FROM users WHERE `id` = '{$id}'");
  $fet = mysqli_fetch_assoc($get_pee);
  $free = $fet['fname'];
  $nig = 0;
  $yourString = str_replace($boohoo, "edy", $free);
  $ray = str_split($free);
  $flip = array_flip($ray);
  foreach($flip as $rit){
      $nig+= (int)$rit;
  }
  $lip = (int)45678;
  $fredy = $lip * $nig;
  return $yourString.$fredy;
}


function sizesToArray($string){
  $sizey = rtrim($string,',');
  $sizesArray = explode(',',$sizey);
  $returnArray = array();
  foreach($sizesArray as $size){
    $s = explode(':',$size);
    $returnArray[] = array("size" => $s[0], "quantity" => $s[1], 'threshold' => $s[2]);
  }
  return $returnArray;
}
function sizesToString($sizes){
  $sizeString = '';
  foreach($sizes as $size){
    $sizeString .= $size['size'].':'.$size['quantity'].':'.$size['threshold']. ',';
  }
  $trimmed = rtrim($sizeString, ',');
  return $trimmed;
}