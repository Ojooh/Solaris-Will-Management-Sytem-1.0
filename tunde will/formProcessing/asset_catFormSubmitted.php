<?php
    if(isset($_POST) && !empty($_POST)){
        $category = ucwords($_POST['category']);
        $catCheckQuery = $db->query("SELECT * FROM asset_category WHERE `category` = '{$category}'"); 
        if(isset($_GET['edit'])){
            $catCheckQuery = $db->query("SELECT * FROM asset_category WHERE category = '{$category}' AND `id` != '$edit_id'");
        }
        $count = mysqli_num_rows($catCheckQuery);

        if(empty($_POST['category'])){
            $assetcat_error = "This field is Required.";
        }else{
            if(!preg_match("/^[a-zA-Z(), ]+$/i", $_POST['category'])){
                $assetcat_error = "Only Letters And WhiteSpace Allowed.";
            }

            if($count > 0){
                $assetcat_error = "Category exist already.";
            }
        }
        
        if($assetcat_error == ""){
            $category = sanitize(ucwords($_POST['category']));
            $group_id = create_group();
            $pushQuery1 = "INSERT INTO asset_category(`group_id`, `category`) VALUES('{$group_id}', '{$category}')";
            if(isset($_GET['edit'])){
                $pushQuery1 = "UPDATE asset_category SET `category` = '{$category}' WHERE `id` = '$edit_id'";
            }
            $db->query($pushQuery1);
            echo '<script>location.replace("asset_cat.php");</script>';
        }
    }
?>