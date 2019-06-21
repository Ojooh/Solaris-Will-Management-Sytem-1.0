<?php 
    require_once '../core/init.php';
    if(!is_logged_in()){
        login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/topbar.php';
    include 'includes/sidebar.php';

    //fetch query
    $lead_user = $user_data['id'];
    $benificiaryQuery = $db->query("SELECT * FROM users WHERE `deleted` = 0 AND `parent_user` = '{$lead_user}' ORDER BY `fname` ");
    $estatesQuery = $db->query("SELECT * FROM assets WHERE `deleted` = 0 AND `beneficiary` = 0 ORDER BY `item_name` ");
    $sql = "SELECT assets.id, assets.beneficiary, users.fname, users.lname, SUM(assets.dollars) AS total, COUNT(*) AS list 
            FROM assets INNER JOIN users ON assets.beneficiary = users.id WHERE assets.deleted != 1 AND assets.beneficiary != 0 GROUP BY beneficiary";
    $distributionQuery = $db->query($sql);
    $distribution = mysqli_fetch_assoc($distributionQuery);


    $benificiary_error =  $estates_error = "";
    $a = 1;
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete_id = (int)$_GET['delete'];
        $delete_id = sanitize($delete_id);
        $db->query("UPDATE assets SET `beneficiary` = 0 WHERE `beneficiary` = '{$delete_id}'");
        echo '<script>location.replace("distribution.php");</script>';
    }
    else{
        $benificiary = ((isset($_POST['benificiary']) && $_POST['benificiary'] != '')?sanitize($_POST['benificiary']): "");
        $estates = ((isset($_POST['estates']) && $_POST['estates'] != '')?sanitize($_POST['estates']): "");
    }

    include 'formProcessing/distributionFormSubmitted.php';
?>

      
      
          <!--==========================
            Main Content
          ============================-->
          <div class="content">
              <main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-chart-bar"></i> Asset Distribution</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-chart-bar"></i> Asset Distribution</li>
                                </ol>
                        </div>

                        <!--- form --->
                        <div class="col-md-12">
                            <form action="distribution.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" class="form-horizontal" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Beneficiary">Beneficiary</label>
                                        <select class="form-control" id="beneficiary" name="beneficiary">
                                                <option value="<?= (($benificiary == '')?'':''); ?>">- Choose a Beneficiary -</option>
                                            <?php while($beni = mysqli_fetch_assoc($benificiaryQuery)): ?>
                                                <option value="<?= $beni['id']; ?>"<?= (($benificiary == $beni['id'])?' selected':''); ?>><?= $beni['fname']." ".$beni['lname']." - ". $beni['relation']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                        <div class="text-danger">
                                            <?= $benificiary_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="Estates">Estates</label>
                                        <select class="form-control" id="estates" name="estates">
                                                <option value="<?= (($estates == '')?'':''); ?>">- Choose an Estates -</option>
                                            <?php while($est = mysqli_fetch_assoc($estatesQuery)): ?>
                                                <option value="<?= $est['id']; ?>"<?= (($estates == $est['id'])?' selected':''); ?>><?= $est['item_name']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                        <div class="text-danger">
                                            <?= $estates_error; ?>
                                        </div>
                                    </div>
                                </div>
                                  
                                <button type="submit" class="btn btn-primary">GIVE</button>
                            </form>

                            <!---- CATEGORY TABLE --->
                            <?php if($distribution === null): ?>
                                <div class="text-danger text-center mt-5">
                                    ASSETS HAVEN'T BEEN DISTRIBUTED YET!
                                </div>
                            <?php else: ?>
                                    <table class="table table-hover bg-mattWhite mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/N</th>
                                                <th scope="col">Beneficiary</th>
                                                <th scope="col">Estates Alloted</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Edit/Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php  foreach($distributionQuery as $dist): ?>
                                                <tr>
                                                    <th scope="row"><?= $a; ?></th>
                                                    <td><?= $dist['fname']. " ".$dist['lname']; ?></td>
                                                    <td><?= $dist['list']. " estate(s) alloted "; ?><a href="details.php?details=<?= $dist['beneficiary']; ?>" class="btn btn-primary">Details</a></td>
                                                    <td><?= money("$", $dist['total']); ?></td>
                                                    <td>
                                                        <a href="details.php?edit=<?= $dist['beneficiary']; ?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="distribution.php?delete=<?= $dist['beneficiary']; ?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            <?php $a++; endforeach; ?>

                                        </tbody>
                                    </table>
                                
                            <?php endif; ?>
                            
                                
                                
                        </div>
                    </div>
                </div>  
              </main>
          </div>
      </div>
<?php 
    include 'includes/footer.php';

?> 