<?php

class OldPasswordValidator extends CValidator {
    
    protected function validateAttribute($object, $attribute) {
        $value = $object->$attribute;
        $user = User::model()->findByAttributes(array('password' => md5($value), 'id' => Yii::app()->user->getId()));
        if (empty($user)) {
            $message = $this->message !== null ? $this->message : Yii::t('yii', 'Old password does not match.');
            $this->addError($object, $attribute, $message);
        }
    }

}
