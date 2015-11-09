<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php
        Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_END;
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/jquery2.1.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/jquery-migrate.js', CClientScript::POS_HEAD);

        Yii::app()->clientScript
                ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/rhinoslider-1.05/js/mousewheel.js', CClientScript::POS_HEAD)
                ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/rhinoslider-1.05/js/rhinoslider-1.05.min.js', CClientScript::POS_HEAD)
                ->registerCssFile(Yii::app()->theme->baseUrl . '/assets/js/rhinoslider-1.05/css/rhinoslider-1.05.css', CClientScript::POS_HEAD)
        ;
        ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/jquery.Jcrop.js') ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/css/jquery.Jcrop.css') ?>
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
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/apple-touch-icon-57-precomposed.png">

        <?php
        //Yii::app()->clientScript->registerCoreScript('jquery'); 

        Yii::app()->clientScript->scriptMap = array('jquery.js' => false);
        ?>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap-colorpicker.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap.min.js"></script>
    </head>

    <body class="<?php if ($this->header_id == 'header-bg2') echo 'inner-page'; ?>">
        <?php if ($this->header_id == 'header-bg2'): ?>
            <div id="header-top"></div>
        <?php endif ?>
        <div id="<?php echo $this->header_id ?>"></div>
        <div id="main-wrapper">
            <header id="header">
                <div class="header-nav-bar">
                    <div class="container">
                        <nav class="navbar navbar-default" role="navigation">

                            <div class="container-fluid"> 

                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>

                                    <a class="navbar-brand" href="http://getleads.ch/"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/header-logo.png" alt="GetLeads"> </a> </div>

                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" aria-expanded="false" style="height: 1px;">
                                    <?php
                                    $this->widget('zii.widgets.CMenu', array(
                                        'encodeLabel' => false,
                                        'items' => array(
                                            array('label' => Yii::t('dict', 'Scans'), 'url' => array('/scans/index'), 'visible' => (isset(Yii::app()->user->role) && Yii::app()->user->role === 'shop' && Yii::app()->user->getState('is_companyadmin') == 1)),
                                            array('label' => Yii::t('dict', 'Codes'), 'url' => array('/check/coupon'), 'visible' => (isset(Yii::app()->user->role) && Yii::app()->user->role === 'shop')),
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
                                                )
                                            ),
                                            array('label' => '<i class="icon-off"></i> ' . Yii::t('dict', 'Logout'), 'url' => array('/user/logout'), 'visible' => !Yii::app()->user->isGuest),
                                        ),
                                        'htmlOptions' => array(
                                            'class' => 'nav navbar-nav navbar-right',
                                        ),
                                    ));
                                    ?>
                                    <?php
                                    $static_pages = array(array('label' => Yii::t('dict', 'Home'), 'url' => array('/'), 'visible' => (isset(Yii::app()->user->role) && Yii::app()->user->role !== 'shop')));
                                    $static_pages[] = array('label' => Yii::t('dict', 'My Codes'), 'url' => array('/qr/list'), 'visible' => (isset(Yii::app()->user->role) && Yii::app()->user->role !== 'shop'));
                                    $static_pages[] = array('label' => Yii::t('dict', 'QR Generator'), 'url' => array('/qr/generate', 'type' => 'transparent'), 'visible' => (isset(Yii::app()->user->role) && Yii::app()->user->role !== 'shop'));
                                    $static_pages[] = array('label' => Yii::t('dict', 'Gallery'), 'url' => array('/qr/gallery'), 'visible' => (isset(Yii::app()->user->role) && Yii::app()->user->role !== 'shop'));
                                    $static_pages[] = array('label' => Yii::t('dict', 'Companies'), 'url' => array('/check/shops'), 'visible' => (isset(Yii::app()->user->role) && Yii::app()->user->role === 'admin'));
                                    // $static_pages[] = array('label' => Yii::t('dict', 'Scans'), 'url' => array('/scans/index'),'visible' => (isset(Yii::app()->user->role) && Yii::app()->user->role === 'shop'));
                                    //$static_pages[] = array('label' => Yii::t('dict', 'Codes'), 'url' => array('/qr/list'),'visible' => (isset(Yii::app()->user->role) && Yii::app()->user->role === 'shop'));
                                    if ($this->pages) {
                                        foreach ($this->pages as $page) {
                                            $static_pages[] = array('label' => CHtml::encode($page->title), 'url' => array('/site/page/' . $page->slug));
                                        }
                                    }

                                    //$static_pages[] = array('label' => Yii::t('dict', 'Contact'), 'url' => array('/site/contact'),'visible' => !Yii::app()->user->isGuest);
                                    $this->widget('zii.widgets.CMenu', array(
                                        'items' => $static_pages,
                                        'htmlOptions' => array(
                                            'class' => 'nav navbar-nav navbar-right',
                                        ),
                                    ));
                                    ?>
                                </div>
                            </div>
                        </nav>
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
            <div class="container-fluid">
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



                    </div>

                </div>

            </div>

            <div class="footer-copyright">

                <div class="container">

                    <p>Copyright © 2013 - <?php echo date('Y'); ?> getleads.ch. All rights reserved. Powered by <a href="http://www.opsag.ch">opsag.ch</a>.

                        <a href="impressum.php">Impressum</a></p>

                    <ul class="footer-social">

                        <li><a href="https://www.facebook.com/pages/Getleads/447169438756498"><i class="fa fa-facebook-square"></i></a> </li>

                        <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>

                    </ul>

                    <!-- end .footer-social -->

                </div>

            </div>

        </footer>
    </body>
</html>
