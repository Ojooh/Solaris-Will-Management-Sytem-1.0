<?php
  require_once 'core/init.php';
  include 'includes/head.php';
  include 'includes/navbar.php';


?>

    
      <!--==========================
        Hero Section
      ============================-->
      <section id="hero">
        <div class="hero-container">
          <h1>Welcome to Solaris</h1>
          <h2>We are team of talented designers making websites and web Applications for consumer use</h2>
          <a href="#about" class="btn-get-started">Get Started</a>
        </div>
      </section><!-- #hero -->
    
      <main id="main">
    
        <!--==========================
          About Us Section
        ============================-->
        <section id="about">
          <div class="container">
            <div class="row about-container">
    
              <div class="col-lg-6 content order-lg-1 order-2">
                <h2 class="title">Few Words About Us</h2>
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
          Facts Section
        ============================-->
        <section id="facts">
          <div class="container wow fadeIn">
            <div class="section-header">
              <h3 class="section-title">Facts</h3>
              <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
            </div>
            <div class="row counters">
    
                      <div class="col-lg-3 col-6 text-center">
                <span data-toggle="counter-up">5</span>
                <p>Clients</p>
                      </div>
    
              <div class="col-lg-3 col-6 text-center">
                <span data-toggle="counter-up">13</span>
                <p>Projects</p>
                      </div>
    
              <div class="col-lg-3 col-6 text-center">
                <span data-toggle="counter-up">6</span>
                <p>Hours Of Support</p>
                      </div>
    
              <div class="col-lg-3 col-6 text-center">
                <span data-toggle="counter-up">2</span>
                <p>Hard Workers</p>
                      </div>
    
                  </div>
    
          </div>
        </section><!-- #facts -->
    
        
    
        <!--==========================
          Portfolio Section
        ============================-->
        <!-- <section id="portfolio">
          <div class="container wow fadeInUp">
            <div class="section-header">
              <h3 class="section-title">Portfolio</h3>
              <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
            </div>
            <div class="row">
    
              <div class="col-lg-12">
                <ul id="portfolio-flters">
                  <li data-filter=".filter-app, .filter-card, .filter-logo, .filter-web" class="filter-active">All</li>
                  <li data-filter=".filter-app">App</li>
                  <li data-filter=".filter-card">Card</li>
                  <li data-filter=".filter-logo">Logo</li>
                  <li data-filter=".filter-web">Web</li>
                </ul>
              </div>
            </div>
    
            <div class="row" id="portfolio-wrapper">
              <div class="col-lg-3 col-md-6 portfolio-item filter-app">
                <a href="">
                  <img src="img/portfolio/app1.jpg" alt="">
                  <div class="details">
                    <h4>App 1</h4>
                    <span>Alored dono par</span>
                  </div>
                </a>
              </div>
    
              <div class="col-lg-3 col-md-6 portfolio-item filter-web">
                <a href="">
                  <img src="img/portfolio/web2.jpg" alt="">
                  <div class="details">
                    <h4>Web 2</h4>
                    <span>Alored dono par</span>
                  </div>
                </a>
              </div>
    
              <div class="col-lg-3 col-md-6 portfolio-item filter-app">
                <a href="">
                  <img src="img/portfolio/app3.jpg" alt="">
                  <div class="details">
                    <h4>App 3</h4>
                    <span>Alored dono par</span>
                  </div>
                </a>
              </div>
    
              <div class="col-lg-3 col-md-6 portfolio-item filter-card">
                <a href="">
                  <img src="img/portfolio/card1.jpg" alt="">
                  <div class="details">
                    <h4>Card 1</h4>
                    <span>Alored dono par</span>
                  </div>
                </a>
              </div>
    
              <div class="col-lg-3 col-md-6 portfolio-item filter-card">
                <a href="">
                  <img src="img/portfolio/card2.jpg" alt="">
                  <div class="details">
                    <h4>Card 2</h4>
                    <span>Alored dono par</span>
                  </div>
                </a>
              </div>
    
              <div class="col-lg-3 col-md-6 portfolio-item filter-web">
                <a href="">
                  <img src="img/portfolio/web3.jpg" alt="">
                  <div class="details">
                    <h4>Web 3</h4>
                    <span>Alored dono par</span>
                  </div>
                </a>
              </div>
    
              <div class="col-lg-3 col-md-6 portfolio-item filter-card">
                <a href="">
                  <img src="img/portfolio/card3.jpg" alt="">
                  <div class="details">
                    <h4>Card 3</h4>
                    <span>Alored dono par</span>
                  </div>
                </a>
              </div>
    
              <div class="col-lg-3 col-md-6 portfolio-item filter-app">
                <a href="">
                  <img src="img/portfolio/app2.jpg" alt="">
                  <div class="details">
                    <h4>App 2</h4>
                    <span>Alored dono par</span>
                  </div>
                </a>
              </div>
    
              <div class="col-lg-3 col-md-6 portfolio-item filter-logo">
                <a href="">
                  <img src="img/portfolio/logo1.jpg" alt="">
                  <div class="details">
                    <h4>Logo 1</h4>
                    <span>Alored dono par</span>
                  </div>
                </a>
              </div>
    
              <div class="col-lg-3 col-md-6 portfolio-item filter-logo">
                <a href="">
                  <img src="img/portfolio/logo3.jpg" alt="">
                  <div class="details">
                    <h4>Logo 3</h4>
                    <span>Alored dono par</span>
                  </div>
                </a>
              </div>
    
              <div class="col-lg-3 col-md-6 portfolio-item filter-web">
                <a href="">
                  <img src="img/portfolio/web1.jpg" alt="">
                  <div class="details">
                    <h4>Web 1</h4>
                    <span>Alored dono par</span>
                  </div>
                </a>
              </div>
    
              <div class="col-lg-3 col-md-6 portfolio-item filter-logo">
                <a href="">
                  <img src="img/portfolio/logo2.jpg" alt="">
                  <div class="details">
                    <h4>Logo 2</h4>
                    <span>Alored dono par</span>
                  </div>
                </a>
              </div>
    
            </div>
    
          </div>
        </section>#portfolio -->
    
        
    
 <?php
      include 'includes/services.php';
      include 'includes/team.php';
      include 'includes/contact.php';
      include 'includes/footer.php';
 
 ?>