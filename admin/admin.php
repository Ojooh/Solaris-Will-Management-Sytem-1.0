<?php 
    require_once '../core/init.php';
    if(!is_logged_in_admin()){
        permission_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/topbar.php';
    include 'includes/sidebar.php';

    $p_user = $user_data1['id'];
    $fname_error = $lname_error = $email_error = $number_error = $title_error = $username_error = $password_error = $confirm_error = "";
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete_id = (int)$_GET['delete'];
        $delete_id = sanitize($delete_id);
        $db->query("DELETE FROM users WHERE `id` = '{$delete_id}'");
        echo '<script>location.replace("admin.php");</script>';
    }
 
    if(isset($_GET['add']) || isset($_GET['edit'])){
        if(!has_permission()){
            permission_error_redirect();
        }
        $fname = ((isset($_POST['fname']) && $_POST['fname'] != '')?sanitize($_POST['fname']):"");
        $lname = ((isset($_POST['lname']) && $_POST['lname'] != '')?sanitize($_POST['lname']):"");
        $email = ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):"");
        $number = ((isset($_POST['number']) && $_POST['number'] != '')?sanitize($_POST['number']):"");
        $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):"");
        $username = ((isset($_POST['username']) && $_POST['username'] != '')?sanitize($_POST['username']):"");
        $password = ((isset($_POST['password']) && $_POST['password'] != '')?sanitize($_POST['password']):"");
        $confirm = ((isset($_POST['confirm']) && $_POST['confirm'] != '')?sanitize($_POST['confirm']): '');
        if(isset($_GET['edit']) && !empty($_GET['edit'])){
            $edit_id = (int)$_GET['edit'];
            $edit_id = sanitize($edit_id);
            $adminEditQuery = $db->query("SELECT * FROM users WHERE id = '{$edit_id}'");
            $adminEdit = mysqli_fetch_assoc($adminEditQuery);
            $fname = ((isset($_POST['fname']) && $_POST['fname'] != '')?sanitize($_POST['fname']):$adminEdit['fname']);
            $lname = ((isset($_POST['lname']) && $_POST['lname'] != '')?sanitize($_POST['lname']):$adminEdit['lname']);
            $email = ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):$adminEdit['email']);
            $number = ((isset($_POST['number']) && $_POST['number'] != '')?sanitize($_POST['number']):$adminEdit['phone_number']);
            $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):$adminEdit['relation']);
            $username = ((isset($_POST['username']) && $_POST['username'] != '')?sanitize($_POST['username']):$adminEdit['username']);
            $password = ((isset($_POST['password']) && $_POST['password'] != '')?sanitize($_POST['password']): '');
            $confirm = ((isset($_POST['confirm']) && $_POST['confirm'] != '')?sanitize($_POST['confirm']): '');
            
        }
        include 'formProcessing/adminFormSubmitted.php';
?>

      
          <!--==========================
            Main Content
          ============================-->
          <div class="content">
              <main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-user-shield"></i> Administrators</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="admin.php"><i class="fas fa-user-shield"></i> Administrators</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?=((isset($_GET['edit']))?'<i class="fas fa-user-edit"></i> Edit Administrator':'<i class="fas fa-user-plus"></i> Add An Admnistrator'); ?>
                                    </li>
                                </ol>
                        </div>

                        <!--==========================
                            Form Content
                        ============================-->
                        <div class="col-lg-12">
                            <form action="admin.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'?add=1'); ?>" class="form-horizontal" method="post">
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
                                    <div class="form-group col-md-3">
                                        <label for="Title">Title</label>
                                        <select class="form-control" id="title" name="title">
                                            <option disabled="disabled" selected="selected">title</option>
                                            <option value="Admin-A" <?= (($title == "Admin")?' selected':''); ?>>Administrator, Editor</option>
                                            <option value="Developer-S" <?= (($title == "Developer")?' selected':''); ?>>Super User, Developer</option>
                                        </select>
                                        <div class="text-danger">
                                            <?= $title_error; ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="Username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value = "<?= $username;?>" placeholder="Enter a username">
                                        <div class="text-center text-danger">
                                            <?= $username_error; ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
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
                                    <div class="form-group col-md-3">
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
                                    
                                </div>
                                <button type="submit" class="btn btn-primary"><?=((isset($_GET['edit']))?"EDIT":"ADD"); ?></button>                        
                                <a href="admin.php" class="btn btn-outline-primary">Cancel</a>
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
        //fetch query
        $adminsQuery = $db->query("SELECT * FROM users WHERE `permission` = 'S' OR `permission` = 'A' ORDER BY fname ");
        $admins = mysqli_fetch_assoc($adminsQuery);
        $ad = 1;

