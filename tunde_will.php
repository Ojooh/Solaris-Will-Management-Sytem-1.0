<?php
  require_once 'core/init.php';
  include 'includes/head.php';
?>
    <!--==========================
  Header
  ============================-->
  <header id="header">
        <div class="container">
    
          <div id="logo" class="pull-left">
            <h1><a href="index.php">Solaris</a></h1>
          </div>
    
          <nav id="nav-menu-container">
            <ul class="nav-menu">
              <li class="menu-active"><a href="index.php">Home</a></li>
              <li><a href="#about">Register</a></li>
              <li class="menu-has-children"><a href="#services">Services</a>
                <ul>
                  <li><a href="#">Drop Down 1</a></li>
                  <li class="menu-has-children"><a href="#services">Services</a>
                    <ul>
                      <li><a href="#">Deep Drop Down 1</a></li>
                      <li><a href="#">Deep Drop Down 2</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Drop Down 3</a></li>
                </ul>
              </li>
              <li><a href="#team">Team</a></li>
              
              <li><a href="#contact">Contact Us</a></li>
            </ul>
          </nav><!-- #nav-menu-container -->
        </div>
      </header><!-- #header -->

     <!--==========================
        Hero Section
     ============================-->
      <section id="hero">
        <div class="hero-container float-left">
          <h1>Tunde's Will Management System</h1>
          <h2>An Intuitive Asset and User Management System, to Facilitate Preparation for the After Life</h2>
          <a href="/will/tunde will" class="btn-get-started">Sign In</a>
        </div>
      </section><!-- #hero -->
    
      <main id="main">

      <!--==========================
          why? Section
        ============================-->
        <section id="about">
          <div class="container">
            <div class="row about-container">
    
              <div class="col-lg-6 content order-lg-1 order-2">
                <h2 class="title">Why Solaris Tunde Will</h2>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
    
                <div class="icon-box wow fadeInUp">
                  <div class="icon"><i class="fa fa-shopping-bag"></i></div>
                  <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
                  <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
                </div>
    
                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
                  <div class="icon"><i class="fa fa-photo"></i></div>
                  <h4 class="title"><a href="">Magni Dolores</a></h4>
                  <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                </div>
    
                <div class="icon-box wow fadeInUp" data-wow-delay="0.4s">
                  <div class="icon"><i class="fa fa-bar-chart"></i></div>
                  <h4 class="title"><a href="">Dolor Sitema</a></h4>
                  <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
                </div>
    
              </div>
    
              <div class="col-lg-6 background order-lg-2 order-1 wow fadeInRight"></div>
            </div>
    
          </div>
        </section><!-- #about -->
        <!--==========================
          Portfolio Section
        ============================-->
        <section id="register">
          <div class="container wow fadeInUp">
            <div class="section-header">
              <h3 class="section-title">Register</h3>
              <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
            </div>
            <div class="row">
    
              <div class="col-lg-12">
                
              </div>
            </div>
               
        </section>


<?php
      include 'includes/services.php';
      include 'includes/team.php';
      include 'includes/contact.php';
      include 'includes/footer.php';
 
 ?>