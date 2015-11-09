<?php

class AccountController extends AdminController {

    public function actions() {
        return array(
            'change_password' => 'application.controllers.ChangePasswordAction',
        );
    }

    public function actionSettings() {
         $model = new SettingsForm();

        // collect user input data
        if (isset($_POST['SettingsForm'])) {
            if($_POST['SettingsForm']['BITLY_API_KEY'] && $_POST['SettingsForm']['BITLY_LOGIN']) {
                $model->setScenario('validate_bitly');
            }
            
            $model->attributes = $_POST['SettingsForm'];
            
            if ($model->validate()) {
                $model->save();
            }
        }
        
        $this->render('settings', array('formModel' => $model));
    }

    public function actionGoogle_ads() {
         $model = new GoogleAdsForm();

        // collect user input data
        if (isset($_POST['GoogleAdsForm'])) {
            $model->attributes = $_POST['GoogleAdsForm'];
            if ($model->validate()) {
                $model->save();
            }
        }
        
        $this->render('google_ads', array('formModel' => $model));
    }
    
    public function actionIndex() {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/flotr2/flotr2.min.js');

        $recent_5_users = User::model()->findAll(array(
            'condition' => 'id <> 1',
            'order' => 'id desc',
            'limit' => 5,
        ));

        

        $this->render('index', array(
            'recent_5_users' => $recent_5_users,
        ));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new AdminLoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['AdminLoginForm'])) {
            $model->attributes = $_POST['AdminLoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect($this->createUrl('index'));
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
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

}