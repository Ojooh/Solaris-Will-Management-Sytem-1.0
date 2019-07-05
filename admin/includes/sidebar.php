<!--==========================
        SideBar
      ============================-->
<?php if($user_data1['permission'] == "A"): ?>
            <div class="wrapper d-flex">
                <div class="sideMenu bg-mattBlackLight">
                    <div class="sidebar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link px-2">
                                    <i class="material-icons icon">
                                        dashboard
                                    </i><span class="text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                            <a href="entry.php" class="nav-link px-2">
                                <i class="material-icons icon">
                                    list
                                </i><span class="text">Asset Entry</span>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="users.php" class="nav-link px-2">
                                <i class="material-icons icon">
                                    account_group_outline
                                </i><span class="text">Users</span>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="admin.php" class="nav-link px-2">
                            <i class="fas fa-user-shield icon">

                            </i><span class="text"> Administrators</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link sideMenuToggler px-2">
                                <i class="material-icons icon">
                                     aspect_ratio
                                </i><span class="text">Resize</span>
                            </a>
                        </li> 
                  </ul>
              </div>
          </div>

<?php else: ?>

      <div class="wrapper d-flex">
          <div class="sideMenu bg-mattBlackLight">
              <div class="sidebar">
                  <ul class="navbar-nav">
                     <li class="nav-item">
                         <a href="index.php" class="nav-link px-2">
                             <i class="material-icons icon">
                                 dashboard
                             </i><span class="text">Dashboard</span>
                         </a>
                     </li>
                     <li class="nav-item">
                            <a href="asset_cat.php" class="nav-link px-2">
                                <i class="material-icons icon">
                                    view_list
                                </i><span class="text">Asset Category</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="currency.php" class="nav-link px-2">
                                <i class="material-icons icon">
                                    attach_money
                                </i><span class="text">Currency</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="entry.php" class="nav-link px-2">
                                <i class="material-icons icon">
                                    list
                                </i><span class="text">Asset Entry</span>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="users.php" class="nav-link px-2">
                                <i class="material-icons icon">
                                    account_group_outline
                                </i><span class="text">Users</span>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="admin.php" class="nav-link px-2">
                            <i class="fas fa-user-shield icon">

                            </i><span class="text"> Administrators</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link sideMenuToggler px-2">
                                <i class="material-icons icon">
                                     aspect_ratio
                                </i><span class="text">Resize</span>
                            </a>
                        </li> 
                  </ul>
              </div>
          </div>

<?php endif; ?>