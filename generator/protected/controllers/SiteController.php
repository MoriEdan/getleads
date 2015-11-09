<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $gallery = Qr::model()->findAll(array(
            'condition' => 't.show_in_gallery = 1 AND t.user_id > 0',
            'limit' => Yii::app()->params['home_gallery_count'],
            'order' => 't.id DESC',
                ));

        $this->render('index', array(
            'gallery' => $gallery,
        ));
    }

    public function actionPage_cms($slug) {
        $page = Page::model()->findByAttributes(array('slug' => $slug));

        if ($page === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        $this->render('page', array(
            'page' => $page,
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $view = Yii::app()->errorHandler->error['code'] == 404 ? 'error404' : 'error';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render($view, $error);
            }
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContactold() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

}