<?php

class UserController extends AdminController {

    public function actionExport() {
        Yii::import('ext.ECSVExport');
        $criteria = new CDbCriteria(array(
            'condition' => 'id <> 1',
        ));

        $output = array();
        $users = User::model()->findAll($criteria);
        if ($users) {
            foreach ($users as $row) {
                $output[] = array(
                    'Username' => $row->username,
                    'First Name' => $row->first_name,
                    'Last Name' => $row->last_name,
                    'Email' => $row->email,
                    'Registered At' => $row->created_at,
                );
            }
        }

        $csv = new ECSVExport($output);
        $content = $csv->toCSV();
        Yii::app()->getRequest()->sendFile('users-list.csv', $content, "text/csv", false);
        Yii::app()->end();
    }

    public function actionToggleActive() {
        $id = Yii::app()->request->getParam('id');
        $user = User::model()->findByPk($id);
        $user->saveAttributes(array('is_active' => !$user->is_active));
        Utility::setFlash('User ' . ($user->is_active ? 'activated' : 'inactivated') . ' successfully', 'success');
        $this->redirect(Yii::app()->createUrl('/admin/user/list'));
    }

    public function actionDelete() {
        $id = Yii::app()->request->getParam('id');
        $user = User::model()->findByPk($id);
        $user->delete();
        Utility::setFlash('User deleted successfully', 'success');
        $this->redirect(Yii::app()->createUrl('/admin/user/list'));
    }

    public function actionList() {
        $limit = 20;

        $q = new CDbCriteria(array(
            'select' => 'user.*, (SELECT COUNT(*) FROM qr WHERE qr.user_id = user.id ) qcount',
            'condition' => 'user.id <> 1',
            'alias' => 'user',
        ));

        $this->addDefaultCriteria($q, array('limit' => $limit, 'order' => 'user.created_at', 'sort' => 'DESC'));

        $users = User::model()->findAll($q);

        $count = User::model()->count($q);
        $pages = new CPagination($count);

        // results per page
        $pages->pageSize = $limit;
        $pages->applyLimit($q);

        $this->render('list', array(
            'users' => $users,
            'pages' => $pages,
        ));
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