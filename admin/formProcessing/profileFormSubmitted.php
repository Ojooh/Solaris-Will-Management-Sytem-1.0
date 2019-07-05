<?php
    if(isset($_POST) && !empty($_POST)){
        $allowed = array('png','jpg','jpeg','gif');
        $photoName = array();
        $tmpLoc = array();
        $uploadUrl = array();

        
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
            if(!preg_match("/^[a-zA-Z-(), ]+$/i", $_POST['lname'])){
                $lname_error = "Only Letters And WhiteSpace Allowed.";
            }
        }
        if(empty($_POST['email'])){
            $email_error = "This field is Required.";
        }
        if(empty($_POST['number'])){
            $number_error = "";
        }else{
            if(!preg_match("/^\+?\d+$/", $_POST['number'])){
                $number_error = "Only numbers And plus Allowed.";
            }
        }
        if(empty($_POST['uname'])){
            $uname_error = "This field is Required.";
        }else{
            if(!preg_match("/^[a-zA-Z(), ]+$/i", $_POST['uname'])){
                $uname_error = "Only Letters And WhiteSpace Allowed.";
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
        if($_FILES['photo']['size'] == 0 && $_FILES['photo']['error'] == 4){
            $photo_error = "";
        }else{
            //var_dump($_FILES);
            $name = $_FILES['photo']['name'];
            $nameArray = explode('.',$name);
            $fileName = $nameArray[0];
            $fileExt = $nameArray[1];
            $mime = explode('/',$_FILES['photo']['type']);
            $mimeType = $mime[0];
            $mimeExt = $mime[1];
            $tmpLoc[] = $_FILES['photo']['tmp_name'];
            $fileSize = $_FILES['photo']['size'];
            $uploadName = md5(microtime()).'.'.$fileExt;
            $uploadPath[] = BASEURL.'images/profile_pic/admin/'.$uploadName;
            $dbPath = '/will/images/profile_pic/admin/'.$uploadName;
            
            //validation for file upload
            if($mimeType != 'image'){
                $photo_error = 'The file must be an image.';
            }
            //allowed file extensions
            if(!in_array($fileExt, $allowed)){
                $photo_error = 'Submitted file extension is not acceptable, the photo must be .png, .jpg, .jpeg or .gif.';
            }
            //allowed file size
            if ($fileSize >15000000){
                $photo_error = 'The files size must be under 10MB.';
            }
            //if fileExt = mimeExt
            if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg' )) {
                $photo_error = 'File extension does not match the file.';
            }
            
        }
        
    
        if($fname_error == "" && $lname_error == "" &&  $email_error == "" && $number_error == "" && $uname_error == "" && $photo_error == ""){
            $fname = ucwords(sanitize($_POST['fname']));
            $lname = ucwords(sanitize($_POST['lname']));
            $email = sanitize($_POST['email']);
            $number = sanitize($_POST['number']);
            $uname = ucwords(sanitize($_POST['uname']));
            $edit_date = date("Y-m-d H:i:s");

            if($_FILES['photo']['size'] != 0 && $_FILES['photo']['error'] == 0){
                $i = 0;
                move_uploaded_file($tmpLoc[$i],$uploadPath[$i]);
            }
            $encrypkey = ((empty($_POST['confirm']) && empty($_POST['password']))?$profileEdit['password']:password_hash($confirm,PASSWORD_DEFAULT));
            $pushQuery14 = "UPDATE users SET `fname` = '{$fname}', `lname` = '{$lname}', `username` = '{$uname}', `email` = '{$email}', `phone_number` = '{$number}',
                                                `image` = '{$dbPath}',`password`= '{$encrypkey}', `edit_date` = '{$edit_date}' WHERE `id` = '$edit_id'"; 
            $db->query($pushQuery14);
            echo '<script>location.replace("index.php");</script>';

        }

                    
    }
?>