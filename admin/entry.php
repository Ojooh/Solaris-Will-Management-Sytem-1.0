<?php 
    require_once '../core/init.php';
    if(!is_logged_in_admin()){
        permission_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/topbar.php';
    include 'includes/sidebar.php';

    $p_user = $user_data1['id'];
    $ref_error = $owner_error = $iname_error = $asset_cat_error = $currency_error = $value_error = $description_error = $entGen_error =  "";
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete_id = (int)$_GET['delete'];
        $delete_id = sanitize($delete_id);
        $table = "assets";
        recycle($table, $delete_id);
        echo '<script>location.replace("entry.php");</script>';
    }
        
    if(isset($_GET['edit']) && !empty($_GET['edit'])){
        $edit_id = (int)$_GET['edit'];
        $edit_id = sanitize($edit_id);
        $entryEditQuery = $db->query("SELECT * FROM assets WHERE `id` = '{$edit_id}' AND `deleted` = 0");
        $asset_catQuery = $db->query("SELECT * FROM asset_category WHERE `deleted` = 0");
        $currencyQuery = $db->query("SELECT * FROM currency");
        $userQuery = $db->query("SELECT * FROM users");
        $beniQuery = $db->query("SELECT * FROM users WHERE parent_user != 0");
        $entryEdit = mysqli_fetch_assoc($entryEditQuery);
        $ref = ((isset($_POST['ref']) && $_POST['ref'] != '')?sanitize($_POST['ref']):$entryEdit['asset_no']);
        $owner = ((isset($_POST['owner']) && $_POST['owner'] != '')?sanitize($_POST['owner']):$entryEdit['user_id']);
        $iname = ((isset($_POST['iname']) && $_POST['iname'] != '')?sanitize($_POST['iname']):$entryEdit['item_name']);
        $asset_cat = ((isset($_POST['asset_cat']) && $_POST['asset_cat'] != '')?sanitize($_POST['asset_cat']):$entryEdit['asset_cat']);
        $currency = ((isset($_POST['currency']) && $_POST['currency'] != '')?sanitize($_POST['currency']):$entryEdit['currency']);
        $value = ((isset($_POST['value']) && $_POST['value'] != '')?sanitize($_POST['value']):$entryEdit['initial_value']);
        $evalue = ((isset($_POST['evalue']) && $_POST['evalue'] != '')?sanitize($_POST['evalue']):$entryEdit['edited_value']);
        $dollars = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):$entryEdit['dollars']);
        $benificiary = ((isset($_POST['benificiary']) && $_POST['benificiary'] != '')?sanitize($_POST['benificiary']):$entryEdit['beneficiary']);
        $description = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):$entryEdit['description']);
        
        
        include 'formProcessing/entrysFormSubmitted.php';
