<?php

class CheckController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index','coupon','autoComplete','del','update'),
                'roles' => array('shop'),
            ),
            array('allow',
                'actions' => array('shops', 'add','update','del','delete','autoComplete'),
                'roles' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

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

        $this->render('index');
    }

    public function actionShops() {
//          $criteria = new CDbCriteria;
//          $criteria->condition="is_shop=1";
//	  $model = User::model()->findAll($criteria);
        $dataProvider = new CActiveDataProvider('User', array(
            'criteria' => array(
                'condition' => 'is_shop=1',
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));

        //$shops = $model->findAll(array('is_shop'=>'1'));
        $this->render('shops', array('dataProvider' => $dataProvider));
    }

    public function actionAdd() {
        $model = new User;
        $model->scenario = 'addShop';
        $userPost = array();
        if (Yii::app()->getRequest()->getIsAjaxRequest()) {

            echo CActiveForm::validate(array($model));

            Yii::app()->end();
        }

        if(Yii::app()->request->getIsPostRequest()){
            $userPost = Yii::app()->request->getPost('User');
           
           
        $model->attributes = Yii::app()->request->getPost('User');
        $model->password = md5($model->password);
        $model->is_companyadmin = (isset($userPost['is_companyadmin']) && $userPost['is_companyadmin'])?$userPost['is_companyadmin']:0;
        $model->is_active = 1;
        $model->email = '';
        $model->auth_code = '';
        if($model->save())
                 $this->redirect(array('check/shops'));
                

         }
        $this->render('add', array('model' => $model));
    }
      public function actionUpdate() {
        $model = new User;
        $model->scenario = 'updateShop';
        $userPost = array();
        $id = Yii::app()->request->getParam('id');
        if($id){
           $model= $model->findByPk($id);
        }
        if (Yii::app()->getRequest()->getIsAjaxRequest()) {

            echo CActiveForm::validate(array($model));

            Yii::app()->end();
        }

        if(Yii::app()->request->getIsPostRequest()){
             $userPost = Yii::app()->request->getPost('User');
        $model->attributes = Yii::app()->request->getPost('User');
         $model->is_companyadmin = (isset($userPost['is_companyadmin']) && $userPost['is_companyadmin'])?$userPost['is_companyadmin']:0;
        $model->email = '';
        $model->auth_code = '';
        if($model->save())
                 $this->redirect(array('check/shops'));
                

         }
        $this->render('update', array('model' => $model));
    }

    public function actionDelete() {
        $model = new User;
        $model->scenario = 'updateShop';
        $id = Yii::app()->request->getParam('id');
        if($id){
           $model= $model->deleteByPk($id);
             $this->redirect(array('check/shops'));
             Yii::app()->end();
        }
       
               
                

        
    }
     public function actionDel() {
        $model = new Usedcoupons;
        
        $id = Yii::app()->request->getParam('id');
        if($id){
           $model= $model->deleteByPk($id);
             $this->redirect(array('check/coupon'));
             Yii::app()->end();
        }
       
               
                

        
    }
     public function actionCoupon() {
        $model=new Usedcoupons;

    // uncomment the following code to enable ajax-based validation
    /*
    if(isset($_POST['ajax']) && $_POST['ajax']==='usedcoupons-coupon-form')
    {
        echo CActiveForm::validate($model);
        Yii::app()->end();
    }
    */
if(Yii::app()->request->getIsPostRequest())
    {
          $model->attributes = Yii::app()->request->getPost('Usedcoupons');
           $model->user_id = Yii::app()->user->id;
           $model->add_date = time();
        if($model->validate())
        {
            // form inputs are valid, do something here
            $model->save();
               $this->redirect(array('check/coupon'));
        }
    }
    $this->render('coupon',array('model'=>$model));
     }
    
     public function actionAutoComplete($term){
$model= new Usedcoupons;
    
    $query = $model->findAll(
   'coupon LIKE :match',
   array(':match' => "%$term%")
);
    $list = array();        
    foreach($query as $q){
        $data['value']= $q['id'];
        $data['label']= $q['coupon'];

        $list[]= $data;
        unset($data);
    }

    echo json_encode($list);
}
}
