<?php 

//Connect DB
include ('../config.php');


//put client company name here
$client = "shopping";




	




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>GetLeads -<?php echo $client; ?></title>
<!-- Stylesheets -->
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<link rel="stylesheet" href="../css/responsive.css" type="text/css" />
<link rel="stylesheet" href="../css/owl.theme.css" type="text/css" />
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
          <div class="navbar-header"> <a class="navbar-brand" href="http://www.getleads.ch"> <img src="../img/header-logo.png" alt="GetLeads"> </a> </div>
        </div>
        <!-- /.container-fluid --> 
      </nav>
    </div>
    <!-- end .header-nav-bar --> 
    
  </header>
  <!-- end #header --> 
  <!-- all page-content star -->
  <div id="page-content"> 
    <!--Start blog feed section-->
    <div class="latest-from-blog text-center">
      <div class="container">
        <?php	



//GEWINN
echo "      
        <h4>Reporting Kunde $client</h4>
        <div class=\"row\">

            <div class=\"blog-latest\">
              <div class=\"row\">
                <div class=\"col-md-12 col-sm-12\" style=\"text-align:left\">
				ID |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TIMESTAMP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BROWSER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;PLATFORM&nbsp;|&nbsp;COUNTER<br />";

$result = mysql_query("SELECT * FROM scans WHERE client = '$client'");
while($row = mysql_fetch_object($result))    {
	
   echo "$row->id | $row->ip | $row->scan | $row->browser | $row->platform | $row->counter<br />";

}


?>
      </div>
      <!--end .blog-details--> 
      
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
                <li><a href="http://www.getleads.ch/gewinn-tool.php">Gewinn Tool</a></li>
                <li><a href="http://www.getleads.ch/feedback-tool.php">Feedback Tool</a></li>
                <li><a href="http://www.getleads.ch/qrcode.php">QR Code V2.0</a> </li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="footer-links">
                <li><a href="http://www.getleads.ch/getleads.php">GetLeads</a> </li>
                <li><a href="http://www.getleads.ch/kontakt.php">Kontakt</a> </li>
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
        &nbsp;&nbsp;<a href="http://www.getleads.ch/impressum.php">Impressum</a></p>
      <ul class="footer-social">
        <li><a href="https://www.facebook.com/pages/Getleads/447169438756498"><i class="fa fa-facebook-square"></i></a> </li>
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
