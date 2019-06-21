<?php
    if(isset($_POST) && !empty($_POST)){

        if(empty($_POST['iname'])){
            $iname_error = "This field is Required.";
        }
        if(empty($_POST['asset_cat'])){
            $asset_cat_error = "This field is Required.";
        }
        if(empty($_POST['currency'])){
            $currency_error = "This field is Required.";
        }
        if(empty($_POST['value'])){
            $value_error = "This field is Required.";
        }
        if(empty($_POST['dollars'])){
            $dollars_error = "This field is Required.";
        }
        if(empty($_POST['description'])){
            $description_error = "This field is Required.";
        }
        if(!preg_match("/\A[\w .,!()`,-]+\z/", $_POST['iname'])){
            $iname_error = "Only Letters, Brackets, Comma, HyphenAnd WhiteSpace Allowed.";
        }else{
            if($iname_error == "" && $asset_cat_error == "" && $currency_error == "" && $value_error == "" && $description_error == ""){
                for($i = 1; $i <= $_POST['quantity']; $i++){
                    $grp = explode(",", $_POST['asset_cat']);
                    $grp_id = $grp[0];
                    $grp_ref = $grp[1];
                    $asset_no = create_refNumber($grp_ref);
                    $uid = $p_user;
                    $asset_cat = sanitize($grp_id);
                    $iname = sanitize(ucwords($_POST['iname']));
                    $description = sanitize(ucwords($_POST['description']));
                    $split = explode(",", sanitize($_POST['currency']));
                    $currency_id = $split[0];
                    $currency_rate = (double)$split[1];
                    $initial_value = (double)sanitize($_POST['value']);
                    $dollars = $initial_value * $currency_rate;
                    $edit_date = date("Y-m-d H:i:s");
    
                    
                if(isset($_GET['edit']) && $_POST['quantity'] <= 1){
                    $pushQuery4 = "UPDATE assets SET `user_id` = '{$uid}', `asset_cat` = '{$asset_cat}', `item_name` = '{$iname}', `description` = '{$description}',
                                                     `currency` = '{$currency_id}', `edited_value` = '{$initial_value}', `dollars` = '{$dollars}', `edit_date` = '{$edit_date}' WHERE `id` = '$edit_id'"; 
                }else{
                    $pushQuery4 = "INSERT INTO assets(`asset_no`, `user_id`, `asset_cat`, `item_name`, `description`, `currency`, `initial_value`, `dollars`) 
                                            VALUES('{$asset_no}', '{$uid}', '{$asset_cat}', '{$iname}', '{$description}', '{$currency_id}', '{$initial_value}', '{$dollars}')";
                }
                $db->query($pushQuery4);
                echo '<script>location.replace("entry.php");</script>';    
                }

            }
        }
    }
?>