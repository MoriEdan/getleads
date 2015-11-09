<?php 



//put client company name here

$client = "Starbucks";



//Count Visits 

//Speichert Aufrufe der Seite in einer Textdatei

	

if(!file_exists("counter-".$client.".txt")){//Wenn die Datei noch nicht existiert	

 $counter=fopen("counter-".$client.".txt", "a"); //wird sie angelegt und "geöffnet" (a)	

} else {//Wenn sie existiert	

 $counter=fopen("counter-".$client.".txt", "r+"); //wird sie "geöffnet" (r+)	

}

	

$aufruf=fgets($counter,100); //speichert den aktuellen Wert aus der Datei in $aufruf	

$aufruf=$aufruf+1; //erhöht den Zähler um 1	

rewind($counter); //Dateizeiger auf das erste Byte der Datei setzen	

fputs($counter,$aufruf); //Wert von $aufruf in der Datei speichern	

fclose($counter); //Datei schließen



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
        <h4>Herzlichen Glückwunsch!</h4>
        <h5>D E M O</h5>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="blog-latest">
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <?php





 if (($aufruf %10) == 0)

		echo "<img class=\"\" src=\"../img/content/starbucks-marble.jpg\" alt=\"marble gratis\">";

 elseif (($aufruf %5) == 0) 

		echo "<img class=\"\" src=\"../img/content/starbucks-icekaffee.jpg\" alt=\"ice kaffee gratis\">";

	else

		echo "<img class=\"\" src=\"../img/content/starbucks-kaffee.jpg\" alt=\"kaffee gratis\">";



?>
                </div>
                <div class="col-md-6 col-sm-12">
                  <h5>Ihr GRATIS Gewinn ist abholbereit</h5>
                  <p><i class="fa fa-clock-o"></i> <span class="date">
                    <?php

                  print date("d/m/Y", time());

?>
                    </span>at <span class="time">
                    <?php

print date("G.i:s", time());

?>
                    </span> </p>
                  <p class="bl-sort">Bitte vorweisen!<br />
                    Gültig bis Ende 2015!</p>
                  <p>ID
                    <?php

echo $client.$aufruf;

?>
                  </p>
                  <a href="http://www.starbucks.ch/" class="btn btn-default-red"><i class="fa fa-file-text-o"></i> Webseite</a> </div>
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
      <!-- read older button -->
      <div class="read-older"> <a href="http://www.getleads.ch" class="btn btn-default-red"><i class="fa fa-file-text-o"></i> Weitere Kampagnen</a> </div>
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
      <p>Copyright © 2014 - 2015 getleads.ch. All rights reserved. Powered by <a href="http://www.opsag.ch" target="_blank">Online Portal Service AG</a>.
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
