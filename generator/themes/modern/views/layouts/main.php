<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href='http://fonts.googleapis.com/css?family=Engagement' rel='stylesheet' type='text/css'>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/non-responsive.css" rel="stylesheet">

        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/style.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/colorpicker.css" rel="stylesheet">
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap-colorpicker.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap.min.js"></script>
    </head>

    <body>
                        <?php
                        $static_pages = array(array('label' => Yii::t('dict', 'Home'), 'url' => array('/site/index')));
                        if($this->header_id == 'header-bg2') {
                            $static_pages[] = array('label' => Yii::t('dict', 'My Codes'), 'url' => array('/qr/list'), 'visible' => !Yii::app()->user->isGuest);
                            $static_pages[] = array('label' => Yii::t('dict', 'QR Generator'), 'url' => array('/qr/generate'),);
                            $static_pages[] = array('label' => Yii::t('dict', 'Gallery'), 'url' => array('/qr/gallery'),);
                        }

                        if ($this->pages) {
                            foreach ($this->pages as $page) {
                                $static_pages[] = array('label' => CHtml::encode($page->title), 'url' => array('/site/page/' . $page->slug));
                            }
                        }
                        
                        $static_pages[] = array('label' => Yii::t('dict', 'Contact'), 'url' => array('/site/contact'));
                        ?>
                        <nav id="top-nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
                            <div class="container">
                            <?php
                            $this->widget('zii.widgets.CMenu', array(
                                'items' => $static_pages,
                                'htmlOptions' => array(
                                    'class' => 'nav navbar-nav',
                                ),
                            ));
                            ?>
        
                            <?php
                            $this->widget('zii.widgets.CMenu', array(
                                'encodeLabel' => false,
                                'items' => array(
                                    array('label' => '<i class="glyphicon glyphicon-log-in"></i> ' . Yii::t('dict', 'Login'), 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                                    array('label' => '<i class="glyphicon glyphicon-user"></i> ' . Yii::t('dict', 'Register'), 'url' => array('/user/register'), 'visible' => Yii::app()->user->isGuest),
                                    array(
                                        'label' => '<i class="glyphicon glyphicon-cog glyphicon-white"></i> ' . Yii::t('dict', 'My Account'),
                                        'url' => '#',
                                        'visible' => !Yii::app()->user->isGuest,
                                        'itemOptions' => array('class' => 'dropdown', 'id' => 'my-account'),
                                        'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
                                        'submenuOptions' => array('class' => 'dropdown-menu'),
                                        'items' => array(
                                            array('label' => '<i class="glyphicon glyphicon-edit"></i> ' . Yii::t('dict', 'Change Password'), 'url' => array('/user/change_password')),
                                            array('label' => '<i class="glyphicon glyphicon-off"></i> ' . Yii::t('dict', 'Logout'), 'url' => array('/user/logout')),
                                        )
                                    ),
                                ),
                                'htmlOptions' => array(
                                    'class' => 'nav navbar-nav navbar-right',
                                ),
                            ));
                            ?>
                            </div>
                        </nav>


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
        </div> <!-- /container -->
        <script>
            $('a[rel="tooltip"]').tooltip();
        </script>
    </body>
</html>
