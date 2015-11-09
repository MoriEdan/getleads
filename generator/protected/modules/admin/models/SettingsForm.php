<?php

/**
 * SettingsForm class.
 */
class SettingsForm extends CFormModel {

    public $DEFAULT_SORT;
    public $DEFAULT_ORDER;
    public $BITLY_LOGIN;
    public $BITLY_API_KEY;
    public $BITLY_USE;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('DEFAULT_SORT', 'in', 'range' => array('t.rating', 't.created_at')),
            array('DEFAULT_ORDER', 'in', 'range' => array('asc', 'desc')),
            array('BITLY_LOGIN, BITLY_API_KEY', 'validate_bitly', 'on' => 'validate_bitly'),
            array('BITLY_USE', 'safe'),
        );
    }
    
    public function validate_bitly($attributes, $params) {
        $out = json_decode(Yii::app()->CURL->run('http://api.bit.ly/shorten?version=2.0.1&login=' . $this->BITLY_LOGIN . '&apiKey=' . $this->BITLY_API_KEY . '&format=json'));
        if($out->errorMessage == 'INVALID_LOGIN') {
            $this->addError('BITLY_USE','Incorrect bitly details.');
        }
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'DEFAULT_SORT' => 'Sorting By',
            'DEFAULT_ORDER' => 'Order By',
            'BITLY_NAME' => 'Bitly Login',
            'BITLY_API_KEY' => 'Bitly API Key',
            'BITLY_USE' => 'Use Bitly Service?',
        );
    }

    public function init() {
        parent::init();

        foreach($this->getAttributes() as $prop => $value) {
            if($attr = SiteVariable::model()->findByPk($prop))
                $this->$prop = $attr->value;
        }
    }

    public function save() {
        foreach($this->getAttributes() as $prop => $value) {
            $setting = SiteVariable::model()->findByPk($prop);
            if(!$setting) {
                $setting = new SiteVariable();
                $setting->variable = $prop;
                $setting->title = $this->getAttributeLabel($prop);
            }
            $setting->value = $this->$prop;
//            print_r($this);exit;
            $setting->save(false);
        }
    }

}
