<?php 
    require_once '../core/init.php';
    include 'includes/loginHead.php';
    $ownersQuery = $db->query("SELECT * FROM users WHERE `deleted` = 1 AND `parent_user` = 0 AND permission = 'O' ORDER BY `lname` ");
    $owners = ((isset($_POST['owners']) && $_POST['owners'] != '')?sanitize($_POST['owners']): "");
    if(!isset($_GET['friend']) && empty($_GET['friend'])){
?>

        <div id="login-form" class="login-form">
            <img src="../images/tunde will/avatar.png" class="avatar">
            <h3 class="login-title text-center">LOGIN </h3><hr class="deeper">
            <div class="col-lg-12">
                    <!-- <div class="text-danger mb-2"><p class="alert alert-danger text-center">A simple danger alert—check it out!</p></div> -->
                    <!--- state-form --->
                    <form id="state-form">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <select class="form-control" id="state" onchange="stateFunction(this.value)">
                                <option value="selected">- Select User State -</option>
                                <option value="alive">Alive</option>
                                <option value="deceased">Deceased</option>
                            </select>
                        </div>

                        <div id ="owners" class="form-group" style="display : none">
                            <label for="Owners">Owner</label>
                            <select class="form-control" id="owner" name="owner" onchange="ownersFunction(this.value)">
                                <option value="<?= (($owners == '')?'':''); ?>">- Select Username -</option>
                            <?php while($own = mysqli_fetch_assoc($ownersQuery)): ?>
                                <option value="<?= $own['id']; ?>"<?= (($owners == $own['id'])?' selected':''); ?>><?= $own['lname']." ".$own['fname']; ?></option>
                            <?php endwhile; ?>
                            </select>
                        </div>
                    </form>
                    <!--- owner/Admin login  Form --->
                    
                    <form id="oal">
                        <div id="login-errors" class="text-danger mb-2"></div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="Password">Password</label>
                            <div class="input-group flex-nowrap">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter a Password">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="addon-wrapping" ><i toggle="#password" class="fa fa-fw fa-eye toggle-password"></i></span>
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-outline-primary biggi" onclick="loginFunction()">Submit</button>
                        </div>
                    </form>      
            </div>    
        </div>

<?php 
    }else{
        $p_id = (int)$_GET['friend'];
        $p_id = sanitize($p_id);
        $friendQuery = $db->query("SELECT * FROM users WHERE `parent_user` = '{$p_id}' AND permission = 'F' AND `allowed` = 1 ORDER BY `lname` ");
        $a = 1;

        if(isset($_POST) && !empty($_POST)){
            $muid = $p_id;
            $fruid = $_POST['fruid'];
            $luids = $muid."-".$fruid;
            friendLogin($luids);
            echo'<script>alert("good to go ");</script>';
        }

?>

        <div id="friend-login-form" class="friend-login-form ">
            <img src="../images/tunde will/avatar.png" class="avatar">
            <div class="container-fluid">
                <div class="row">
                    <div class="friend-list float-left col-md-6">
                        <ol id="flist">
                        <?php foreach($friendQuery as $fd): ?>
                            <h5>
                                <li id="customlist-<?= $fd['id']; ?>" class="lit<?= $a; ?> text-info"><?= $fd['lname']." ". $fd['fname']; ?> 
                                        <i id="customicon<?= $fd['id']; ?>" class="fas fa-times"></i>
                                </li>
                            <h5>
                        <?php $a++; endforeach; ?>
                        </ol> 
                    </div>

                    <div id="friend-form" class="friend-form col-md-6">
                        <h3 class=" text-center">LOGIN </h3><hr class="deeper">
                        <form id="friend">
                            <div id="login-errors" class="text-danger mb-2"></div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="friend_username" name="friend_username" placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <div class="input-group flex-nowrap">
                                    <input type="password" class="form-control" id="friend_password" name="friend_password" placeholder="Enter a Password">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-wrapping" ><i toggle="#friend_password" class="fa fa-fw fa-eye toggle-password"></i></span>
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-outline-primary biggi" onclick="friendsLoginFunction()">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div id="proceed" class="proceed col-md-6" style="display : none">

                            <div class="col-lg-12">
                                <p class="friend-proceed">
                                    Here when button is clicked it will call javascript function and that function will call php function.
                                     This works fine. i. e. Database is connected and retrieved the result and dispalying the number of rows 
                                     in alert box. But i need to display the selected results in html table how to do this? pls help me.
                                </p>
                                <form action="login.php?friend=<?= $p_id; ?>" method="POST">
                                    <input type="hidden" id="fruid" name="fruid">
                                    <button type="submit" class="btn btn-primary biggi">PROCEED >>>></button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>





<?php 
    }
    include 'includes/footer.php';
?> 