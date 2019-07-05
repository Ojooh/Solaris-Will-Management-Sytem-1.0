<?php
    if(isset($_POST) && !empty($_POST)){
        if(empty($_POST['ref'])){
            $ref_error = "This field is Required.";
        }
        if(empty($_POST['owner'])){
            $owner_error = "This field is Required.";
        }
        if(empty($_POST['iname'])){
            $iname_error = "This field is Required.";
        }else{
            if(!preg_match("/\A[\w .,!()`,-]+\z/", $_POST['iname'])){
                $iname_error = "Only Letters, Brackets, Comma, HyphenAnd WhiteSpace Allowed.";
            }
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
        if($owner_error == "" && $iname_error == "" && $asset_cat_error == "" && $currency_error == "" && $value_error == "" && $description_error == ""){
                $asset_no = sanitize($_POST['ref']);
                $iname = sanitize(ucwords($_POST['iname']));
                $owner = sanitize($_POST['owner']);
                $grp = explode(",", $_POST['asset_cat']);
                $grp_id = $grp[0];
                $grp_ref = $grp[1];
                $asset_cat = sanitize($grp_id);
                $split = explode(",", sanitize($_POST['currency']));
                $currency_id = $split[0];
                $currency_rate = (double)$split[1];
                $initial_value = (double)sanitize($_POST['evalue']);
                $dollars = $initial_value * $currency_rate;
                $benificiary = sanitize($_POST['benificiary']);
                $description = sanitize(ucwords($_POST['description']));
                //$edit_date = date("Y-m-d H:i:s");

                
            if(isset($_GET['edit'])){
                $pushQuery4 = "UPDATE assets SET `asset_no` = '{$asset_no}',`user_id` = '{$owner}', `asset_cat` = '{$asset_cat}', `item_name` = '{$iname}', `description` = '{$description}',
                                                    `currency` = '{$currency_id}', `edited_value` = '{$initial_value}', `dollars` = '{$dollars}' WHERE `id` = '$edit_id'"; 
            }
            $db->query($pushQuery4);
            echo '<script>location.replace("entry.php");</script>';    
        }
    }
?>