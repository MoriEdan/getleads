<?php

class UserController extends Controller {
public $defaultAction = 'login';

    public function actions() {
        return array(
            'change_password' => 'application.controllers.ChangePasswordAction',
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }


    public function filters() {
        return array('accessControl');
    }

    public function accessRules() {
        return array(
            array('deny', 'actions' => array('change_password'), 'users' => array('?')),
        );
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;
if(Yii::app()->user->id){
    $this->redirect(array('qr/list'));
}
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->_associateQrsInSession();
                if(Yii::app()->user->role == 'shop'){
                 $this->redirect(Yii::app()->createUrl('check/coupon'));   
                }else{
               // $this->redirect(Yii::app()->user->returnUrl);
                $this->redirect(array('qr/list'));
                }
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }
    
    protected function _associateQrsInSession($user = null) {
        $qrs = Qr::getInSession();
        if($qrs) {
            if($user instanceof User) {
                $userId = $user->id;
            }
            else {
                $userId = Yii::app()->user->getId();
            }
            foreach($qrs as $id) {
                if($qr = Qr::model()->findByPk($id)) {
                    $qr->user_id = $userId;
                    $qr->save();
                }
            }
        }
    }

    /**
     * Displays the registeration page
     */
    public function actionRegister() {
        $model = new RegisterForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'register-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['RegisterForm'])) {
            $model->attributes = $_POST['RegisterForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate()) {
                $user = new User();
                $user->attributes = $_POST['RegisterForm'];
                $user->password = md5($user->password);
                $user->auth_code = md5(uniqid());
                if ($user->save(false)) {
                    $this->_associateQrsInSession($user);
                    
                    $message = new MyYiiMailMessage();
                    $message->view = 'registeration';

                    //userModel is passed to the view
                    $message->setBody(array(
                        'model' => $user,
                        'verify_url' => $this->createAbsoluteUrl('user/email_verify', array('code' => $user->auth_code,))
                            ), 'text/html');


                    $message->addTo($user->email);
                    $message->setFrom(array(Yii::app()->params['adminEmail'] => Yii::app()->name));
                    $message->setSubject('Thank You!');
                    Yii::app()->mail->send($message);
                    Utility::setFlash('Successfully registerd! One of our admins will activate you.', 'success');
                    $this->redirect(Yii::app()->homeUrl);
//                    echo $message->getBody();exit;
                }
            }
        }
        // display the registeration form
        $this->render('register', array('model' => $model));
    }

    public function actionEmail_verify() {
        $code = trim(Yii::app()->request->getQuery('code'));
        if ($code) {
            $user = User::model()->findByAttributes(array('auth_code' => $code));
            if ($user) {
                $user->is_active = 1;
                $user->auth_code = md5(uniqid());
                $user->save();
                Utility::setFlash('Your email has been verified. Please login below.', 'success');
                Yii::app()->request->redirect('login');
            }
        }
        echo 'invalid code';
        Yii::app()->end();
    }


    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect("/generator/user/login");
    }
    
    public function actionProfile($id) {
        $user = $this->loadModel($id);
        $this->render('profile', array('user' => $user));
    }
    
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'User not found.');
        }
        return $model;
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}