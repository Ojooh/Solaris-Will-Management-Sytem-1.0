<?php 
    require_once '../core/init.php';
    if(!is_logged_in_admin()){
        permission_error_redirect();
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
        $fname_error = $lname_error = $email_error = $number_error = $uname_error = $password_error = $confirm_error = $photo_error = "";
        $fname = ((isset($_POST['fname']) && $_POST['fname'] != '')?sanitize($_POST['fname']):$profileEdit['fname']);
        $lname = ((isset($_POST['lname']) && $_POST['lname'] != '')?sanitize($_POST['lname']):$profileEdit['lname']);
        $email = ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):$profileEdit['email']);
        $number = ((isset($_POST['number']) && $_POST['number'] != '')?sanitize($_POST['number']):$profileEdit['phone_number']);
        $uname = ((isset($_POST['uname']) && $_POST['uname'] != '' )?sanitize($_POST['uname']):$profileEdit['username']);
        $password = ((isset($_POST['password']) && $_POST['password'] != '' )?sanitize($_POST['password']):'');
        $confirm = ((isset($_POST['confirm']) && $_POST['confirm'] != '' )?sanitize($_POST['confirm']):'');
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
                                        <i class="fas fa-user-edit"></i> Edit <?= $user_data1['fname']; ?> Profile
                                    </li>
                                </ol>
                        </div>

                        <!--==========================
                            Form Content
                        ============================-->
                        <div class="col-lg-12">
                            <form action="index.php?edit=<?= $edit_id; ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="First Name">First Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname" value = "<?= $fname;?>" placeholder="Enter your First Name Here">
                                        <div class="text-center text-danger">
                                            <?= $fname_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="Last Name">Last Name</label>
                                        <input type="text" class="form-control" id="lname" name="lname" value = "<?= $lname;?>"placeholder="Enter your Last Name Here">
                                        <div class="text-center text-danger">
                                            <?= $lname_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="Email Address">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" value = "<?= $email;?>"placeholder="Enter your Email Address Here">
                                        <div class="text-center text-danger">
                                            <?= $email_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="Phone Number">Phone Number</label>
                                        <input type="tel" class="form-control" id="number" name="number" value = "<?= $number;?>" placeholder="Enter your Phone Number Here">
                                        <small id="emailHelp" class="form-text text-muted">Preferably your WhatsApp Number</small>
                                        <div class="text-center text-danger">
                                            <?= $number_error; ?>
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

                                    <div class="form-group col-md-4">
                                        <label for="Password">Password</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="password" class="form-control" id="password" name="password" value = "<?= $password;?>" placeholder="Enter a Password">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping" ><i toggle="#password" class="fas fa-eye  toggle-password"></i></span>
                                            </div>
                                        </div>
                                        <div class="text-center text-danger">
                                             <?= $password_error; ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Re-Enter Password">Re-Enter Password</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="password" class="form-control" id="confirm" name="confirm" value = "<?= $confirm; ?>" placeholder="Re-Enter Password">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping" ><i toggle="#confirm" class="fas fa-eye  toggle-password"></i></span>
                                            </div>
                                        </div>
                                        <div class="text-center text-danger">
                                             <?= $confirm_error; ?>
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
        $mainQuery = $db->query("SELECT * FROM users WHERE `id` = '{$user_data1['id']}' AND `deleted` = 0");
        $sqlQuery = "SELECT SUM(CASE WHEN `deleted` = 1 AND `parent_user` = 0 THEN 1 ELSE 0 END) AS deceased,
                            SUM(CASE WHEN `edit_date` BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW() AND `parent_user` = 0 THEN 1 ELSE 0 END) AS active,
                            SUM(CASE WHEN `parent_user` = 0 AND `permission` = 'O' THEN 1 ELSE 0 END) AS total,
                            SUM(CASE WHEN `deleted` = 0 AND `parent_user` = 0 AND `permission` = 'O' THEN 1 ELSE 0 END) AS total
                    FROM users";
        $userCalcQuery = $db->query($sqlQuery);
        $maxAssetsQuery = $db->query("SELECT item_name, users.fname, users.lname, dollars FROM assets INNER JOIN users ON assets.user_id = users.id WHERE  dollars = (SELECT MAX(dollars) from assets) AND assets.deleted = 0");
        $minAssetsQuery = $db->query("SELECT item_name, users.fname, users.lname, dollars FROM assets INNER JOIN users ON assets.user_id = users.id WHERE  dollars = (SELECT MIN(dollars) FROM assets) AND assets.deleted = 0");
        $totalassetsQuery = $db->query("SELECT COUNT(*) as little, SUM(dollars) as net FROM assets WHERE `deleted` = 0");
        $totalCalc = mysqli_fetch_assoc($totalassetsQuery);
        $userCalc = mysqli_fetch_assoc($userCalcQuery);
        $maxCalc = mysqli_fetch_assoc($maxAssetsQuery);
        $lowCalc = mysqli_fetch_assoc($minAssetsQuery);
        $main = mysqli_fetch_assoc($mainQuery);

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
                                    <li class="breadcrumb-item active text-white " aria-current="page"><i class="fas fa-user"></i> <?= $user_data1['fname']; ?> Profile</li>
                                </ol>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-dark" style="width: 24rem; height: 54rem;">
                                <img src="<?= (($main['image'] == "" )?'../images/tunde will/avatar.png': $main['image']); ?>" alt="..." class="mx-auto avatar2"> 
                                <div class="card-body">
                                    <h1 class="card-title display-5"><?= $main['fname']." ".$main['lname']; ?></h1>
                                    <p class="card-text">
                                        <?= (($main['permission'] == "S")?'Super User, Developer ': 'Administrator,Editor '); ?>  
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
                                    <div class="card text-white bg-dark" style="width: 24rem; height: 26rem;">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-users"></i> Number of Users</h5>
                                            <h1 class="card-text noa text-center display-1"><?= $userCalc['total']; ?></h1>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-users"></i> Number of Alive Users</h5>
                                            <h1 class="card-text noa text-center display-1"><?= $userCalc['total']; ?></h1>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="col-sm-12 col-md- col-lg-6 mb-4 container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card text-white bg-dark mb-2 col-12" style="height: 12rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fas fa-user-clock"></i> Number of Active Users (Month)</h5>
                                                    <h1 class="card-text noa text-center display-1"><?= $userCalc['active']; ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card text-white bg-dark mb-4 col-12" style="height: 12rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fas fa-user-injured"></i> Number of Deceased Users</h5>
                                                    <h1 class="card-text noa text-center display-1"><?= $userCalc['deceased']; ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md- col-lg-6 mb-4">
                                    <div class="card text-white bg-dark" style="width: 24rem; height: 26rem;">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-list-ul"></i> Total Asset Record</h5>
                                            <h1 class="card-text noa text-center display-1"><?= $totalCalc['little']; ?></h1>
                                            <h3 class="card-text text-center display-4"><?= money("$", $totalCalc['net']); ?></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md- col-lg-6 mb-4 container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card text-white bg-dark mb-2 col-12" style="height: 12rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fas fa-list-ul"></i> Highest Asset Entered</h5>
                                                    <p class="card-text text-left">Asset Name: <?= $maxCalc['item_name']; ?></p>
                                                    <p class="card-text text-left">Asset Owner: <?= $maxCalc['lname']." ". $maxCalc['fname']; ?></p>
                                                    <h3 class="card-text text-left">Asset Value: <?= money("$", $maxCalc['dollars']); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                        <div class="card text-white bg-dark mb-2 col-12" style="height: 12rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fas fa-list-ul"></i> Lowest Asset Entered</h5>
                                                    <p class="card-text text-left">Asset Name: <?= $lowCalc['item_name']; ?></p>
                                                    <p class="card-text text-left">Asset Owner: <?= $lowCalc['lname']." ". $lowCalc['fname']; ?></p>
                                                    <h3 class="card-text text-left">Asset Value: <?= money("$", $lowCalc['dollars']); ?></h3>
                                                </div>
                                            </div>
                                        </div>
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