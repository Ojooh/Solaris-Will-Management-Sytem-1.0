<?php
    if(isset($_POST) && !empty($_POST)){
        $currency_name = ucwords($_POST['currency_name']);
        $currency = strtoupper($_POST['currency']);
        $symbol = $_POST['symbol'];
        $rate = $_POST['rate'];

        $currCheckQuery = $db->query("SELECT * FROM currency WHERE `currency_name` = '{$currency_name}' AND  `currency` = '{$currency}'"); 
    if(isset($_GET['edit'])){
        $currCheckQuery = $db->query("SELECT * FROM currency WHERE `currency_name` = '{$currency_name}' AND  `currency` = '{$currency}' AND `id` != '$edit_id'");
    } 
    
    $count = mysqli_num_rows($currCheckQuery);

        if(empty($_POST['currency_name'])){
            $currency_name_error = "This field is Required.";
        }else{
            if(!preg_match("/^[a-zA-Z ]+$/i", $_POST['currency_name'])){
                $currency_name_error = "Only Letters And WhiteSpace Allowed.";
            }
        }
        if(empty($_POST['currency'])){
            $currency_error = "This field is Required.";
        }else{
            if(!preg_match("/^[A-Z]+$/i", $_POST['currency'])){
                $currency_error = "Only Capital Letters Allowed.";
            }
        }
        if(empty($_POST['symbol'])){
            $symbol_error = "This field is Required.";
        }
        if(empty($_POST['rate'])){
            $rate_error = "This field is Required.";
        }else{ 
            if(!preg_match("/^-?(?:\d+|\d*\.\d+)$/i", $_POST['rate'])){
                $currency_name_error = "Only Decimal numbers Allowed.";
            }  
        }
        if($count > 0){
            $currGen_error = "<div class='alert alert-success' role='alert'>Currency Details exist already in our Database.</div>";
        }
        if($currency_name_error == "" && $currency_error =="" && $symbol_error == "" && $rate_error == "" && $currGen_error == ""){
            $currency_name = sanitize(ucwords($_POST['currency_name']));
            $currency = sanitize(strtoupper($_POST['currency']));
            $symbol = sanitize($_POST['symbol']);
            $rate = sanitize($_POST['rate']);

            $pushQuery2 = "INSERT INTO currency(`currency_name`, `currency`, `symbol`, `convert_rate`) 
                                        VALUES('{$currency_name}', '{$currency}', '{$symbol}', '{$rate}')";
            if(isset($_GET['edit'])){
                $pushQuery2 = "UPDATE currency SET `currency_name` = '{$currency_name}', `currency` = '{$currency}', 
                                                    `symbol` = '{$symbol}', `convert_rate` = '{$rate}' WHERE `id` = '$edit_id'";
            }
            $db->query($pushQuery2);
            echo '<script>location.replace("currency.php");</script>';
        }
    }
?>