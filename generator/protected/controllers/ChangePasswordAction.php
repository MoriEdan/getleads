<?php
class ChangePasswordAction extends CAction {
    public function run() {
        
        $formModel = new ChangePasswordForm();
        
        if(isset($_POST['ChangePasswordForm'])){
            $formModel->attributes = $_POST['ChangePasswordForm'];
            if($formModel->validate()) {
                $user = User::model()->findByPk(Yii::app()->user->getId());
                $user->password = md5($formModel->password);
                $user->save(false);
                Utility::setFlash('Password changed successfully.', 'success');
            }
        }
        
        $this->getController()->render('change_password', array('formModel' => $formModel));
    }
}