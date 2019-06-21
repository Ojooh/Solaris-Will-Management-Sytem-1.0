<?php 
    require_once '../core/init.php';
    if(!is_logged_in_admin()){
        permission_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/topbar.php';
    include 'includes/sidebar.php';
        //fetch query
        $ownersQuery = $db->query("SELECT * FROM owners INNER JOIN users ON owners.name = users.id ORDER BY `name`");
        $owners = mysqli_fetch_assoc($ownersQuery);
        $b = 1;

?>
        <!--==========================
            Main Content
          ============================-->
          <div class="content"> 
              <main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-user-friends"></i> Users</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"active" aria-current="page"><i class="fas fa-user-friends"></i> Users</li>
                                </ol>
                        </div>
                        <!--==========================
                            Beneficiary Table Content
                        ============================-->
                        <div class="col-lg-12 mt-4">
                        <?php if($owners === null): ?>
                                <div class="text-danger text-center mt-5">
                                    NO USERS HAVE REGISTERED YET!
                                </div>
                            <?php else: ?>
                                    <table class="table table-hover bg-mattWhite mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/N</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date of birth</th>
                                                <th scope="col">Details</th>
                                                <th scope="col">Net Worth</th>
                                                <th scope="col">Relations</th>
                                                <th scope="col">Removed</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                                    foreach($ownersQuery as $own):
                                                        $info_details = "owners-".$own['id'];
                                                        $relatives_details = "users-".$own['id']; 
                                            ?>
                                                <tr>
                                                    <th scope="row"><?= $b; ?></th>
                                                    <td><?= $own['lname']." ". $own['fname']; ?></td>
                                                    <td><?= pretty_date_only($own['dob']); ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailsModal" data-details="<?= $info_details; ?>" data-heading="<?= $own['lname']." ". $own['fname']; ?>">
                                                                INFO
                                                        </button>
                                                    </td>
                                                    <td><?= money("$", $own['net_worth']); ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailsModal" data-details="<?= $relatives_details; ?>" data-heading="<?= $own['lname']." ". $own['fname']; ?> Relatives">
                                                                Relations
                                                        </button>
                                                    </td>
                                                    <td>     
                                                <?= (($own['deleted'] == 0)?
                                                            '<div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="customSwitch'.$own['id'].'" value="'.$relatives_details.'-1" onchange="deleteFunction(this.value)" checked> 
                                                                <label class="custom-control-label" for="customSwitch'.$own['id'].'">Still Active</label>
                                                            </div>'
                                                            :
                                                            '<div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="customSwitch'.$own['id']. '" value="'.$relatives_details.'-0" onchange="deleteFunction(this.value)" >  
                                                                <label class="custom-control-label" for="customSwitch'.$own['id'].'">Not Acitve</label>
                                                                
                                                            </div>');
                                                ?>
                                                        
                                                    </td>
                                                    <? endif; ?>
                                                </tr>
                                            <?php $b++; endforeach; ?>

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
    include 'includes/footer.php';

?> 