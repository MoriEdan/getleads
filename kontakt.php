<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Contact-Us</title>
<!-- Stylesheets -->
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="js/masterslider/style/masterslider.css">
<link rel="stylesheet" href="js/masterslider/skins/black-2/style.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/owl.theme.css">
<link rel="stylesheet" href="css/owl.carousel.css">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
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
              <li><a href="kampagnen.php">Kampagnen</a> </li>
              <li><a class="act" href="kontakt.php">Kontakt</a> </li>
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
  
  <div class="page-content">
    <div class="map-section">
      <div id="map_canvas"></div>
    </div>
    <!-- end .map-section -->
    <div class="contact-us">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="contact-details">
              <h4>Adresse</h4>
              <div class="row">
                <div class="col-md-12 col-sm-6">
                    <h5 style="padding-bottom: 15px;">Alleinvertrieb in Deutschland - Österreich - Schweiz</h5>
                  <div class="address clearfix">
                    <p><i class="fa fa-map-marker"></i> </p>
                    <p>CITYGUIDE AG<br />
                      Seestrasse 315<br />
                      8038 Zürich<br />
                      <br />
                      E-Mail <a href="mailto:kundenbetreuung@cityguide.ag">kundenbetreuung@cityguide.ag</a>
                      </p>
                  </div>
                   <h5 style="padding-bottom: 15px;">Verantwortlich für IT</h5>
                  <div class="address clearfix">
                    <p><i class="fa fa-map-marker"></i> </p>
                    <p>Online Portal Service AG<br />
                      Ruessenstrasse 5a<br />
                      6340 Baar<br />
                      <br />
                      E-Mail <a href="mailto:info@getleads.ch">info@getleads.ch</a>
                      </p>
                  </div>
<!--                  <div class="time-to-open clearfix">
                    <p><i class="fa fa-clock-o"></i> </p>
                    <p> <strong>Montag - Freitag</strong>9h - 17h<br>
                      <strong>Samstag:</strong>geschlossen<br />
                      <strong>Sontag:</strong>geschlossen</p>
                  </div>-->
                </div>
              </div>
              <!-- end nasted .row --> 
            </div>
            <!-- end .contact-details --> 
          </div>
          <!-- end .main-grid-layout -->
          
          <div class="col-md-6">
            <div class="send-message">
              <h4>Schicken Sie uns eine Nachricht</h4>
              <form name="contactform" method="post" action="email.php">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" placeholder="Name*" name="name">
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <input type="email" placeholder="Email*" name="email_from">
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" placeholder="Phone" name="phone">
                  </div>
                </div>
                <!-- end nasted .row -->
                <textarea placeholder="Your message" name="message"></textarea>
                <button><i class="fa fa-paper-plane-o"></i> Nachricht absenden</button>
              </form>
            </div>
            <!-- end .send-message --> 
          </div>
          <!-- end .main-grid-layout --> 
        </div>
        <!-- end .row --> 
      </div>
      <!-- end .container --> 
    </div>
    <!-- end .contact-us --> 
  </div>
  <!-- end page-content --> 
  
  <!--footer start-->
  <?php include('footer.php'); ?>
  <!-- end #footer --> 
  
</div>
<!-- end #main-wrapper --> 
<!-- Scripts --> 
<!-- CDN jQuery --> 
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
