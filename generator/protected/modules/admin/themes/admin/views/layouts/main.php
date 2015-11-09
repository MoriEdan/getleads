<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <?php
        Yii::app()->clientScript
                ->registerCoreScript('jquery')
                ->registerCssFile(Yii::app()->theme->baseUrl . '/css/bootstrap.css')
                ->registerCssFile(Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.css')
                ->registerCssFile(Yii::app()->theme->baseUrl . '/css/style.css')
        ?>
        <style type="text/css">
            body {
                padding-top: 70px;
                padding-bottom: 40px;
            }
        </style>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->theme->baseUrl; ?>/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->theme->baseUrl; ?>/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->theme->baseUrl; ?>/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->theme->baseUrl; ?>/ico/apple-touch-icon-57-precomposed.png">

<!--        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.7.2.min.js"></script>-->
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container" id="top-nav-bar">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse" id="top-nav-links">
                        <?php
                        $static_pages = array(
                            array('label' => 'Home', 'url' => array('/site/index')),
                            array('label' => 'Dashboard', 'url' => array('account/index'), 'visible' => (bool) Yii::app()->user->getState('is_admin')),
                            array(
                                'label' => 'QR <span class="caret"></span>',
                                'url' => '#',
                                'visible' => (bool) Yii::app()->user->getState('is_admin'),
                                'itemOptions' => array('class' => 'dropdown'),
                                'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
                                'submenuOptions' => array('class' => 'dropdown-menu'),
                                'items' => array(
                                    array('label' => 'List', 'url' => array('qr/list')),
                                )
                            ),
                            array(
                                'label' => 'Manage Pages <span class="caret"></span>',
                                'url' => '#',
                                'visible' => (bool) Yii::app()->user->getState('is_admin'),
                                'itemOptions' => array('class' => 'dropdown'),
                                'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
                                'submenuOptions' => array('class' => 'dropdown-menu'),
                                'items' => array(
                                    array('label' => 'List', 'url' => array('page/listing')),
                                    array('label' => 'Add new', 'url' => array('page/add')),
                                )
                            ),
                            array('label' => 'Users List', 'url' => array('user/list'), 'visible' => (bool) Yii::app()->user->getState('is_admin')),
                            array('label' => 'Manage Google Ads', 'url' => array('account/google_ads'), 'visible' => (bool) Yii::app()->user->getState('is_admin')),
                            array('label' => 'General Setting', 'url' => array('account/settings'), 'visible' => (bool) Yii::app()->user->getState('is_admin')),
                        );

                        $this->widget('zii.widgets.CMenu', array(
                            'encodeLabel' => false,
                            'items' => $static_pages,
                            'htmlOptions' => array(
                                'class' => 'nav',
                            ),
                        ));
                        ?>
                    </div><!--/.nav-collapse -->

                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'id' => 'my-account',
                        'encodeLabel' => false,
                        'items' => array(
                            array(
                                'label' => '<i class="icon-cog icon-white"></i> My Account <span class="caret"></span>',
                                'url' => '#',
                                'visible' => (bool) Yii::app()->user->getState('is_admin'),
                                'itemOptions' => array('class' => 'dropdown'),
                                'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
                                'submenuOptions' => array('class' => 'dropdown-menu'),
                                'items' => array(
                                    array('label' => '<i class="icon-edit"></i> Change Password', 'url' => array('account/change_password'),),
                                    array('label' => '<i class="icon-off"></i> Logout', 'url' => array('account/logout'),),
                                ),
                            ),
                        ),
                        'htmlOptions' => array(
                            'class' => 'nav pull-right',
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <?php if (isset($this->mad_updates['news'])): ?>
                        <div id="mad-news">
                            <?php echo $this->mad_updates['news'] ?>
                        </div>
                    <?php endif ?>
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
                    <?php echo $content; ?>
                </div><!--/span-->
            </div>

            <hr>

            <footer>
                <p>&copy; <?php echo date('Y') ?></p>
            </footer>

        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
        <script>
            $('a[rel="tooltip"]').tooltip();
        </script>
    </body>
</html>
