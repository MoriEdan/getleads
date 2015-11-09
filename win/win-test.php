<?php 

//Connect DB
include ('../config.php');

//put client company name here
$client = "weisheit";



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

// Get user IP address
if ( isset($_SERVER['HTTP_CLIENT_IP']) && ! empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
}

$ip = filter_var($ip, FILTER_VALIDATE_IP);
$ip = ($ip === false) ? '0.0.0.0' : $ip;

//echo $ip;




//BROWSER
function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 

// now try it
$ua=getBrowser();
$yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];

$browser = $ua['name']. " ". $ua['version'];
$platform = $ua['platform'];


/*
//CHECK DOUBLE IP
$result = mysql_query("SELECT ip FROM scans WHERE ip = '$ip'");

if (mysql_num_rows($result) > 0) 
	$check = true; //double! Not good!
else
	$check = false; //ok


//CHECK IP
mysql_query("INSERT INTO scans (ip, browser,platform ) VALUES('$ip', '$browser', '$platform')");		
*/




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
          <div class="navbar-header">            
            <a class="navbar-brand" href="http://www.getleads.ch"> <img src="../img/header-logo.png" alt="GetLeads"> </a> </div>
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


//check double IP
if (!$check) {

//GEWINN
echo "      
        <h4>Herzlichen Glückwunsch!</h4>
        <div class=\"row\">
          <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
            <div class=\"blog-latest\">
              <div class=\"row\">
                <div class=\"col-md-6 col-sm-12\">";
                  			  				  
				  
//Gewinn Text				  
$gewinn = "";	  
			  
if (($aufruf %189) == 0) {
	echo "<img class=\"\" src=\"../img/content/".$client."-preis1.jpg\" alt=\"".$client."\">";				
	$gewinn = "weisheittop";
} elseif (($aufruf %50) == 0) { 
	echo "<img class=\"\" src=\"../img/content/".$client."-preis2.jpg\" alt=\"".$client."\">";				
	$gewinn = "weisheit50";
} else {
	echo "<img class=\"\" src=\"../img/content/".$client."-preis3.jpg\" alt=\"".$client."\">";					
	$gewinn = "weisheit10";
} 




echo "
                </div>
                <div class=\"col-md-6 col-sm-12\">
                  <h5>Sie haben gewonnen!</h5>
                  <p><i class=\"fa fa-clock-o\"></i> <span class=\"date\">";

                  print date("d/m/Y", time());

echo "
                    </span>// <span class=\"time\">";
      
print date("G.i:s", time());

echo "
                    </span> </p>
                  <p class=\"bl-sort\">Sie können Ihren Gewinn in unserem Online-Shop mit folgendem Code einlösen</p>
                  <p>Ihr Code:";
echo $gewinn;
echo "                  </p>
                  <p>Gültig bis Ende 2015!</p>";

} else {
	
	
//KEIN GEWINN
echo "      
        <h4>Dankeschön!</h4>
        <div class=\"row\">
          <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
            <div class=\"blog-latest\">
              <div class=\"row\">
                <div class=\"col-md-6 col-sm-12\">";   			  				  
				  
echo "<img class=\"\" src=\"../img/content/".$client."-default.jpg\" alt=\"".$client."\">";	

echo "
                </div>
                <div class=\"col-md-6 col-sm-12\">
                  <h5>Wir freuen uns auf Ihren Besuch!</h5>
                  <p><i class=\"fa fa-clock-o\"></i> <span class=\"date\">";

print date("d/m/Y", time());

echo "
                    </span>// <span class=\"time\">";
      
print date("G.i:s", time());

echo "
                    </span> </p>";	
	
	
}

?>


				  
				  
                  <a href="http://www.weisheit.ch" class="btn btn-default-red" target="_blank"><i class="fa fa-file-text-o"></i> ONLINE-SHOP</a> </div>
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
