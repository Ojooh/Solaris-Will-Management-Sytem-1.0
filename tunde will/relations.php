<?php 
    require_once '../core/init.php';
    if(!is_logged_in()){
        login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/topbar.php';
    include 'includes/sidebar.php';

    $p_user = $user_data['id'];
    $fname_error = $lname_error = $email_error = $number_error = $relations_error = $relGen_error =  "";
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete_id = (int)$_GET['delete'];
        $delete_id = sanitize($delete_id);
        $table = "users";
        recycle($table, $delete_id);
        echo '<script>location.replace("relations.php");</script>';
    }
 
    if(isset($_GET['add']) || isset($_GET['edit'])){
        $fname = ((isset($_POST['fname']) && $_POST['fname'] != '')?sanitize($_POST['fname']):"");
        $lname = ((isset($_POST['lname']) && $_POST['lname'] != '')?sanitize($_POST['lname']):"");
        $email = ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):"");
        $number = ((isset($_POST['number']) && $_POST['number'] != '')?sanitize($_POST['number']):"");
        $relations = ((isset($_POST['relations']) && $_POST['relations'] != '')?sanitize($_POST['relations']):"");
        if(isset($_GET['edit']) && !empty($_GET['edit'])){
            $edit_id = (int)$_GET['edit'];
            $edit_id = sanitize($edit_id);
            $relationsEditQuery = $db->query("SELECT * FROM users WHERE id = '{$edit_id}' AND deleted = 0");
            $relationsEdit = mysqli_fetch_assoc($relationsEditQuery);
            $fname = ((isset($_POST['fname']) && $_POST['fname'] != '')?sanitize($_POST['fname']):$relationsEdit['fname']);
            $lname = ((isset($_POST['lname']) && $_POST['lname'] != '')?sanitize($_POST['lname']):$relationsEdit['lname']);
            $email = ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):$relationsEdit['email']);
            $number = ((isset($_POST['number']) && $_POST['number'] != '')?sanitize($_POST['number']):$relationsEdit['phone_number']);
            $relations = ((isset($_POST['relations']) && $_POST['relations'] != '')?sanitize($_POST['relations']):$relationsEdit['relation']);
        }
        include 'formProcessing/relationsFormSubmitted.php';
?>

      
          <!--==========================
            Main Content
          ============================-->
          <div class="content">
              <main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-user-friends"></i> Beneficiaries</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="relations.php"><i class="fas fa-user-friends"></i> Beneficiaries</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?=((isset($_GET['edit']))?'<i class="fas fa-user-edit"></i> Edit Beneficiaries':'<i class="fas fa-user-plus"></i> Add Beneficiaries'); ?>
                                    </li>
                                </ol>
                        </div>

                        <!--==========================
                            Form Content
                        ============================-->
                        <div class="col-lg-12">
                        <div class="col-md-12 mb-3 text-center text-danger"><?= $relGen_error; ?></div>
                            <form action="relations.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'?add=1'); ?>" class="form-horizontal" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="First Name">First Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname" value = "<?= $fname;?>"placeholder="Enter your First Name Here">
                                        <div class="text-center text-danger">
                                            <?= $fname_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="Last Name">Last Name</label>
                                        <input type="text" class="form-control" id="lname" name="lname" value = "<?= $lname;?>"placeholder="Enter your Last Name Here">
                                        <div class="text-center text-danger">
                                            <?= $lname_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="Email Address">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" value = "<?= $email;?>"placeholder="Enter your Email Address Here">
                                        <div class="text-center text-danger">
                                            <?= $email_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="Phone Number">Phone Number</label>
                                        <input type="tel" class="form-control" id="number" name="number" value = "<?= $number;?>" placeholder="Enter your Phone Number Here">
                                        <small id="emailHelp" class="form-text text-muted">Preferably your WhatsApp Number</small>
                                        <div class="text-center text-danger">
                                            <?= $number_error; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!-- <div class="form-group col-md-6">
                                        <label for="Password">Password</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="password" class="form-control" id="password" name="password" value = "<?= $password;?>" placeholder="Enter a Password">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping" ><i toggle="#password" class="fas fa-eye  toggle-password"></i></span>
                                            </div>
                                        </div>
                                        <div class="text-center text-danger">
                                             //$password_error; 
                                        </div>
                                    </div> -->
                                
                                    <div class="form-group col-md-6">
                                        <label for="Relation to Beneficiary">Relation to Beneficiary</label>
                                        <input type="text" class="form-control" id="relations" name="relations" value = "<?= $relations;?>" placeholder="Enter Beneficiaries Relation to you">
                                        <div class="text-center text-danger">
                                            <?= $relations_error; ?>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><?=((isset($_GET['edit']))?"EDIT":"ADD"); ?></button>                        
                                <a href="relations.php" class="btn btn-outline-primary">Cancel</a>
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
        $relationsQuery = $db->query("SELECT * FROM users WHERE `deleted` = 0 AND `parent_user` = '{$p_user}' ORDER BY fname ");
        $relation = mysqli_fetch_assoc($relationsQuery);
        $a = 1;

        //to give access to will
      if(isset($_GET['friend'])){
        $id = (int)$_GET['id'];
        $friend = (int)$_GET['friend'];
        if($friend == 1){
            $password = encrypt($id);
            $hashed = password_hash($password,PASSWORD_DEFAULT);
            $sequel = "UPDATE users SET `permission` = 'F', `allowed` = '{$friend}', `password` = '{$hashed}', `pass` = '{$password}' WHERE `id` = '{$id}' AND `deleted` = 0";
        }else{
            $sequel = "UPDATE users SET `permission` = 'N', `allowed` = '{$friend}' , `password` = '', `pass` = '' WHERE `id` = '{$id}' AND `deleted` = 0";
        }    
        $db->query($sequel);
        echo '<script>location.replace("relations.php");</script>';
      }

    

