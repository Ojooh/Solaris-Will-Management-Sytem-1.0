<?php 
    require_once '../core/init.php';
    if(!is_logged_in_admin()){
        login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/topbar.php';
    include 'includes/sidebar.php';
?>

      
      
          <!--==========================
            Main Content
          ============================-->
          <div class="content">
              <main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header mb-4 mt-4"><i class="fa fa-laptop"></i> Dashboard</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-laptop"></i>Dashboard</li>
                                </ol>
                        </div>
                    </div>
                </div>  
              </main>
          </div>
      </div>
<?php 
    include 'includes/footer.php';

?> 