<?php
class WebUser extends CWebUser {
    public function checkAccess($operation, $params = array()) {
//        if(Yii::app()->user->getState('role') === 'admin') {
//            return true;
//        }
//        else if($operation == 'ownQr') {
//            $id = Yii::app()->request->getParam('id');
//            
//            if(Qr::isInSession($id)) {
//               return true;
//            }
//            else if($qr = Qr::model()->findByPk($id)) {
//                return Yii::app()->user->getId() == Qr::model()->findByPk($id)->user_id;
//            }
//            else {
//                return false;
//            }
//        }
//        
//        return false;
        if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }
        $role = $this->getState("role");
        if ($role === 'admin') {
            return true; // admin role has access to everything
        }
        if($operation == 'ownQr') {
            $id = Yii::app()->request->getParam('id');
            
            if(Qr::isInSession($id)) {
               return true;
            }
            else if($qr = Qr::model()->findByPk($id)) {
                return Yii::app()->user->getId() == Qr::model()->findByPk($id)->user_id;
            }
            else {
                return false;
            }
        }
        // allow access if the operation request is the current user's role
        return ($operation === $role);
    }
}