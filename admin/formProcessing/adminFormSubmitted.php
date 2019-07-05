<?php
    if(isset($_POST) && !empty($_POST)){
        $fname = ucwords($_POST['fname']);
        $lname = ucwords($_POST['lname']);
        $email = $_POST['email'];
        $number = strval($_POST['number']);
        $title = $_POST['relations'];

        $adminCheckQuery = $db->query("SELECT * FROM users WHERE `email` = '{$email}'"); 
    if(isset($_GET['edit'])){
        $adminCheckQuery = $db->query("SELECT * FROM users WHERE `email` = '{$email}' AND `id` != '$edit_id'");
    } 
    
    $admincount = mysqli_num_rows($adminCheckQuery);

        if(empty($_POST['fname'])){
            $fname_error = "This field is Required.";
        }else{
            if(!preg_match("/^[a-zA-Z]+$/i", $_POST['fname'])){
                $fname_error = "Only Letters Allowed.";
            }
        }
        if(empty($_POST['lname'])){
            $lname_error = "This field is Required.";
        }else{
            if(!preg_match("/^[a-zA-Z -]+$/i", $_POST['lname'])){
                $lname_error = "Only Letters, Whitespace and hyphens Allowed.";
            }
        }
        if(empty($_POST['email'])){
            $email_error = "This field is Required.";
        }else{
            if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i", $_POST['email'])){
                $email_error = "Only Letters, Whitespace and hyphens Allowed.";
            }
        }
        if(empty($_POST['number'])){
            $number_error = "This field is Required.";
        }else{
            if(!preg_match("/^\+(?:[0-9] ?){6,14}[0-9]$/", $_POST['number'])){
                $number_error = "Only numbers And plus Allowed.";
            }
        }
        if(empty($_POST['title'])){
            $title_error = "This field is Required.";
        }
        if(empty($_POST['username'])){
            $username_error = "This field is Required.";
        }else{
            if(!preg_match("/^[a-zA-Z]+$/i", $_POST['username'])){
                $username_error = "Only Letters Allowed.";
            }
        }
        if(empty($_POST['password'])){
            $password_error = "";
        }else{
            if(strlen($_POST['password']) < 5){
                $password_error = "Password to small.";
            }
        }
        if(empty($_POST['confirm'])){
            $confirm_error = "";
        }else{
            if($_POST['password'] == $_POSt['confirm']){
                $confirm_error = "Passwords do not match.";
            }
        }
        if($count > 0){
            $email_error = "User Details exist already in our Database.";
        }

        if($fname_error == "" && $lname_error == "" && $email_error == "" && $number_error == "" && $title_error == "" && $username_error == "" && $password_error == "" && $confirm_error == ""){
            $fname = ucwords($_POST['fname']);
            $lname = ucwords($_POST['lname']);
            $username = ucwords($_POST['username']);
            $email = $_POST['email'];
            $number = strval($_POST['number']);
            $title = explode("-",$_POST['title']);
            $relation = $title[0];
            $permission = $title[1];
            $encrypkey = ((empty($_POST['confirm']) && empty($_POST['password']))?'':password_hash($confirm,PASSWORD_DEFAULT));
            $edit_date = date("Y-m-d H:i:s");

            $pushQuery13 = "INSERT INTO users(`fname`, `lname`, `username`, `email`, `phone_number`, `relation`, `permission`, `password`, `edit_date`) 
                                        VALUES('{$fname}', '{$lname}', '{$username}', '{$email}', '{$number}', '{$relation}', '{$permission}', '{$encrypkey}','{$edit_date}')";
            if(isset($_GET['edit'])){
                $encrypkey = ((empty($_POST['confirm']) && empty($_POST['password']))?$adminEdit['password']:password_hash($confirm,PASSWORD_DEFAULT));
                $pushQuery13 = "UPDATE users SET `fname` = '{$fname}', `lname` = '{$lname}', `username` = '{$username}', `email` = '{$email}', `phone_number` = '{$number}',
                                                 `relation` = '{$relation}', `permission` = '{$permission}',`password`= '{$encrypkey}', `edit_date` = '{$edit_date}' WHERE `id` = '$edit_id'"; 
            }
            $db->query($pushQuery13);
            echo '<script>location.replace("admin.php");</script>';
        }
    }
?>