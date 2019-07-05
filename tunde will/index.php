<?php 
    require_once '../core/init.php';
    if(!is_logged_in_friend()){
        login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/topbar.php';
    include 'includes/sidebar.php';

    if(isset($_GET['edit']) && !empty($_GET['edit'])){
        $edit_id = (int)$_GET['edit'];
        $edit_id = sanitize($edit_id);
        $profileEditQuery = $db->query("SELECT * FROM users WHERE `id` = '{$edit_id}' AND `deleted` = 0");
        $ownerproEditQuery = $db->query("SELECT * FROM owners WHERE `name` = '{$edit_id}' AND `deleted` = 0");
        $profileEdit = mysqli_fetch_assoc($profileEditQuery);
        $ownerproEdit = mysqli_fetch_assoc($ownerproEditQuery);
        $fname_error = $lname_error = $occ_error = $dob_error = $sex_error = $ms_error = $email_error = $number_error = $noc_error = $uname_error = $photo_error = "";
        $fname = ((isset($_POST['fname']) && $_POST['fname'] != '')?sanitize($_POST['fname']):$profileEdit['fname']);
        $lname = ((isset($_POST['lname']) && $_POST['lname'] != '')?sanitize($_POST['lname']):$profileEdit['lname']);
        $occupation = ((isset($_POST['occupation']) && $_POST['occupation'] != '')?sanitize($_POST['occupation']):$ownerproEdit ['occupation']);
        $dob = ((isset($_POST['dob']) && $_POST['dob'] != '')?sanitize($_POST['dob']):$ownerproEdit ['dob']);
        $sex = ((isset($_POST['sex']) && $_POST['sex'] != '')?sanitize($_POST['sex']):$ownerproEdit ['sex']);
        $ms = ((isset($_POST['ms']) && $_POST['ms'] != '')?sanitize($_POST['ms']):$ownerproEdit ['marital_status']);
        $email = ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):$profileEdit['email']);
        $number = ((isset($_POST['number']) && $_POST['number'] != '')?sanitize($_POST['number']):$profileEdit['phone_number']);
        $noc = ((isset($_POST['noc']) && $_POST['noc'] != '')?sanitize($_POST['noc']):$ownerproEdit ['children_no']);
        $uname = ((isset($_POST['uname']) && $_POST['uname'] != '' )?sanitize($_POST['uname']):$profileEdit['username']);
        $profile_image = (($profileEdit['image'] != '')?$profileEdit['image']:'');
        $dbPath = $profile_image;
        if(isset($_GET['delete_image'])){
            $del_id = (int)$_GET['edit'];
            $image_url = $_SERVER['DOCUMENT_ROOT'].$profileEdit['image'];
            unlink($image_url);
            //unset($profileEdit['image']);
            $db->query("UPDATE users SET image = '' WHERE id = '$edit_id'");
            echo '<script>location.replace("index.php?edit='.$edit_id.'");</script>';
         }

        include 'formProcessing/profileFormSubmitted.php';
?>

      
          <!--==========================
            Main Content
          ============================-->
          <div class="content">
              <main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-user-edit"></i> Edit Profile</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <i class="fas fa-user-edit"></i> Edit <?= $user_data['fname']; ?> Profile
                                    </li>
                                </ol>
                        </div>

                        <!--==========================
                            Form Content
                        ============================-->
                        <div class="col-lg-12">
                            <form action="index.php?edit='<?= $edit_id; ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="First Name">First Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname" value = "<?= $fname;?>" placeholder="Enter your First Name Here">
                                        <div class="text-center text-danger">
                                            <?= $fname_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="Last Name">Last Name</label>
                                        <input type="text" class="form-control" id="lname" name="lname" value = "<?= $lname;?>"placeholder="Enter your Last Name Here">
                                        <div class="text-center text-danger">
                                            <?= $lname_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="Last Name">Occupation</label>
                                        <input type="text" class="form-control" id="occupation" name="occupation" value = "<?= $occupation;?>"placeholder="What Do you do">
                                        <div class="text-center text-danger">
                                            <?= $lname_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="birthday" class="col-2 col-form-label">BirthDay</label>
                                        <input class="form-control" type="date" id="dob" name="dob" value="<?= $dob; ?>" placeholder="2016-08-09">
                                        <div class="text-center text-danger">
                                            <?= $dob_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="Gender">Gender</label>
                                        <select class="form-control" id="sex" name="sex">
                                            <option disabled="disabled" selected="selected">Gender</option>
                                            <option value="M" <?= (($sex == "M")?' selected':''); ?>>Male</option>
                                            <option value="F" <?= (($sex == "F")?' selected':''); ?>>Female</option>
                                            <option value="O" <?= (($sex == "O")?' selected':''); ?>>Other</option>
                                        </select>
                                        <div class="text-danger">
                                            <?= $sex_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="Marrital Status">Marrital Status</label>
                                        <select class="form-control" id="ms" name="ms">
                                            <option disabled="disabled" selected="selected">Marrital Status</option>
                                            <option value="M" <?= (($ms == "M")?' selected':''); ?>>Married</option>
                                            <option value="S" <?= (($ms == "S")?' selected':''); ?>>Single</option>
                                        </select>
                                        <div class="text-danger">
                                            <?= $ms_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="Email Address">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" value = "<?= $email;?>"placeholder="Enter your Email Address Here">
                                        <div class="text-center text-danger">
                                            <?= $email_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="Phone Number">Phone Number</label>
                                        <input type="tel" class="form-control" id="number" name="number" value = "<?= $number;?>" placeholder="Enter your Phone Number Here">
                                        <small id="emailHelp" class="form-text text-muted">Preferably your WhatsApp Number</small>
                                        <div class="text-center text-danger">
                                            <?= $number_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="No. of Children">No. of Children</label>
                                        <input type="number" class="form-control" name="noc" id="noc" value="<?= $noc;?>" placeholder="" min="0">
                                        <div class="text-center text-danger">
                                            <?= $noc_error; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="Username">Username</label>
                                        <input type="text" class="form-control" id="uname" name="uname"" value = "<?= $uname;?>" placeholder="Enter username">
                                        <div class="text-center text-danger">
                                            <?= $uname_error; ?>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-6">
                                    <?php if ($profile_image != ''):?>
                                        <img src="<?= $profile_image; ?>" alt="saved image" width="auto" height="150px"/><br>
                                        <a href="index.php?delete_image=1&edit=<?= $edit_id; ?>" class="text-danger">Delete Image</a>
                                    <?php else: ?>
                                        <label for="Profile Image">Profile Image</label>
                                        <div class="custom-file">
                                            <input id="photo" type="file" name="photo" class="custom-file-input">
                                            <label for="photo" class="custom-file-label text-truncate">Upload Profile Image</label>
                                        </div>
                                        <div class="text-center text-danger">
                                             <?= $photo_error; ?>
                                        </div>
                                    <?php endif; ?>
                                    </div>   
                                
                                    
                                </div>

                                <button type="submit" class="btn btn-primary">EDIT</button>                        
                                <a href="index.php" class="btn btn-outline-primary">Cancel</a>
                            </form>
                        </div>
                        <!---- Form Ending ---->

                    </div>
                </div>  
              </main>
          </div>
      </div>
