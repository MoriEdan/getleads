<?php
 
mb_internal_encoding("UTF-8");

if(isset($_POST['email_from'])) { 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED 
    $email_to = "info@getleads.ch"; 
    $email_subject = "KONTAKTFORMULAR getleads.ch";
        
 
    function died($error) { 
        // your error code can go here 
        echo "We are very sorry, but there were error(s) found with the form you submitted. "; 
        echo "These errors appear below.<br /><br />"; 
        echo $error."<br /><br />"; 
        echo "Please go back and fix these errors.<br /><br />";
		echo "<a href=\"http://www.getleads.ch/kontakt.php\">Back</a>"; 
        die(); 
    } 
     
     // validation expected data exists 
    if(!isset($_POST['name']) || 
        !isset($_POST['email_from']) || 
        !isset($_POST['phone']) || 
        !isset($_POST['message'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }    
 
    $name 		= $_POST['name']; // required 
    $email_from	= $_POST['email_from']; // required 
    $phone 		= $_POST['phone']; // required 
    $message 	= $_POST['message']; // required     
 
    $error_message = ""; 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	 
  if(!preg_match($email_exp,$email_from)) { 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />'; 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) { 
    $error_message .= 'The Name you entered does not appear to be valid.<br />'; 
  }
 
  if(strlen($message) < 4) { 
    $error_message .= 'The message you entered do not appear to be valid.<br />'; 
  }
 
  if(strlen($error_message) > 0) { 
    died($error_message); 
  }
 
    $email_message = "Form details below.\n\n"; 
     
 
    function clean_string($string) { 
      $bad = array("content-type","bcc:","to:","cc:","href"); 
      return str_replace($bad,"",$string); 
    }
 
     
 
    $email_message .= "Name: ".clean_string($name)."\n"; 
    $email_message .= "E-Mail: ".clean_string($email_from)."\n"; 
    $email_message .= "Telefon: ".clean_string($phone)."\n"; 
    $email_message .= "Nachricht: ".clean_string($message)."\n";
 
     
 
     



$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=UTF-8";
$headers[] = "From: {$email_from}";
$headers[] = "Reply-To: {$email_from}";
$headers[] = "Subject: {$email_subject}";
$headers[] = "X-Mailer: PHP/".phpversion();

mail($email_to, $email_subject, $email_message, implode("\r\n",$headers));


?>
 
 
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
</head>

<body>
  <div id="main-wrapper">
    <header id="header">
    <div class="header-top-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-5 col-sm-12 col-xs-12">
            <div class="header-login">  </div>
            <!-- end .header-login --> 
          </div>
          <div class="col-md-7 col-sm-12 col-xs-12">
            <p class="call-us"> Tel: <a class="font" href="callto:+41566197673">+41 (0)56 619 76 73</a> <span class="open-now">E-Mail: <a href="mailto:info@getleads.ch">info@getleads.ch</a></span> </p>
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
            <a class="navbar-brand" href="http://getleads.ch/"> <img src="img/header-logo.png" alt="GetLeads"> </a> </div>
          
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li> <a href="http://getleads.ch/">Home</a></li>
              <li> <a href="http://getleads.ch/getleads.php">GetLeads</a></li>
              <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Solutions <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="gewinn-kampagne.php">Gewinn Kampagne</a></li>
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
      <div class="contact-us">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="contact-details">
              <h1>Herzlichen Dank!</h1>
<p>Wir haben Ihre Nachricht erhalten und werden uns bei Ihnen melden.</p> 

              </div>
              <!-- end .contact-details -->
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
 
 
 
<?php
 
}
 
?>
 
 








