<?php

class QrTransparentForm extends CFormModel {

    public $file;

    public function rules() {
        return array(
            array('file', 'required'),
            array('file', 'file', 'types'=>'jpg,jpeg,gif,png'),
        );
    }

    public function attributeLabels() {
        return array(
            'file' => Yii::t('yii', 'Image'),
        );
    }

}