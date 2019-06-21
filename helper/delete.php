<?php 
require_once '../core/init.php';
    $parameters = sanitize($_POST['parameters']);;

    $share = explode("-", $parameters);
    $table = $share[0];
    $id = $share[1];
    $value = $share[2];

    if($table == "assets"){
        $db->query("UPDATE $table SET `deleted` = '{$value}' WHERE `id` = '{$id}'");
    }else{
        $db->query("UPDATE owners SET `deleted` = '{$value}' WHERE `name` = '{$id}'");
        $db->query("UPDATE $table SET `deleted` = '{$value}' WHERE `id` = '{$id}' OR `parent_user` = '{$id}'");
    }

    

?>