?>

      
          <!--==========================
            Main Content
          ============================-->
          <div class="content">
              <main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-list-ul"></i> Asset Entry</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="entry.php"><i class="fas fa-list-ul"></i> Asset Entry</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <i class="fas fa-pencil-alt"></i> Edit Asset
                                    </li>
                                </ol>
                        </div>

                        <!--==========================
                            Form Content
                        ============================-->
                        <div class="col-lg-12">
                        <div class="col-md-12 mb-3 text-center text-danger"><?= $entGen_error; ?></div>
                            <form action="entry.php?edit=<?= $edit_id; ?>" class="form-horizontal" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="Asset Number">Asset Number</label>
                                        <input type="text" class="form-control" id="ref" name="ref" value = "<?= $ref;?>">
                                        <div class="text-danger">
                                            <?= $ref_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="Item Name">Item Name</label>
                                        <input type="text" class="form-control" id="iname" name="iname" value = "<?= $iname;?>">
                                        <div class="text-danger">
                                            <?= $iname_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="owner">Owner</label>
                                        <select class="form-control" id="owner" name="owner">
                                                <option value="<?= (($owner == '')?'':''); ?>">- Choose a Category -</option>
                                            <?php while($ner = mysqli_fetch_assoc($userQuery)): ?>
                                                <option value="<?= $ner['id']; ?>"<?= (($owner == $ner['id'])?' selected':''); ?>><?= $ner['lname']." - ". $ner['fname']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                        <div class="text-danger">
                                            <?= $owner_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="Asset Category">Asset Category</label>
                                        <select class="form-control" id="asset_cat" name="asset_cat">
                                                <option value="<?= (($asset_cat == '')?'':''); ?>">- Choose a Category -</option>
                                            <?php while($ac = mysqli_fetch_assoc($asset_catQuery)): ?>
                                                <option value="<?= $ac['id'].",".$ac['group_id'];; ?>"<?= (($asset_cat == $ac['id'])?' selected':''); ?>><?= $ac['category']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                        <div class="text-danger">
                                            <?= $asset_cat_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="Currency">Currency</label>
                                        <select class="form-control" id="currency" name="currency">
                                                <option value="<?= (($currency == 0)?'':''); ?>">- Choose a Category -</option>
                                            <?php while($cure = mysqli_fetch_assoc($currencyQuery)): ?>
                                                <option value="<?= $cure['id'].",".$cure['convert_rate']; ?>"<?= (($currency == $cure['id'])?' selected':''); ?>><?= $cure['currency_name']." - ". $cure['currency'] .",".$cure['convert_rate'];; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                        <div class="text-danger">
                                            <?= $currency_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="Asset value">Asset Initial Value</label>
                                            <input type="number" class="form-control" id="value" name="value" value="<?= $value; ?>" step="0.00001" min="0">
                                            <div class="text-danger mb-2">
                                                <?= $value_error; ?>
                                            </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="Asset value">Asset Edited Value</label>
                                            <input type="number" class="form-control" id="value" name="evalue" value="<?= $evalue; ?>" step="0.00001" min="0">
                                            <div class="text-danger mb-2">
                                                <?= $value_error; ?>
                                            </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="beneficiary">Beneficiary</label>
                                        <select class="form-control" id="benificiary" name="benificiary">
                                                <option value="<?= (($benificiary == '')?'':''); ?>">- Choose a Category -</option>
                                            <?php while($ben = mysqli_fetch_assoc($beniQuery)): ?>
                                                <option value="<?= $ben['id']; ?>"<?= (($benificiary == $ben['id'])?' selected':''); ?>><?= $ben['lname']." - ". $ben['fname']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                        <div class="text-danger">
                                            <?= $owner_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="description">Asset Descritption:</label>
                                        <textarea id="description" name="description" class="form-control" placeholder="Further Details about Asset like Location, Color, Platenumber e.t.c" rows="6"><?= $description; ?></textarea>
                                        <div class="text-danger mb-2">
                                                <?= $description_error; ?>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><?=((isset($_GET['edit']))?"EDIT ASSET ":"ADD ASSET"); ?></button>                        
                                <a href="entry.php" class="btn btn-outline-primary">Cancel</a>
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
        $entrysQuery = $db->query("SELECT * FROM assets  ORDER BY `user_id`");
        $summaryQuery = $db->query("SELECT SUM(assets.dollars) AS total, COUNT(*) AS list, users.fname, users.lname FROM assets INNER JOIN users ON assets.user_id = users.id GROUP BY assets.user_id");
        $entrys = mysqli_fetch_assoc($entrysQuery);
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
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-list-ul"></i> Users Asset Entry</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"active" aria-current="page"><i class="fas fa-list-ul"></i> User Asset Entry</li>
                                </ol>
                        </div>
                        <!--==========================
                            Beneficiary Table Content
                        ============================-->
                        <div class="col-lg-12 mt-4">
                        <?php if($entrys === null): ?>
                                <div class="text-danger text-center mt-5">
                                    NO ASSETS HAVE BEEN SET USER!
                                </div>
                            <?php else: ?>
                                    <table class="table table-hover bg-mattWhite mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/N</th>
                                                <th scope="col">Asset Number</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Owner</th>
                                                <th scope="col">Asset Value</th>
                                                <th scope="col">Dollar Value</th>
                                                <th scope="col">Date Details</th>
                                                <th scope="col">Removed</th>
                                            <?= (($user_data1['permission'] == "S")?
                                                '<th scope="col">Edit/Delete</th>'
                                                    :
                                                '');
                                            ?>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php  
                                                    foreach($entrysQuery as $ents):
                                                        $cu_id = $ents['currency'];
                                                        $bid = $ents['user_id'];
                                                        $bd = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE `id` = '{$bid}'"));
                                                        $cu = mysqli_fetch_assoc($db->query("SELECT * FROM currency WHERE `id` = '{$cu_id}'"));
                                                        $date_details = "assets-".$ents['id'];
                                             ?>
                                                <tr>
                                                    <th scope="row"><?= $b; ?></th>
                                                    <td><?= $ents['asset_no']; ?></td>
                                                    <td><?= $ents['item_name']; ?></td>
                                                    <td><?= $bd['lname']." ". $bd['fname']; ?></td>
                                                    <td><?= money($cu['symbol'], (($ents['edited_value'] == 0)?$ents['initial_value']:$ents['edited_value'])); ?></td>
                                                    <td><?= money("$", $ents['dollars']); ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailsModal" data-details="<?= $date_details; ?>" data-heading="Date Details">
                                                                Details
                                                        </button>
                                                    </td>
                                                    <td>     
                                                <?= (($ents['deleted'] == 0)?
                                                            '<div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="customSwitch'.$ents['id'].'" value="'.$date_details.'-1" onchange="deleteFunction(this.value)" checked> 
                                                                <label class="custom-control-label" for="customSwitch'.$ents['id'].'">Still Active</label>
                                                            </div>'
                                                            :
                                                            '<div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="customSwitch'.$ents['id']. '" value="'.$date_details.'-0" onchange="deleteFunction(this.value)" >  
                                                                <label class="custom-control-label" for="customSwitch'.$ents['id'].'">Not Acitve</label>
                                                                
                                                            </div>');
                                                ?>
                                                        
                                                    </td>
                                                <?= (($user_data1['permission'] == "S")?
                                                    '<td>
                                                        <a href="entry.php?edit='.$ents['id'].'" class="btn btn-xs btn-outline-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="entry.php?delete='.$ents['id'].'" class="btn btn-xs btn-outline-primary"><i class="fas fa-trash-alt"></i></a>
                                                    </td>'
                                                    :
                                                    '');
                                                ?>
                                                    <? endif; ?>
                                                </tr>
                                            <?php $b++; endforeach; ?>

                                        </tbody>
                                    </table>
                                    
                                    <div class="container-fluid float-left bg-mattWhite mt-5 col-md-4">
                                    <?php foreach($summaryQuery as $summary): ?>
                                        <div class="text-left mt-3 mb-3">
                                            <h3><?= $summary['lname']." ". $summary['fname']; ?></h3>
                                            <span class="text-info"><?= $summary['list']; ?> Assets Entered</span><br>
                                            Total: <span class="text-info"><?= money("$", $summary['total']); ?></span><hr><br>  
                                        </div>
                                    <?php endforeach; ?>
                                        
                                    </div>
                                
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