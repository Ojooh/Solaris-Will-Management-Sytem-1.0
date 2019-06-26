<?php 
    require_once '../core/init.php';
    if(!is_logged_in()){
        login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/topbar.php';
    include 'includes/sidebar.php';

    $p_user = $user_data['id'];
    $iname_error = $asset_cat_error = $currency_error = $value_error = $description_error = $entGen_error =  "";
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete_id = (int)$_GET['delete'];
        $delete_id = sanitize($delete_id);
        $table = "assets";
        recycle($table, $delete_id);
        echo '<script>location.replace("entry.php");</script>';
    }
 
    if(isset($_GET['add']) || isset($_GET['edit'])){
        $asset_catQuery = $db->query("SELECT * FROM asset_category WHERE `deleted` = 0");
        $currencyQuery = $db->query("SELECT * FROM currency");
        $iname = ((isset($_POST['iname']) && $_POST['iname'] != '' )?sanitize($_POST['iname']):'');
        $asset_cat = ((isset($_POST['asset_cat']) && $_POST['asset_cat'] != '' )?sanitize($_POST['asset_cat']):'');
        $currency = ((isset($_POST['currency']) && $_POST['currency'] != '' )?sanitize($_POST['currency']):'');
        $value = ((isset($_POST['value']) && $_POST['value'] != '' )?sanitize($_POST['value']):'');
        $dollars = ((isset($_POST['dollars']) && $_POST['dollars'] != '' )?sanitize($_POST['dollars']):'');
        $quantity = ((isset($_POST['quantity']) && $_POST['quantity'] != '' )?sanitize($_POST['quantity']):1);
        $description = ((isset($_POST['description']) && $_POST['description'] != '' )?sanitize($_POST['description']):'');
        
        if(isset($_GET['edit']) && !empty($_GET['edit'])){
            $edit_id = (int)$_GET['edit'];
            $edit_id = sanitize($edit_id);
            $entryEditQuery = $db->query("SELECT * FROM assets WHERE `id` = '{$edit_id}' AND `deleted` = 0");
            $entryEdit = mysqli_fetch_assoc($entryEditQuery);
            $iname = ((isset($_POST['iname']) && $_POST['iname'] != '' )?sanitize($_POST['iname']):$entryEdit['item_name']);
            $asset_cat = ((isset($_POST['asset_cat']) && $_POST['asset_cat'] != '' )?sanitize($_POST['asset_cat']):$entryEdit['asset_cat']);
            $currency = ((isset($_POST['currency']) && $_POST['currency'] != '' )?sanitize($_POST['currency']):$entryEdit['currency']);
            $value = ((isset($_POST['value']) && $_POST['value'] != '' )?sanitize($_POST['value']):(($entryEdit['edited_value'] == 0)?$entryEdit['initial_value']:$entryEdit['edited_value']));
            $dollars = ((isset($_POST['dollars']) && $_POST['dollars'] != '' )?sanitize($_POST['dollars']):$entryEdit['dollars']);
            $description = ((isset($_POST['description']) && $_POST['description'] != '' )?sanitize($_POST['description']):$entryEdit['description']);
        }
        
        
        include 'formProcessing/entryFormSubmitted.php';
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
                                        <?=((isset($_GET['edit']))?'<i class="fas fa-pencil-alt"></i> Edit Asset':'<i class="fas fa-plus-square"></i> Add New Asset'); ?>
                                    </li>
                                </ol>
                        </div>

                        <!--==========================
                            Form Content
                        ============================-->
                        <div class="col-lg-12">
                        <div class="col-md-12 mb-3 text-center text-danger"><?= $entGen_error; ?></div>
                            <form action="entry.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'?add=1'); ?>" class="form-horizontal" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Item Name">Item Name</label>
                                        <input type="text" class="form-control" id="iname" name="iname" value = "<?= $iname;?>"placeholder="Enter Item Name Here">
                                        <div class="text-danger">
                                            <?= $iname_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
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
                                        <select class="form-control" id="currency" name="currency" onchange="dollarFunction(this.value)">
                                                <option value="<?= (($currency == '')?'':''); ?>">- Choose a Category -</option>
                                            <?php while($cure = mysqli_fetch_assoc($currencyQuery)): ?>
                                                <option value="<?= $cure['id'].",".$cure['convert_rate']; ?>"<?= (($currency == $cure['id'])?' selected':''); ?>><?= $cure['currency_name']." - ". $cure['currency']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                        <div class="text-danger">
                                            <?= $currency_error; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="Asset value">Asset Value</label>
                                            <input type="number" class="form-control" id="value" name="value" value="<?= $value; ?>" placeholder="Cost of Asset" step="0.00001" min="0">
                                            <div class="text-danger mb-2">
                                                <?= $value_error; ?>
                                            </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="Asset Value in Dolars">Asset Value in Dolars</label>
                                        <input type="number" class="form-control" name="dollars" id="dollars" value="<?= $dollars;?>" readonly>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="Asset Quantity">Asset Quantity</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity" value="<?= $quantity;?>" placeholder="" min="1">
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
        $entryQuery = $db->query("SELECT * FROM assets WHERE `deleted` = 0 AND `user_id` = '{$p_user}' ORDER BY `asset_no`");
        $entry = mysqli_fetch_assoc($entryQuery);
        $a = 1;

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
                                    <li class="breadcrumb-item"active" aria-current="page"><i class="fas fa-list-ul"></i> Asset Entry</li>
                                </ol>
                                <a href="entry.php?add=1" class="btn btn-outline-primary">Add New Asset</a>
                        </div>
                        <!--==========================
                            Beneficiary Table Content
                        ============================-->
                        <div class="col-lg-12 mt-4">
                        <?php if($entry === null): ?>
                                <div class="text-danger text-center mt-5">
                                    NO ASSETS HAVE BEEN ENTERED!
                                </div>
                            <?php else: ?>
                                    <div class="float-right">
                                            <h3><?= money("$", $sum['total']); ?></h3>
                                    </div>
                                    <table class="table table-hover bg-mattWhite mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/N</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Asset Value</th>
                                                <th scope="col">Dollar Value</th>
                                                <th scope="col">Beneficiary</th>
                                                <th scope="col">Entry Date</th>
                                                <th scope="col">Edit Date</th>
                                                <th scope="col">Edit/Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php  
                                                    foreach($entryQuery as $ent):
                                                        $cu_id = $ent['currency'];
                                                        $bid = $ent['beneficiary'];
                                                        $bd = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE `id` = '{$bid}'"));
                                                        $cu = mysqli_fetch_assoc($db->query("SELECT * FROM currency WHERE `id` = '{$cu_id}'"));
                                             ?>
                                                <tr>
                                                    <th scope="row"><?= $a; ?></th>
                                                    <td><?= $ent['item_name']; ?></td>
                                                    <td><?= money($cu['symbol'], (($ent['edited_value'] == 0)?$ent['initial_value']:$ent['edited_value'])); ?></td>
                                                    <td><?= money("$", $ent['dollars']); ?></td>
                                                    <td><?= (($ent['beneficiary'] == 0)?'None':$bd['fname']); ?></td>
                                                    <td><?= pretty_date($ent['entry_date']); ?></td>
                                                    <td><?= (($ent['edit_date'] == '0000-00-00 00:00:00')?'Never':pretty_date($ent['edit_date'])); ?></td>
                                                    <td>
                                                        <a href="entry.php?edit=<?= $ent['id']; ?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="entry.php?delete=<?= $ent['id']; ?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-trash-alt"></i></a>
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