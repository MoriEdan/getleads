<?php 


include("PulsePro.class.php");  

$pulse01 = new PulsePro('horizontal');  
$pulse02 = new PulsePro('horizontal');  
$pulse03 = new PulsePro('horizontal');  
$pulse04 = new PulsePro('horizontal');  


//put client company name here
$client = "VillaCastagnola";


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>GetLeads Feedback -<?php echo $client; ?></title>
<!-- Stylesheets -->
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../css/bootstrap.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/responsive.css">
<link rel="stylesheet" href="../css/owl.theme.css">
<?php  
echo PulsePro::css();  
echo PulsePro::javascript();  
?>
<!--[if lt IE 9]>

		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

	<![endif]-->
</head>
<body>
<div id="main-wrapper">
  <header id="header">
    <div class="header-top-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-7 col-sm-12 col-xs-12">
            <p class="call-us"> Tel: <a class="font" href="callto:+41566197673">+41 (0)56 619 76 73</a> </p>
          </div>
        </div>
        <!-- end .row --> 
      </div>
      <!-- end .container --> 
    </div>
    <!-- end .header-top-bar -->
    <div class="header-nav-bar">
      <nav class="navbar navbar-default" role="navigation">
        <div class="container"> 
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand" href="#"> <img src="../img/header-logo.png" alt="GetLeads"> </a> </div>
        </div>
        <!-- /.container-fluid --> 
      </nav>
    </div>
    <!-- end .header-nav-bar --> 
    <!-- small menu section -->
    <div class="small-menu">
      <div class="container">
        <ul class="list-unstyled list-inline">
          <li><a href="http://getleads.ch/">Home</a> </li>
        </ul>
      </div>
      <!-- end .container--> 
    </div>
    <!--end .small-menu --> 
  </header>
  <!-- end #header --> 
  <!-- all page-content star -->
  <div id="page-content"> 
    <!--Start blog feed section-->
    <div class="latest-from-blog text-center">
      <div class="container">
        <h4>BITTE GEBEN SIE UNS FEEDBACK</h4>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="blog-latest">
              <div class="row">
                <div class="col-md-6 col-sm-12"> <img class="" src="../img/content/feedback.png" alt="GetLeads Feedback Media Markt"> </div>
                <div class="col-md-6 col-sm-12">
                  <h5>Wurden Sie schnell bedient?</h5>
                  <p><?php echo $pulse01->buttons('Wurden Sie schnell bedient?'); ?> </p>
                  <div style="margin:30px"></div>
                  <h5>Wurde Ihnen geholfen?</h5>
                  <p><?php echo $pulse02->buttons('Wurde Ihnen geholfen?'); ?> </p>
                  <div style="margin:30px"></div>
                  <h5>Wie war die Bedienung?</h5>
                  <p><?php echo $pulse03->buttons('Wie war die Bedienung?'); ?> </p>
                  <div style="margin:30px"></div>
                  <h5>Wie war die Wartezeit an der Kasse?</h5>
                  <p><?php echo $pulse04->buttons('Wie war die Wartezeit an der Kasse?'); ?> </p>
                  <a href="http://getleads.ch/win-"<?php echo $client; ?>".php" class="btn btn-default-red"><i class="fa fa-file-text-o"></i> GEWINN GENERATOR</a> </div>

                </div>
                <!--end .blog-details--> 
              </div>
              <!--end .row--> 
            </div>
            <!--end .blog-latest --> 
          </div>
          <!--end grid layout--> 
        </div>
      </div>
      <!--end .row main--> 
    </div>
    <!--end container--> 
  </div>
  <!--end .latest-from-blog--> 
</div>
<!-- end #page-content --> 
<!--footer start-->
<footer id="footer">
  <div class="container">
    <div class="main-footer">
      <div class="row">
        <div class="col-sm-6 col-md-3"> <img src="../img/header-logo.png" alt="">
          <p>Wir wissen, dass es bei der Kundenbindung darum geht, Kunden gute Lösungen zu bieten, damit sie für Ihren Service entscheiden.</p>
        </div>
        <div class="col-sm-6 col-md-3">
          <h5>Quick Links</h5>
          <div class="row">
            <div class="col-md-6">
              <ul class="footer-links padd">
                <li><a href="http://getleads.ch/">Home</a> </li>
                <li><a href="http://getleads.ch/gewinn-kampagne.php">Gewinn Kampagne</a> </li>
                <li><a href="http://getleads.ch/qrcode.php">QR Code V2.0</a> </li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="footer-links">
                <li><a href="http://getleads.ch/getleads.php">GetLeads</a> </li>
                <li><a href="http://getleads.ch/kontakt.php">Kontakt</a> </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      <p>Copyright © 2014 getleads.ch. All rights reserved. Powered by <a href="http://www.opsag.ch" target="_blank">Online Portal Service AG</a>.
        &nbsp;&nbsp;<a href="impressum.php">Impressum</a></p>
      <ul class="footer-social">
        <li><a href="https://www.facebook.com/pages/Getleads/447169438756498"><i class="fa fa-facebook-square"></i></a> </li>
        <li><a href="#"><i class="fa fa-twitter-square"></i></a> </li>
      </ul>
      <!-- end .footer-social --> 
    </div>
  </div>
</footer>

<!-- end #footer -->
</div>
<!-- end #main-wrapper -->

</body>
</html>