?>
        <!--==========================
            Main Content
          ============================-->
          <div class="content">
              <main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-user-shield"></i> Administrators</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"active" aria-current="page"><i class="fas fa-user-shield"></i> Administrators</li>
                                </ol>
                            <?= (($user_data1['permission'] == "S")?'<a href="admin.php?add=1" class="btn btn-outline-primary">Add New Admin</a>': ''); ?>
                                
                        </div>
                        <!--==========================
                            Beneficiary Table Content
                        ============================-->
                        <div class="col-lg-12 mt-4">
                        <?php if($admins === null): ?>
                                <div class="text-danger text-center mt-5">
                                    NO ADMINISTRATORS HAVE BEEN SET!
                                </div>
                            <?php else: ?>
                                    
                                    <table class="table table-hover table-bordered bg-mattWhite mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/N</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Contact Details</th>
                                                <th scope="col">Join Date</th>
                                                <th scope="col">Last Login Date</th>
                                                <?php if($user_data1['permission'] == "S"): ?>
                                                <th scope="col">Status</th>
                                                <?php endif; ?>
                                                <th scope="col">Edit/Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php  
                                                    foreach($adminsQuery as $admin):
                                                        $link = "mailto:".$admin['email'];
                                                        $statz = "users-".$admin['id'];
                                             ?>
                                                <tr>
                                                    <th scope="row"><?= $ad; ?></th>

                                                    <td>
                                                        <?= $admin['fname']." ".$admin['lname']; ?>
                                                    </td>

                                                    <td>
                                                        <?= (($admin['relation'] == "Admin")?'Administrator':'Developer') ?>
                                                    </td>

                                                    <td>
                                                        <?= "<a href = '".$link."'>".$admin['email']."</a>"."<br> ".$admin['phone_number']; ?>
                                                    </td>

                                                    <td>
                                                        <?= pretty_date($admin['join_date']); ?>
                                                    </td>

                                                    <td>
                                                        <?= (($admin['last_login'] == '0000-00-00 00:00:00')?'Never':pretty_date($admin['last_login'])); ?>
                                                    </td>

                                                <?php if($user_data1['permission'] == "S" && $admin['id'] != 1): ?>
                                                    <td>
                                                        <?= (($admin['deleted'] == 0)?
                                                            '<div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="customSwitch'.$admin['id'].'" value="'.$statz.'-1" onchange="deleteFunction(this.value)" checked> 
                                                                <label class="custom-control-label" for="customSwitch'.$admin['id'].'">Enabled</label>
                                                            </div>'
                                                            :
                                                            '<div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="customSwitch'.$admin['id']. '" value="'.$statz.'-0" onchange="deleteFunction(this.value)" >  
                                                                <label class="custom-control-label" for="customSwitch'.$admin['id'].'">Disabled</label>
                                                                
                                                            </div>');
                                                        ?>
                                                    </td>
                                                <?php endif; ?>
                                                    <td>
                                                    <?php if($admin['id'] != 1): ?>
                                                        <a href="admin.php?edit=<?= $admin['id']; ?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php endif; ?>
                                                    <?php if($admin['id'] != $user_data1['id'] && $admin['id'] != 1 && $user_data1['permission'] != "A"): ?>
                                                        <a href="admin.php?delete=<?= $admin['id']; ?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-trash-alt"></i></a>
                                                    <?php endif; ?>    
                                                    </td>
                                                </tr>
                                            <?php $ad++; endforeach; ?>

                                        </tbody>
                                    </table>
                                
                            <?php endif; ?>
                        </div>
                        <!-----Table End ------>

                    </div>
                </div>  
              </main>
          </div>
      </div>







<?php 
    }
    include 'includes/footer.php';

?> 