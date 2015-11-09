<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Laufende Kampagnen</title>
<!-- Stylesheets -->
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/bootstrap.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/thumb-slide.css">
<link rel="stylesheet" href="css/owl.carousel.css">
<!--[if IE 9]>
	<script src="js/media.match.min.js"></script>
<![endif]-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-28558248-3', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body>
<div id="main-wrapper">
  <header id="header">
  <?php require_once 'topmenu.php'; ?>
    <!-- end .header-top-bar -->
    
    <div class="header-nav-bar">
      <nav class="navbar navbar-default" role="navigation">
        <div class="container"> 
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand" href="http://getleads.ch/"> <img src="img/header-logo.png" alt="GetLeads"> </a> </div>
          
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li> <a href="http://getleads.ch/">Home</a></li>
              <li> <a href="http://getleads.ch/getleads.php">GetLeads</a></li>
              <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Solutions <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="gewinn-tool.php">Gewinn Tool</a></li>
                  <li><a href="feedback-tool.php">Feedback Tool</a></li>
                  <li><a href="qrcode.php">QR Code V2.0</a></li>
                </ul>
              </li>
              <li><a class="act" href="kampagnen.php">Kampagnen</a> </li>
              <li><a href="kontakt.php">Kontakt</a> </li>
            </ul>
          </div>
          <!-- /.navbar-collapse --> 
        </div>
        <!-- /.container-fluid --> 
      </nav>
    </div>
    <!-- end .header-nav-bar --> 
  </header>
  <!-- end #header --> 
  <!-- thumbnail slide section -->
  <div id="page-content"> 
    
    <!-- start #main-wrapper -->
    <div class="container">
      <div class="row mt30">
        <div class="col-md-9 col-sm-12 col-md-push-3">
          <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#tab-1" role="tab" data-toggle="tab">Alle</a> </li>
            <li><a href="#tab-2" role="tab" data-toggle="tab">Food & Drink</a> </li>
            <li><a href="#tab-3" role="tab" data-toggle="tab">Coiffeure</a> </li>
            <li><a href="#tab-4" role="tab" data-toggle="tab">Massage</a> </li>
            <li><a href="#tab-5" role="tab" data-toggle="tab">Kosmetik</a> </li>
            <li><a href="#tab-6" role="tab" data-toggle="tab">Restaurant</a> </li>
            <li><a href="#tab-7" role="tab" data-toggle="tab">Hotel</a> </li>
            <li><a href="#tab-8" role="tab" data-toggle="tab">Andere</a> </li>
          </ul>
          <div class="view-style dsn">
            <div class="list-grid-view">
              <button class="thumb-view"><i class="fa fa-list"></i></button>
              <button class="without-thumb"><i class="fa fa-align-justify"></i></button>
              <button class="grid-view"><i class="fa fa-th-list"></i></button>
            </div>
            <!-- end .list-grid-view -->
            
            <div class="page-list text-right">
              <ul class="list-unstyled list-inline">
                <li class="active"><a href="#">1</a> </li>
              </ul>
            </div>
            <!-- end .page-list --> 
          </div>
          <!-- end view-style -->
          <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-1">
              <div class="all-menu-details">
                <h5>COMING SOON</h5>
                <div class="item-list">
                  <div class="list-image"> <img src="img/content/kampagnen-pizza-xtreme.jpg" alt="pizza xtreme"> </div>
                  <div class="all-details">
                    <div class="visible-option">
                      <div class="details">
                        <h6>Pizza Xtreme</h6>
                        <ul class="share-this list-inline text-right">
                          <li><a href="#">Share</a>
                            <ul class="list-inline">
                              <li><a href="https://www.facebook.com/pages/Getleads/447169438756498"><i class="fa fa-facebook-square"></i></a> </li>
                              <li><a href="#"><i class="fa fa-twitter-square"></i></a> </li>
                            </ul>
                          </li>
                        </ul>
                        <p class="for-list">Heute schon gratis gegessen?</p>
                      </div>
                      <div class="price-option fl">
                        <h4>win</h4>
                        <h5>
                          <center>
                            ZH
                          </center>
                        </h5>
                      </div>
                      <!-- end .price-option-->
                      <div class="qty-cart text-center">
                        <h6>Gültig bis:</h6>
                        31.12.2014 </div>
                      <!-- end .qty-cart --> 
                    </div>
                    <!--end .dropdown-option--> 
                  </div>
                  <!-- end .all-details --> 
                </div>
                <!-- end .item-list --> 
                
              </div>
              <!--end all-menu-details-->
              
              <div class="pagination">
                <ul class="list-inline  text-right">
                  <li class="active"><a href="#">1</a> </li>
                </ul>
              </div>
              <!-- end .pagination --> 
              
            </div>
            <!-- end .tab-pane --> 
            
          </div>
          <!-- end .tab-content --> 
        </div>
        <!--end main-grid layout--> 
        
        <!-- Side-panel begin -->
        <div class="col-md-3 col-sm-12 col-xs-12 col-md-pull-9">
          <div class="side-panel">
            <form class="default-form" action="index.html">
              <h6 class="toggle-main-title">Side Panel</h6>
              <div class="sd-panel-heading">
                <h5 class="toggle-title">My Check</h5>
                
                <!--end .slide-toggle --> 
              </div>
              <!-- end .sd-side-panel class -->
              
              <div class="find-on-map">
                <h5>Search by Region</h5>
                <div class="banner-search">
                  <div class="banner-search-inner">
                    <ul class="custom-list tab-content-list">
                      <li class="tab-content active"> <span class="select-box" title="Kanton">
                        <select name="Kanton" data-placeholder="Kanton">
                          <option>Region</option>
                          <option value="Deutschschweiz">Deutschschweiz</option>
                          <option value="Uk">Welschland</option>
                          <option value="India">India</option>
                          <option value="Bangladesh">Bangladesh</option>
                          <option value="Portugal">Portugal</option>
                        </select>
                        </span> <span class="select-box" title="ZIP Code">
                        <select name="PLZ" data-placeholder="PLZ">
                          <option>8000</option>
                          <option value="8051">8051</option>
                          <option value="8045">8045</option>
                          <option value="8003">8003</option>
                        </select>
                        </span> </li>
                    </ul>
                    <div class="map-section">
                      <div id="map_canvas"></div>
                    </div>
                    <!-- end .map-section --> 
                  </div>
                  <!-- end .banner-search-inner --> 
                </div>
                <!-- end .banner-search --> 
              </div>
              <!-- end .find-on-map -->
            </form>
            <!-- end form --> 
          </div>
          <!-- end side-panel --> 
          
        </div>
        <!--end .col-md-3 --> 
      </div>
      <!-- end .row --> 
    </div>
    <!--end .container --> 
    
    <!--footer start-->
    <?php include('footer.php'); ?>
    <!-- end #footer --> 
  </div>
</div>
<!-- end #main-wrapper --> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<!-- Local jQuery --> 
<script>
		window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')
		</script> 
<script src="js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script> 
<script src="js/jquery.magnific-popup.min.js"></script> 
<script src="js/owl.carousel.js"></script> 
<script src="js/bootstrap.js"></script> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> 
<script type="text/javascript" src="js/jquery.ui.map.js"></script> 
<script src="js/scripts.js"></script> 
<script>
		
		</script>
</body>
</html>
