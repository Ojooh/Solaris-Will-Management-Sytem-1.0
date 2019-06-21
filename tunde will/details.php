<?php 
    require_once '../core/init.php';
    if(!is_logged_in()){
        login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/topbar.php';
    include 'includes/sidebar.php';

        $details = ((isset($_GET['edit']))?(int)$_GET['edit']:(int)$_GET['details']);
        $details = sanitize($details);
        $urQuery = $db->query("SELECT * FROM users WHERE `id` = '{$details}' AND deleted = 0");
        $detailsQuery = $db->query("SELECT *, (SELECT SUM(assets.dollars) FROM  assets WHERE `beneficiary` = '{$details}') AS total FROM assets WHERE `beneficiary` = '{$details}' AND deleted = 0");
        $ur = mysqli_fetch_assoc($urQuery);
        $detail = mysqli_fetch_assoc($detailsQuery);
        $a = 1;

        if(isset($_GET['remove']) && !empty($_GET['remove'])){
            $remove_id = (int)$_GET['remove'];
            $edit_id = (int)$_GET['edit'];
            $remove_id = sanitize($remove_id);
            $edit_id = sanitize($edit_id);
            $db->query("UPDATE assets SET `beneficiary` = 0  WHERE `id` = '{$remove_id}' AND  deleted = 0");
            echo '<script>location.replace("details.php?edit=' .$edit_id. '");</script>';
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
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-chart-bar"></i> Asset Distribution</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="distribution.php"><i class="fas fa-chart-bar"></i> Asset Distribution</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?=((isset($_GET['edit']))?'<i class="fas fa-pencil-alt"></i> Edit Distributed Asset':'<i class="fas fa-info-circle"></i> Distributed Asset Details'); ?>
                                    </li>
                                </ol>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="container-fluid">
                                <div class="float-right">
                                    <h3>Total: <?= money("$", $detail['total']); ?></h3>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <h3><?= $ur['lname']." ". $ur['fname']. " - ". $ur['relation']; ?></h3>
                                    </div>

                                    <div class="col-md-9">
                                    <table class="table table-hover bg-mattWhite mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/N</th>
                                                <th scope="col">Asset Name</th>
                                                <th scope="col">Date Alloted</th>
                                                <th scope="col">Amount in Dollars</th>
                    <?= ((isset($_GET['edit']))?'<th scope="col">Remove</th>':''); ?>   
                                            </tr>
                                        </thead>
                                        <tbody>   
                                        <?php foreach($detailsQuery as $det): ?>
                                            <tr>
                                                <th scope="row"><?= $a; ?></th>
                                                <td><?= $det['item_name'];?></td>
                                                <td><?= pretty_date($det['date_alloted']); ?></td>
                                                <td><?= money("$", $det['dollars']); ?></td>
                   <?= ((isset($_GET['edit']))?'<td><a href="details.php?edit=' .$details. '&remove=' .$det['id']. '" class="btn btn-xs btn-outline-primary"><i class="fas fa-times"></i></a></td>':''); ?>
                                            </tr>
                                            <?php $a++; endforeach; ?>
                                        </tbody>
                                    </table>
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
    include 'includes/footer.php';

?> 