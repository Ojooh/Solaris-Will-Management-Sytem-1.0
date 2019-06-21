<?php 
    require_once '../core/init.php';
    if(!has_permission()){
        permission_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/topbar.php';
    include 'includes/sidebar.php';

    //fetch query
    $currencyQuery = $db->query("SELECT * FROM currency ORDER BY currency ");
    $currences = mysqli_fetch_assoc($currencyQuery);

    $currency_name_error = $currency_error = $symbol_error = $rate_error =  $currGen_error = "";
    $a = 1;
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete_id = (int)$_GET['delete'];
        $delete_id = sanitize($delete_id);
        $db->query("DELETE FROM currency WHERE id = '$delete_id'");
        echo '<script>location.replace("currency.php");</script>';
    }
    elseif(isset($_GET['edit']) && !empty($_GET['edit'])){   
        $edit_id = (int)$_GET['edit'];
        $edit_id = sanitize($edit_id);
        $currencyEditQuery = $db->query("SELECT * FROM currency WHERE id = '{$edit_id}'");
        $currencyEdit = mysqli_fetch_assoc($currencyEditQuery);
        $currency_name = $currencyEdit['currency_name'];
        $currency = $currencyEdit['currency'];
        $symbol = $currencyEdit['symbol'];
        $rate = $currencyEdit['convert_rate'];
    }
    else{
        $currency_name = "";
        $currency = "";
        $symbol = "";
        $rate = "";
    }

    include 'formProcessing/currencyFormSubmitted.php';
?>

      
      
          <!--==========================
            Main Content
          ============================-->
          <div class="content">
              <main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-dollar-sign"></i> Currency</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-dollar-sign"></i> Currency</li>
                                </ol>
                        </div>

                        <!--- form --->
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="col-md-12 mb-3 text-center text-danger"><?= $currGen_error; ?></div>
                            <form action="currency.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" class="form-horizontal" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="currency name">Currency Name</label>
                                            <input type="text" class="form-control" id="currency_name" name="currency_name" value="<?= $currency_name; ?>" placeholder="Enter Currency Name">
                                            <div class="text-danger mb-2">
                                                <?= $currency_name_error; ?>
                                            </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="currency">currency</label>
                                            <input type="text" class="form-control" id="currency" name="currency" value="<?= $currency; ?>" placeholder="Enter Currency">
                                            <div class="text-danger mb-2">
                                                <?= $currency_error; ?>
                                            </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="Currency Symbol">Currency Symbol</label>
                                            <input type="text" class="form-control" id="symbol" name="symbol" value="<?= $symbol; ?>" placeholder="Enter Symbol">
                                            <div class="text-danger mb-2">
                                                <?= $symbol_error; ?>
                                            </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="Convert Rate">Convert Rate</label>
                                            <input type="number" class="form-control" id="rate" name="rate" value="<?= $rate; ?>" placeholder="Enter rate" step="0.00001" min="0">
                                            <div class="text-danger mb-2">
                                                <?= $rate_error; ?>
                                            </div>
                                    </div>

                                    
                                    <button type="submit" class="btn btn-primary"><?=((isset($_GET['edit']))?"EDIT":"ADD"); ?></button>
                                    <?=((isset($_GET['edit']))?'<a href="currency.php" class="btn btn-outline-primary">Cancel</a>':''); ?>
                                </div>
                            </form>

                            <!---- CATEGORY TABLE --->
                            <?php if($currences === null): ?>
                                <div class="text-danger text-center mt-5">
                                    NO CURRENCES HAVE BEEN INPUTED, CATEGORIES MUST BE SET BEFORE YOU CAN ENTER ASSETS!
                                </div>
                            <?php else: ?>
                                    <table class="table table-hover bg-mattWhite mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/N</th>
                                                <th scope="col">Currency Name</th>
                                                <th scope="col">Currency</th>
                                                <th scope="col">Currency Symbol</th>
                                                <th scope="col">Convert Ratel</th>
                                                <th scope="col">Edit/Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php  foreach($currencyQuery as $curr): ?>
                                                <tr>
                                                    <th scope="row"><?= $a; ?></th>
                                                    <td><?= $curr['currency_name']; ?></td>
                                                    <td><?= $curr['currency']; ?></td>
                                                    <td><?= $curr['symbol']; ?></td>
                                                    <td><?= $curr['convert_rate']; ?></td>
                                                    <td>
                                                        <a href="currency.php?edit=<?= $curr['id']; ?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="currency.php?delete=<?= $curr['id']; ?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            <?php $a++; endforeach; ?>

                                        </tbody>
                                    </table>
                                
                            <?php endif; ?>
                            
                                
                                
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>  
              </main>
          </div>
      </div>
<?php 
    include 'includes/footer.php';

?> 