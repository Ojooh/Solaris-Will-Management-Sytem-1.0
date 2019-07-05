<?php 
    require_once '../core/init.php';
    if(!is_logged_in_special()){
        login_error_redirect();
    }
    include 'includes/loginHead.php';

    //input variables
    $old = ((isset($_POST['old']) && $_POST['old'] != '')?sanitize($_POST['old']):"");
    $new = ((isset($_POST['new']) && $_POST['new'] != '')?sanitize($_POST['new']):"");
    $confirm = ((isset($_POST['confirm']) && $_POST['confirm'] != '')?sanitize($_POST['confirm']):"");

    //error_variables
    $old_error = $new_error = $confirm_error = "";

    //reset password
    if(isset($_GET['reset']) && !empty($_GET['reset'])){
        $reset_id = (int)$_GET['reset'];
        $reset_id = sanitize($reset_id);
        $resetQuery = $db->query("SELECT * FROM users WHERE `id` = '{$reset_id}' AND `deleted` = 0");
        $reset = mysqli_fetch_assoc($resetQuery);
        $old = ((isset($_POST['old']) && $_POST['old'] != '')?sanitize($_POST['old']):$reset['password']);
        $new = ((isset($_POST['new']) && $_POST['new'] != '')?sanitize($_POST['new']):"");
        $confirm = ((isset($_POST['confirm']) && $_POST['confirm'] != '')?sanitize($_POST['confirm']):"");
    }
        include 'formProcessing/changepasswordFormSubmitted.php';
?>

        <div id="change-password-form">
            <img src="../images/tunde will/avatar.png" class="avatar">
            <h3 class="chnage-password-title text-center mt-4">Change Passowrd </h3><hr class="deeper">
                    
                    <form action="change_password.php<?=((isset($_GET['reset']))?'?reset='.$reset_id:''); ?>" method="POST">
                    <div class="form-group">
                            <label for="Old Password">Old Password</label>
                            <div class="input-group flex-nowrap">
                                <input type="password" class="form-control" id="old" name="old" value="<?= $old;?>" placeholder="Enter a Old Password">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="addon-wrapping" ><i toggle="#old" class="fa fa-fw fa-eye toggle-password"></i></span>
                                    </div>
                            </div>
                            <div class="text-center text-danger">
                                <?= $old_error; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="New Password">New Password</label>
                            <div class="input-group flex-nowrap">
                                <input type="password" class="form-control" id="new" name="new" value="<?= $new;?>" placeholder="Enter New Password">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="addon-wrapping" ><i toggle="#new" class="fa fa-fw fa-eye toggle-password"></i></span>
                                    </div>
                            </div>
                            <div class="text-center text-danger">
                                <?= $new_error; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Confirm Password">Confirm Password</label>
                            <div class="input-group flex-nowrap">
                                <input type="password" class="form-control" id="confirm" name="confirm" value="<?= $confirm;?>" placeholder="Enter a Password">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="addon-wrapping" ><i toggle="#confirm" class="fa fa-fw fa-eye toggle-password"></i></span>
                                    </div>
                            </div>
                            <div class="text-center text-danger">
                                <?= $confirm_error; ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary biggi mb-4">Change</button>
                        </div>
                    </form>      
            </div>    
        </div>

<?php 
    include 'includes/footer.php';
?> 