<?php 
require_once '../core/init.php';
    $uname = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);

    $authQuery = $db->query("SELECT * FROM users WHERE `username` = '{$uname}'");
    $user = mysqli_fetch_assoc($authQuery);
    $userCount = mysqli_num_rows($authQuery);
    if($userCount < 1){
      $error = 'Invalid Username and Password';
      echo $error;
    }
    if($user['permission'] == "S" || $user['permission'] == "A"){
        if(!password_verify($password, $user['password'] )){
           $error = 'Incorrect Password, Please try again!';
           echo $error;
        }else{
            $admin_id = $user['id'];
            $error = adminLogin($admin_id);
            echo $error;
        }
        
    }
    if($user['permission'] == "O") {
        $name = $user['id'];
        $stateQuery = $db->query("SELECT * FROM owners WHERE `name` = '{$name}' AND `deleted` = 0");
        $ownerCount = mysqli_num_rows($stateQuery);
        if($ownerCount < 1){
            $error = 'Invalid Username and Password';
            echo $error;
          }
          else{
            if(!password_verify($password, $user['password'] )){
                $error = 'Incorrect Password, Please try again!';
                echo $error;
             }else{
                $owner_id = $user['id'];
                ownerLogin($owner_id);
             }
          }
    }
    if($user['permission'] == "F") {
      $name = $user['id'];
      $stateQuery = $db->query("SELECT * FROM users WHERE `id` = '{$name}' AND `deleted` != 0");
      $ownerCount = mysqli_num_rows($stateQuery);
      if($ownerCount < 1){
          $error = 'Invalid Username and Password from here';
          echo $error;
        }
        else{
          if(!password_verify($password, $user['password'] )){
              $error = 'Incorrect Password, Please try again!';
              echo $error;
           }else{
              $owner_id = $user['id']."-". $user['parent_user'];
              $last_date = date("Y-m-d H:i:s");
              $db->query("UPDATE users SET `last_login` = '{$last_date}' WHERE `id` = '{$user['id']}'");
              echo $owner_id;
           }
          
        }
  }


?>