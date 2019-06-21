<?php
    if(isset($_POST) && !empty($_POST)){

        if(empty($_POST['beneficiary'])){
            $benificiary_error = "This field is Required.";
        }
        if(empty($_POST['estates'])){
            $estates_error = "This field is Required.";
        }else{
            if($benificiary_error == "" && $estates_error == ""){
                $benificiary = sanitize($_POST['beneficiary']);
                $estates = sanitize($_POST['estates']);
                $alloted_date = date("Y-m-d H:i:s");

                $pushQuery5 = "UPDATE assets SET `beneficiary` = '{$benificiary}', `date_alloted` = '{$alloted_date}' WHERE `id` = '$estates'";
                $db->query($pushQuery5);
                echo '<script>location.replace("distribution.php");</script>';
            }
        }
    }
?>