<?php 


//put client company name here, without space
$client = "XPIZZA";


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
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/bootstrap.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/owl.theme.css">
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
            <a class="navbar-brand" href="#"> <img src="img/header-logo.png" alt="GetLeads"> </a> </div>
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





 if (($aufruf %10) == 0 )

		echo "<img class=\"\" src=\"img/content/xpizza-pizza.jpg\" alt=\"pizza gratis\">";

 elseif (($aufruf %5) == 0 )

		echo "<img class=\"\" src=\"img/content/xpizza-salat.jpg\" alt=\"salat gratis\">";

	else

		echo "<img class=\"\" src=\"img/content/xpizza-kaffee.jpg\" alt=\"kaffee gratis\">";



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
                    Gültig bis Ende 2014!</p>
                  <p>ID
                    <?php

echo $client.$aufruf;

?>
                  </p>
                  <a href="http://www.opsag.ch" class="btn btn-default-red"><i class="fa fa-file-text-o"></i> Webseite</a> </div>
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
<script src="js/masterslider/masterslider.min.js"></script> 
<script src="js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script> 
<script src="js/jquery.magnific-popup.min.js"></script> 
<script src="js/owl.carousel.js"></script> 
<script src="js/bootstrap.js"></script> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> 
<script type="text/javascript" src="js/jquery.ui.map.js"></script> 
<script src="js/scripts.js"></script>
</body>
</html>
