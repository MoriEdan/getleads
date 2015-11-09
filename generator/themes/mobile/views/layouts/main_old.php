<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/mytheme.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/jquery.mobile.structure-1.1.1.min.css" rel="stylesheet">

        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/ico/apple-touch-icon-57-precomposed.png">

        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/jquery.mobile-1.1.1.min.js"></script>
    </head>

    <body>
        <div data-role="page">
            <div data-role="header">
                <h1></h1>
            </div><!-- /header -->

            <div data-role="content">	
                <p>
                    <?php echo $content; ?>
                </p>
            </div><!-- /content -->

            <div data-role="footer" data-position="fixed">
                <h4>&copy; <?php echo date('Y') . ' <a href="' . Yii::app()->homeUrl . '">' . Yii::app()->name . '</a>' ?></h4>
            </div><!-- /footer -->
        </div><!-- /page -->
    </body>
</html>
