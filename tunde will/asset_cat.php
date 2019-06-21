<?php 
    require_once '../core/init.php';
    if(!is_logged_in()){
        login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/topbar.php';
    include 'includes/sidebar.php';

    //fetch query
    $categoryQuery = $db->query("SELECT * FROM asset_category WHERE `deleted` = 0 ORDER BY category ");
    $categories = mysqli_fetch_assoc($categoryQuery);

    $assetcat_error = "";
    $a = 1;
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete_id = (int)$_GET['delete'];
        $delete_id = sanitize($delete_id);
        $table = "asset_category";
        recycle($table, $delete_id);
        echo '<script>location.replace("asset_cat.php");</script>';
    }
    elseif(isset($_GET['edit']) && !empty($_GET['edit'])){   
        $edit_id = (int)$_GET['edit'];
        $edit_id = sanitize($edit_id);
        $categoryEditQuery = $db->query("SELECT * FROM asset_category WHERE id = '{$edit_id}' AND deleted = 0");
        $categoryEdit = mysqli_fetch_assoc($categoryEditQuery);
        $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']):$categoryEdit['category']);
    }
    else{
        $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']): "");
    }

    include 'formProcessing/asset_catFormSubmitted.php';
?>

      
      
          <!--==========================
            Main Content
          ============================-->
          <div class="content">
              <main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header mb-4 mt-4"><i class="fas fa-th-list"></i> Asset Category</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-th-list"></i> Asset Category</li>
                                </ol>
                        </div>

                        <!--- form --->
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form action="asset_cat.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" class="form-horizontal" method="post">
                            <div class="form-group">
                                <label for="category">Aset Category</label>
                                    <input type="text" class="form-control" id="category" name="category" value="<?= $category; ?>" placeholder="Enter Category">
                                    <div class="text-danger mb-2">
                                        <?= $assetcat_error; ?>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary"><?=((isset($_GET['edit']))?"EDIT":"ADD"); ?></button>
                                <?=((isset($_GET['edit']))?'<a href="asset_cat.php" class="btn btn-outline-primary">Cancel</a>':''); ?>
                            </form>

                            <!---- CATEGORY TABLE --->
                            <?php if($categories === null): ?>
                                <div class="text-danger text-center mt-5">
                                    NO CATEGORIES HAVE BEEN INPUTED, CATEGORIES MUST BE SET BEFORE YOU CAN ENTER ASSETS!
                                </div>
                            <?php else: ?>
                                    <table class="table table-hover bg-mattWhite mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/N</th>
                                                <th scope="col">Categories</th>
                                                <th scope="col">Edit/Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php  foreach($categoryQuery as $category): ?>
                                                <tr>
                                                    <th scope="row"><?= $a; ?></th>
                                                    <td><?= $category['category']; ?></td>
                                                    <td>
                                                        <a href="asset_cat.php?edit=<?= $category['id']; ?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="asset_cat.php?delete=<?= $category['id']; ?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-trash-alt"></i></a>
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