?>
        <!--==========================
            Main Content
          ============================-->
          <div class="content">
              <main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-user-friends"></i> Beneficiaries</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"active" aria-current="page"><i class="fas fa-user-friends"></i> Beneficiaries</li>
                                </ol>
                                <a href="relations.php?add=1" class="btn btn-outline-primary">Add New Beneficiary</a>
                        </div>
                        <!--==========================
                            Beneficiary Table Content
                        ============================-->
                        <div class="col-lg-12 mt-4">
                        <?php if($relation === null): ?>
                                <div class="text-danger text-center mt-5">
                                    NO BENEFICIARIES HAVE BEEN SET!
                                </div>
                            <?php else: ?>
                                    
                                    <table class="table table-hover table-bordered bg-mattWhite mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/N</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Relation</th>
                                                <th scope="col">Contact Details</th>
                                                <th scope="col">Allow</th>
                                                <th scope="col">Join Date</th>
                                                <th scope="col">Edit Date</th>
                                                <th scope="col">Edit/Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php  
                                                    foreach($relationsQuery as $rel):
                                                        $link = "mailto:".$rel['email'];
                                             ?>
                                                <tr>
                                                    <th scope="row"><?= $a; ?></th>
                                                    <td><?= $rel['fname']." ".$rel['lname']; ?></td>
                                                    <td><?= $rel['relation'] ?></td>
                                                    <td>
                                                        <?= "<a href = '".$link."'>".$rel['email']."</a>"."<br> ".$rel['phone_number']; ?>
                                                    </td>
                                                    <td>
                                                        <a href="relations.php?friend=<?=(($rel['allowed'] == 0)?'1':'0'); ?>&id=<?=$rel['id']; ?>" class="btn btn-xs btn-outline-primary">
                                                            <i class="fas fa-user-<?= (($rel['allowed'] == 1)?'minus':'plus'); ?>"></i>
                                                        </a>
                                                        &nbsp <?= (($rel['allowed'] == 1)?'Remove Access':'Give Access'); ?>
                                                    </td>
                                                    <td><?= pretty_date($rel['join_date']); ?></td>
                                                    <td><?= (($rel['edit_date'] == '0000-00-00 00:00:00')?'Never':pretty_date($rel['edit_date'])); ?></td>
                                                    <td>
                                                        <a href="relations.php?edit=<?= $rel['id']; ?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="relations.php?delete=<?= $rel['id']; ?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            <?php $a++; endforeach; ?>

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