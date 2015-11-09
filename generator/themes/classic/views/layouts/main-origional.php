<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
		<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap123.css" rel="stylesheet">

        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/style123.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/colorpicker.css" rel="stylesheet">
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements 
		   <link href='http://fonts.googleapis.com/css?family=Engagement' rel='stylesheet' type='text/css'>-->
     
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/apple-touch-icon-57-precomposed.png">

        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap-colorpicker.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap.min.js"></script>
    </head>

    <body class="<?php if($this->header_id == 'header-bg2')  echo 'inner-page'; ?>">
        <?php if($this->header_id == 'header-bg2'): ?>
            <div id="header-top"></div>
        <?php endif ?>
        <div id="<?php echo $this->header_id ?>"></div>
       <div id="main-wrapper">
			<header id="header">
           <div class="header-nav-bar">

      <nav class="navbar navbar-default" role="navigation">

        <div class="container"> 
			
				<div class="navbar-header">

           
            <a class="navbar-brand" href="http://getleads.ch/"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/header-logo.png" alt="GetLeads"> </a> </div>
                       
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <?php
                            $this->widget('zii.widgets.CMenu', array(
                                'encodeLabel' => false,
								
                                'items' => array(
                                    array('label' => Yii::t('dict', 'Login'), 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                                  //  array('label' => Yii::t('dict', 'Register'), 'url' => array('/user/register'), 'visible' => !Yii::app()->user->isGuest),
                                    array(
                                        'label' => '<i class="icon-cog icon-white"></i> ' . Yii::t('dict', 'My Account'),
                                        'url' => '#',
                                        'visible' => !Yii::app()->user->isGuest,
                                        'itemOptions' => array('class' => 'dropdown', 'id' => 'my-account'),
                                        'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
                                        'submenuOptions' => array('class' => 'dropdown-menu'),
                                        'items' => array(
                                            array('label' => '<i class="icon-edit"></i> ' . Yii::t('dict', 'Change Password'), 'url' => array('/user/change_password')),
                                            array('label' => '<i class="icon-off"></i> ' . Yii::t('dict', 'Logout'), 'url' => array('/user/logout')),
                                        )
                                    ),
                                ),
                                'htmlOptions' => array(
                                    'class' => 'nav navbar-nav navbar-right',
                                ),
                            ));
                            ?>
							 <?php
                        $static_pages = array(array('label' => Yii::t('dict', 'Home'), 'url' => array('/site/index'),'visible' => !Yii::app()->user->isGuest));
                            $static_pages[] = array('label' => Yii::t('dict', 'My Codes'), 'url' => array('/qr/list'), 'visible' => !Yii::app()->user->isGuest);
                            $static_pages[] = array('label' => Yii::t('dict', 'QR Generator'), 'url' => array('/qr/choose'),'visible' => !Yii::app()->user->isGuest);
                            $static_pages[] = array('label' => Yii::t('dict', 'Gallery'), 'url' => array('/qr/gallery'),'visible' => !Yii::app()->user->isGuest);
                       
                        if ($this->pages) {
                            foreach ($this->pages as $page) {
                                $static_pages[] = array('label' => CHtml::encode($page->title), 'url' => array('/site/page/' . $page->slug));
                            }
                        }

                        $static_pages[] = array('label' => Yii::t('dict', 'Contact'), 'url' => array('/site/contact'),'visible' => !Yii::app()->user->isGuest);
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => $static_pages,
                            'htmlOptions' => array(
                                'class' => 'nav navbar-nav navbar-right',
                            ),
                        ));
                        ?>
                        </div>
                    </div>

                </div>
           </header>


            <?php
            if (Utility::hasFlash('error')) {
                foreach (Utility::getFlash('error') as $message) {

                    echo '<div class="alert alert-error">
                                            <button class="close" data-dismiss="alert">×</button>
                                            ' . $message . '
                                        </div>';
                }
            }
            ?>
            <?php
            if (Utility::hasFlash('success')) {
                foreach (Utility::getFlash('success') as $message) {

                    echo '<div class="alert alert-success">
                                            <button class="close" data-dismiss="alert">×</button>
                                            ' . $message . '
                                        </div>';
                }
            }
            ?>
            <div class=" container">
            <?php echo $content; ?>
			</div>
        </div> <!-- /container -->
        <script>
            $('a[rel="tooltip"]').tooltip();
        </script>
        <footer id="footer">

  <div class="container">

    <div class="main-footer">

      <div class="row">

        <div class="col-sm-6 col-md-3"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/header-logo.png" alt="">

          <p>Wir wissen, dass es bei der Kundenbindung darum geht, Kunden gute Lösungen zu bieten, damit sie für Ihren Service entscheiden.</p>

        </div>

        <div class="col-sm-6 col-md-3">

          <h5>Quick Links</h5>

          <div class="row">

            <div class="col-md-6">

              <ul class="footer-links padd">

                <li><a href="http://getleads.ch/">Home</a> </li>

                <li><a href="gewinn-kampagne.php">Gewinn Kampagne</a> </li>

                <li><a href="corporate-qr.php">Corporate QR</a> </li>

              </ul>

            </div>

            <div class="col-md-6">

              <ul class="footer-links">

                <li><a href="getleads.php">GetLeads</a> </li>

                <li><a href="buchen.php">Buchen</a> </li>

                <li><a href="kontakt.php">Kontakt</a> </li>

              </ul>

            </div>

          </div>

        </div>

        <div class="col-sm-6 col-md-3">

          <h5>Latest Tweets <span><i class="fa fa-chevron-left"></i> <i class="fa fa-chevron-right"></i> </span> </h5>

          <p><a href="#">GetLeads:</a> Take a (Photo) Tour of #Envato's #Melbourne Headquarters (...) <br>

            <span>7 hours ago</span> </p>

        </div>

        <div class="col-sm-6 col-md-3">

          <h5>Newsletter</h5>

          <p>Sign up for our newsletter!</p>

          <div class="footer-subscribe">

            <form>

              <input type="Email" placeholder="Email address...">

              <button type="submit" value=""><i class="fa fa-plus-circle-o"></i></button>

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div class="footer-copyright">

    <div class="container">

      <p>Copyright © 2013 - 2014 getleads.ch. All rights reserved. Powered by <a href="http://www.opsag.ch">Online Portal Service AG</a>.

        <a href="impressum.php">Impressum</a></p>

      <ul class="footer-social">

        <li><a href="https://www.facebook.com/pages/Getleads/447169438756498"><i class="fa fa-facebook-square"></i></a> </li>

        <li><a href="#"><i class="fa fa-twitter-square"></i></a> </li>

      </ul>

      <!-- end .footer-social -->

    </div>

  </div>

</footer>
    </body>
</html>
