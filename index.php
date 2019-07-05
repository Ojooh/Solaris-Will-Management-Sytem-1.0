<?php 
    require_once 'core/init.php';
    include 'includes/head.php';

    $fname = ((isset($_POST['fname']) && $_POST['fname'] != '' )?sanitize($_POST['fname']):'');
    $lname = ((isset($_POST['lname']) && $_POST['lname'] != '' )?sanitize($_POST['lname']):'');
    $birthday = ((isset($_POST['birthday']) && $_POST['birthday'] != '' )?sanitize($_POST['birthday']):'');
    $gender = ((isset($_POST['gender']) && $_POST['gender'] != '' )?sanitize($_POST['gender']):'');
    $occupation = ((isset($_POST['occupation']) && $_POST['occupation'] != '' )?sanitize($_POST['occupation']):'');
    $married = ((isset($_POST['married']) && $_POST['married'] != '' )?sanitize($_POST['married']):'');
    $noc = ((isset($_POST['noc']) && $_POST['noc'] != '' )?sanitize($_POST['noc']):'');
    $email = ((isset($_POST['email']) && $_POST['email'] != '' )?sanitize($_POST['email']):'');
    $phone = ((isset($_POST['phone']) && $_POST['phone'] != '' )?sanitize($_POST['phone']):'');
    $uname = ((isset($_POST['uname']) && $_POST['uname'] != '' )?sanitize($_POST['uname']):'');
    $password = ((isset($_POST['password']) && $_POST['password'] != '' )?sanitize($_POST['password']):'');

    $fname_error = $lname_error = $bday_error = $gender_error = $occ_error = $married_error = $noc_error = $email_error = $phone_error = $uname_error = $password_error = "";

    include 'formProcessing/registerFormSubmitted.php';
?>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w960">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="First Name" name="fname" value="<?= $fname; ?>">
                        </div>
                        <div class="text-danger">
                            <?= $fname_error; ?>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Last Name" name="lname" value="<?= $lname; ?>">
                        </div>
                        <div class="text-danger">
                            <?= $lname_error; ?>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3 js-datepicker" type="text" placeholder="Birthdate" name="birthday" value="<?= $birthday; ?>">
                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                        </div>
                        <div class="text-danger">
                            <?= $bday_error; ?>
                        </div>

                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="gender" value="<?= $gender; ?>">
                                    <option disabled="disabled" selected="selected">Gender</option>
                                    <option value="M" <?= (($gender == "M")?' selected':''); ?>>Male</option>
                                    <option value="F" <?= (($gender == "F")?' selected':''); ?>>Female</option>
                                    <option value="O" <?= (($gender == "O")?' selected':''); ?>>Other</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="text-danger">
                            <?= $gender_error; ?>
                        </div>

                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Occupation" name="occupation" value="<?= $occupation; ?>">
                        </div>
                        <div class="text-danger">
                            <?= $occ_error; ?>
                        </div>

                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="married" value="<?= $married; ?>">
                                    <option disabled="disabled" selected="selected">Marrital Status</option>
                                    <option value="M" <?= (($married == "M")?' selected':''); ?>>Married</option>
                                    <option value="S" <?= (($married == "S")?' selected':''); ?>>Single</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="text-danger">
                            <?= $married_error; ?>
                        </div>

                        <div class="input-group">
                            <input class="input--style-3" type="number" placeholder="No. of Children" name="noc" value="<?= $noc; ?>" min="0">
                        </div>
                        <div class="text-danger">
                            <?= $noc_error; ?>
                        </div>

                        <div class="input-group">
                            <input class="input--style-3" type="email" placeholder="Email" name="email" value="<?= $email; ?>">
                        </div>
                        <div class="text-danger">
                            <?= $email_error; ?>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="tel" placeholder="Phone Number" name="phone" value="<?= $phone; ?>">
                        </div>
                        <div class="text-danger">
                            <?= $phone_error; ?>
                        </div>

                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="username" name="uname" value="<?= $uname; ?>">
                        </div>
                        <div class="text-danger">
                            <?= $uname_error; ?>
                        </div>

                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Password" name="password" value="<?= $password; ?>">
                        </div>
                        <div class="text-danger">
                            <?= $password_error; ?>
                        </div>

                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit">Register</button>
                            <a href="/will/tunde will/"><h5 class="float-right mt-5 little">Sign In -></h5></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php 
    include 'includes/footer.php';

?>
