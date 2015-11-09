<?php

class RegisterForm extends CFormModel {

    public $username;
    public $password;
    public $password2;
    public $first_name;
    public $last_name;
    public $email;
    public $verifyCode;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('username, password, password2, first_name, last_name, email, verifyCode', 'required'),
            array('username', 'length', 'min' => 3, 'max' => 15),
            array('username','unique', 'className' => 'User'),
            array('password', 'length', 'min' => 6, 'max' => 20),
            array('password2', 'compare', 'compareAttribute'=>'password'),
            array('email', 'email'),
            array('email','unique', 'className' => 'User'),
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'username' => 'Username',
            'password' => 'Password',
            'password2' => 'Confirm Password',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'E-mail',
            'verifyCode' => 'Verification Code',
        );
    }

}
