<?php 
require_once '../core/init.php';
    $details = sanitize($_POST['details']);;

    $divide = explode("-", $details);
    $table = $divide[0];
    $id = $divide[1];

    if($table == "assets"){
        $getItemsQuery = $db->query("SELECT * FROM {$table} WHERE `id` = '{$id}'");
        $get = mysqli_fetch_assoc($getItemsQuery);
        $html = '<div class="row">
                    <div class="col-md-6">
                        <div class="float-left text-info">
                            <h4>Entry Date:</h4><br>'
                                .pretty_date($get['entry_date']).  
                        '</div>
                    </div>

                    <div class="col-md-6">
                    <div class="float-left text-info">
                        <h4>Last Edit Date:</h4><br>'
                            .pretty_date($get['edit_date']).
                    '</div>
                    </div>
                </div>';
        echo $html;
    }
    if($table == "owners"){
        $getItemsQuery = $db->query("SELECT * FROM owners INNER JOIN users ON owners.name = users.id WHERE `id` = '{$id}' AND `name` = '{$id}'");
        $get = mysqli_fetch_assoc($getItemsQuery);
        $email = "mailto:".$get['email'];
        $reset = "/will/tunde will/change_password.php?reset=".$get['id'];
        $mar = (($get['marital_status'] == 0)?"Not Married with ":"Married with ");
        $kids = (($get['children_no'] == 0)?"No": $get['children_no']);
        $html = '<div class="row">
                    <div class="col-md-6">
                        <div class="float-left">
                            <h4>Personnal Information</h4><br>
                            <span class="text-info">'.$mar.$kids.'kid(s)</span><br>
                            <span class="text-info">Join Date: <br> '.pretty_date($get['join_date']).'</span><br>
                            <span class="text-info">Last Login: <br> '.pretty_date($get['last_login']).'</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="float-left">
                            <h4>Contact Information</h4><br>
                            <a href="'.$email.'">'.$get['email'].'</a><br>
                            <span class="text-info">Phone Number : '.$get['phone_number'].'</span><br>
                            <a href="'.$reset.'">Reset Passowrd</a>         
                        </div>
                    </div>
                </div>';
        echo $html;

    }
    if($table == "users"){
        $getItemsQuery = $db->query("SELECT * FROM users WHERE `parent_user` = '{$id}'");
        $html = "";
        while($get = mysqli_fetch_assoc($getItemsQuery)){
            $email = "mailto:".$get['email'];
            $html .= '<div class="">
            <div class="col-md-8">
                <div class="float-left">
                    <h4>'.$get['lname']." ". $get['fname'].'- </h4>'.$get['relation'].'<br>
                    <a href="'.$email.'">'.$get['email'].'</a><br>
                    <span class="text-info">'.$get['phone_number'].'</span><br>
                </div>
            </div>';
        }
        echo $html;
    }
    

?>