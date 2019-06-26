<?php
    if(isset($_POST) && !empty($_POST)){
        $email = sanitize($_POST['email']);
        $uname = ucwords($_POST['uname']);
        $emailCheckQuery = $db->query("SELECT * FROM users WHERE `email` = '{$email}' AND `parent_user` = 0");
        $unameCheckQuery = $db->query("SELECT * FROM users WHERE `email` = '{$uname}'");
        

        $countemail = mysqli_num_rows($emailCheckQuery);
        $countuname = mysqli_num_rows($unameCheckQuery);
        if(empty($_POST['fname'])){
            $fname_error = "This field is Required.";
        }else{
            if(!preg_match("/^[a-zA-Z(), ]+$/i", $_POST['fname'])){
                $fname_error = "Only Letters And WhiteSpace Allowed.";
            }
        }
        if(empty($_POST['lname'])){
            $lname_error = "This field is Required.";
        }else{
            if(!preg_match("/^[a-zA-Z(), ]+$/i", $_POST['lname'])){
                $lname_error = "Only Letters And WhiteSpace Allowed.";
            }
        }
        if(empty($_POST['birthday'])){
            $bday_error = "This field is Required.";
        }
        if(empty($_POST['gender'])){
            $gender_error = "This field is Required.";
        }
        if(empty($_POST['married'])){
            $married_error = "This field is Required.";
        }
        
        if(empty($_POST['noc'])){
            $_POST['noc'] = 0;
        }
        if(empty($_POST['email'])){
            $email_error = "This field is Required.";
        }else{
            if($countemail > 0){
                $email_error = "This email exist in our database already.";
            }
        }
        if(empty($_POST['phone'])){
            $phone_error = "This field is Required.";
        }else{
            if(!preg_match("/^234[0-9]{11}/", $_POST['phone'])){
                $phone_error = "Only numbers And plus Allowed.";
            }
        }
        if(empty($_POST['uname'])){
            $uname_error = "This field is Required.";
        }else{
            if(!preg_match("/^[a-zA-Z(), ]+$/i", $_POST['uname'])){
                $uname_error = "Only Letters And WhiteSpace Allowed.";
            }
            if($countuname > 0){
                $uname_error = "This name exist in our database already.";
            }
        }
        if(empty($_POST['password'])){
            $password_error = "This field is Required.";
        }     
        if(!preg_match("/\A[\w .,!()`,-]+\z/", $_POST['occupation'])){
                $occ_error = "Only Letters, Brackets, Comma, HyphenAnd WhiteSpace Allowed.";
        }
        if($fname_error == "" && $lname_error == "" && $bday_error == "" && $gender_error == "" && $occ_error == "" && $noc_error == "" &&  $email_error == "" && $phone_error == "" && $uname_error == "" && $password_error == ""&& $married_error == ""){
            $fname = ucwords(sanitize($_POST['fname']));
            $lname = ucwords(sanitize($_POST['lname']));
            $birthday = sanitize($_POST['birthday']);
            $conc = explode("/", $birthday);
            $d = $conc[0];
            $m = $conc[1];
            $y = $conc[2];
            $dob = $y."-".$m."-".$d;
            $sex = strtoupper(sanitize($_POST['gender']));
            $occupation = ucwords(sanitize($_POST['occupation']));
            $married = sanitize($_POST['married']);
            $noc = sanitize($_POST['noc']);
            $email = sanitize($_POST['email']);
            $number = sanitize($_POST['phone']);
            $uname = ucwords(sanitize($_POST['uname']));
            $password = sanitize($_POST['password']);
            $hashedentry = password_hash($password,PASSWORD_DEFAULT);
            $relation = "Owner";
            $permission = "O";

            $pushQuery9 = "INSERT INTO users(`fname`, `lname`, `username`, `password`, `email`, `phone_number`, `relation`, `permission`) 
                           VALUES('{$fname}', '{$lname}', '{$uname}', '{$hashedentry}', '{$email}', '{$number}', '{$relation}', '{$permission}')";
            $db->query($pushQuery9);
            $last_id = mysqli_insert_id($db);
            $pushQuery10 = "INSERT INTO owners(`name`, `dob`, `sex`, `occupation`, `marital_status`, `children_no`) 
                           VALUES('{$last_id}', '{$dob}', '{$sex}', '{$occupation}', '{$married}', '{$noc}')";
            $db->query($pushQuery10);
            echo '<script>location.replace("/will/tunde will");</script>';

        }
                    
    }
?>