<?php

class ChangePasswordForm extends CFormModel {

    public $old_password;
    public $password;
    public $password2;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('old_password, password, password2', 'required'),
            array('password', 'length', 'min' => 6, 'max' => 20),
            array('password2', 'compare', 'compareAttribute' => 'password'),
            array('old_password', 'OldPasswordValidator'),
        );
    }
    
        /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'old_password' => 'Old Password',
            'password' => 'Password',
            'password2' => 'Confirm Password',
        );
    }

    

}
