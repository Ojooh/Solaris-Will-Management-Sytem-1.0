<!--==========================
        TopBar
      ============================-->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
          <button class="navbar-toggler sideMenuToggler" type="button">
                <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#">Will Pannel</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item dropdown mr-5">           
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome <?= ((isset($_SESSION['SLOwner']) && $_SESSION['SLOwner'] != '')?$user_data['username']: $user_name); ?>
                        </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="change_password.php">Change Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                  </li>
              </ul>
          </div>
      </nav>
