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
            if(!preg_match("/^[a-zA-Z(), ]+$/i", $_POST['lname'])){
                $lname_error = "Only Letters And WhiteSpace Allowed.";
            }
        }
        if(empty($_POST['dob'])){
            $dob_error = "This field is Required.";
        }
        if(empty($_POST['sex'])){
            $sex_error = "This field is Required.";
        }
        if(empty($_POST['ms'])){
            $ms_error = "This field is Required.";
        }
        
        if(empty($_POST['noc'])){
            $_POST['noc'] = 0;
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
        
        if(!preg_match("/\A[\w .,!()`,-]+\z/", $_POST['occupation'])){
                $occ_error = "Only Letters, Brackets, Comma, HyphenAnd WhiteSpace Allowed.";
        }

        if($_FILES['photo']['size'] == 0 && $_FILES['photo']['error'] == 4){
            $photo_error = "kjkjkg";
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
            $uploadPath[] = BASEURL.'images/profile_pic/owners/'.$uploadName;
            $dbPath = '/will/images/profile_pic/owners/'.$uploadName;
            
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
        

        if($fname_error == "" && $lname_error == "" && $dob_error == "" && $sex_error == "" && $occ_error == "" && $noc_error == "" &&  $email_error == "" && $number_error == "" && $uname_error == "" && $ms_error == ""){
            $fname = ucwords(sanitize($_POST['fname']));
            $lname = ucwords(sanitize($_POST['lname']));
            $dob = sanitize($_POST['dob']);
            $sex = strtoupper(sanitize($_POST['sex']));
            $occupation = ucwords(sanitize($_POST['occupation']));
            $married = sanitize($_POST['ms']);
            $noc = sanitize($_POST['noc']);
            $email = sanitize($_POST['email']);
            $number = sanitize($_POST['number']);
            $uname = ucwords(sanitize($_POST['uname']));

            if($_FILES['photo']['size'] != 0 && $_FILES['photo']['error'] == 0){
                $i = 0;
                move_uploaded_file($tmpLoc[$i],$uploadPath[$i]);
            }

            $pushQuery12 = "UPDATE users SET `fname` = '{$fname}', `lname` = '{$lname}', `username` = '{$uname}',
                                             `image` = '{$dbPath}', `email` = '{$email}', `phone_number` = '{$number}' WHERE `id` = '{$user_data['id']}'";
            $db->query($pushQuery12);
            $pushQuery13 = "UPDATE owners SET `dob` = '{$dob}', `sex` = '{$sex}', `occupation` = '{$occupation}', `marital_status` = '{$married}', 
                                              `children_no` = '{$noc}' WHERE `name` = '{$user_data['id']}'";
            $db->query($pushQuery13);
            echo '<script>location.replace("index.php");</script>';

        }
                    
    }
?>