<?php 
    }else{
        $mainQuery = $db->query("SELECT * FROM users WHERE `id` = '{$user_data['id']}' AND `deleted` = 0");
        $deemainQuery = $db->query("SELECT * FROM owners WHERE `name` = '{$user_data['id']}' AND `deleted` = 0");
        $assetsCalcQuery = $db->query("SELECT COUNT(*) AS ta, SUM(assets.dollars) AS td FROM assets WHERE `user_id` = '{$user_data['id']}' AND `deleted` = 0 ");
        $relationCalcQuery = $db->query("SELECT COUNT(*) AS tr, COUNT(CASE WHEN `permission`= 'F' THEN 1 END) AS tar FROM users WHERE `parent_user` = '{$user_data['id']}' AND `deleted` = 0");
        $assetsCalc = mysqli_fetch_assoc($assetsCalcQuery);
        $relationCalc = mysqli_fetch_assoc($relationCalcQuery);
        $main = mysqli_fetch_assoc($mainQuery);
        $deemain = mysqli_fetch_assoc($deemainQuery);

?>

      
      
          <!--==========================
            Main Content
          ============================-->
          <div class="content">
              <main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-user"></i> Profile Page</h3>
                                <ol class="breadcrumb text-white bg-dark">
                                    <li class="breadcrumb-item text-white "><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active text-white " aria-current="page"><i class="fas fa-user"></i> <?= $user_data['fname']; ?> Profile</li>
                                </ol>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-dark" style="width: 24rem; height: 40rem;">
                                <img src="<?= (($main['image'] == "" )?'../images/tunde will/avatar.png': $main['image']); ?>" alt="..." class="mx-auto avatar2"> 
                                <div class="card-body">
                                    <h3 class="card-title display-4"><?= $main['fname']." ".$main['lname']; ?></h3>
                                    <p class="card-text">
                                        <?= (($deemain['marital_status'] == "M")?'Married with ': 'Not Married with ').$deemain['children_no']. " Kid(s)"; ?>  
                                    </p>
                                    <p class="card-text">
                                        Email : <a href="mailto:<?= $main['email']; ?>" class="card-link"><?= $main['email']; ?></a>  
                                    </p>
                                    <p class="card-text">
                                        Phone Number : <?= $main['phone_number']; ?>  
                                    </p>
                                    <p class="card-text">
                                        <a href="index.php?edit=<?= $main['id']; ?>" class="card-link text-mattRed">Edit Profile...</a> 
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-8 container-fluid">
                            <div class="row">
                                <div class="col-sm-12 col-md- col-lg-6 mb-4">
                                    <div class="card text-white bg-dark" style="width: 24rem; height: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-list-ul"></i> Number of Assets</h5>
                                            <h1 class="card-text noa text-center display-1"><?= $assetsCalc['ta']; ?></h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md- col-lg-6 mb-4">
                                    <div class="card text-white bg-dark" style="width: 24rem; height: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-user-friends"></i> Number of Relations</h5>
                                            <h1 class="card-text noa text-center display-1"><?= $relationCalc['tr']; ?></h1>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md- col-lg-6 mb-4">
                                    <div class="card text-white bg-dark" style="width: 24rem; height: 20rem;">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-dollar-sign"></i> Asset Total</h5>
                                            <h1 class="card-text text-center display-4 mb-9"><?= money("$",$assetsCalc['td']); ?></h1>
                                            <div class="card-footer bg-transparent border-success">
                                                <p class="card-text text-mattRed">
                                                    Shows total amount of assets entered in Dollars.
                                                </p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md- col-lg-6 mb-4">
                                    <div class="card text-white bg-dark" style="width: 24rem; height: 20rem;">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-user-check"></i> Users Allowed</h5>
                                            <h1 class="card-text text-center display-2 mb-4"><?= $relationCalc['tar']; ?></h1>
                                            <div class="card-footer bg-transparent border-success">
                                                <p class="card-text text-mattRed">
                                                            Shows the number of user's allowed to view your will after death, this users will 
                                                            have an auto generated password that expires after first login.
                                                </p>
                                            </div>
    
                                        </div><i class="fas fa-user-check"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        

                        
                    </div>
                </div> 
            </main>
          </div>
      </div>
<?php 
    }
    include 'includes/footer.php';

?> 