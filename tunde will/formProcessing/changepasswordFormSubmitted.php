<?php
    if(isset($_POST) && !empty($_POST)){
        $old = sanitize($_POST['old']);
        $new = sanitize($_POST['new']);
        $confirm = sanitize($_POST['confirm']);
        $user_key = ((isset($_SESSION['SLOwner']) && $_SESSION['SLOwner'] != '' )?$user_data['id']:$user_data1['id']);

        if(empty($_POST['old'])){
            $old_error = "This field is Required.";
        }
        if(empty($_POST['new'])){
            $new_error = "This field is Required.";
        }
        if(empty($_POST['confirm'])){
            $confirm_error = "This field is Required.";
        }else{
            if(!isset($_GET['reset'])){
                $checkoldQuery = $db->query("SELECT * from users WHERE `id` = '{$user_key}'");
                $checkold = mysqli_fetch_assoc($checkoldQuery);
                if(!password_verify($old, $checkold['password'] )){
                    $old_error = "Invalid Password Entered.";
                }
            } 
            if(strlen($new) < 6){
                $new_error = "Password to Small";
            }  
            if($_POST['confirm'] != $_POST['new']){
                $confirm_error = $new_error = "Password do not match";
            }      
        }
        if($old_error == "" && $new_error == "" && $confirm_error == ""){
            $old = sanitize($_POST['old']);
            $new = sanitize($_POST['new']);
            $confirm = sanitize($_POST['confirm']);
            $hashed = password_hash($confirm,PASSWORD_DEFAULT);

            if(isset($_GET['reset']) && !empty($_GET['reset'])){
                $pushQuery6 = "UPDATE users SET `password` = '{$hashed}' WHERE `id` = '{$reset_id}'";
                $db->query($pushQuery6);
                echo '<script>location.replace("/will/admin/users.php");</script>';
            }
            if(isset($_SESSION['SLOwner'])){
                $pushQuery6 = "UPDATE users SET `password` = '{$hashed}' WHERE `id` = '{$user_key}'"; 
                $db->query($pushQuery6);
                echo '<script>location.replace("/will/tunde will/logout.php");</script>';
            }else{
                $pushQuery6 = "UPDATE users SET `password` = '{$hashed}' WHERE `id` = '{$user_key}'"; 
                $db->query($pushQuery6);
                echo '<script>location.replace("/will/admin/logout.php");</script>';
            }
            
            
        }
    }
?>