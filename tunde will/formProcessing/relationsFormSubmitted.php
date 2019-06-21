<?php
    if(isset($_POST) && !empty($_POST)){
        $fname = ucwords($_POST['fname']);
        $lname = ucwords($_POST['lname']);
        $email = $_POST['email'];
        $number = strval($_POST['number']);
        $relations = ucwords($_POST['relations']);

        $relCheckQuery = $db->query("SELECT * FROM users WHERE `email` = '{$email}'"); 
    if(isset($_GET['edit'])){
        $relCheckQuery = $db->query("SELECT * FROM users WHERE `email` = '{$email}' AND `id` != '$edit_id'");
    } 
    
    $count = mysqli_num_rows($relCheckQuery);

        if(empty($_POST['fname'])){
            $fname_error = "This field is Required.";
        }
        if(empty($_POST['lname'])){
            $lname_error = "This field is Required.";
        }
        if(empty($_POST['email'])){
            $email_error = "This field is Required.";
        }
        if(empty($_POST['relations'])){
            $relations_error = "This field is Required.";
        }else{
            if(!preg_match("/^[a-zA-Z]+$/i", $_POST['fname'])){
                $fname_error = "Only Letters Allowed.";
            }
            if(!preg_match("/^[a-zA-Z -]+$/i", $_POST['lname'])){
                $lname_error = "Only Letters, Whitespace and hyphens Allowed.";
            }
            if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i", $_POST['email'])){
                $email_error = "Only Letters, Whitespace and hyphens Allowed.";
            }
            if(!preg_match("/\+?([0-9]{2})-?([0-9]{3})-?([0-9]{6,7})$/i", $_POST['number'])){
                $number_error = "please start phone number with country code";
            }
            if($count > 0){
                $relGen_error = "<div class='alert alert-success' role='alert'>Beneficiary Details exist already in our Database.</div>";
            }
            if(strlen($number) < 11){
                $number_error = "Phone number entered invalid";
            }      
        }
        if($fname_error == "" && $lname_error == "" && $email_error == "" && $number_error == "" && $relations_error == "" && $relGen_error == ""){
            $fname = ucwords($_POST['fname']);
            $lname = ucwords($_POST['lname']);
            $uname = $fname;
            $email = $_POST['email'];
            $number = strval($_POST['number']);
            $relations = ucwords($_POST['relations']);
            $permission = "N";
            $edit_date = date("Y-m-d H:i:s");

            $pushQuery3 = "INSERT INTO users(`fname`, `lname`, `username`, `email`, `phone_number`, `relation`, `permission`, `parent_user`, `edit_date`) 
                                        VALUES('{$fname}', '{$lname}', '{$uname}', '{$email}', '{$number}', '{$relations}', '{$permission}', '{$p_user}','{$edit_date}')";
            if(isset($_GET['edit'])){
                $pushQuery3 = "UPDATE users SET `fname` = '{$fname}', `lname` = '{$lname}', `username` = '{$uname}', `email` = '{$email}', `phone_number` = '{$number}',
                                                 `relation` = '{$relations}', `permission` = '{$permission}',`parent_user`= '{$p_user}', `edit_date` = '{$edit_date}' WHERE `id` = '$edit_id'"; 
            }
            $db->query($pushQuery3);
            echo '<script>location.replace("relations.php");</script>';
        }
    }
?>