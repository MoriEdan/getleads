<?php

/**
 * This is the model class for table "log".
 *
 * The followings are the available columns in table 'log':
 * @property string $id
 * @property string $qr_id
 * @property string $brand_name
 * @property string $model_name
 * @property string $marketing_name
 * @property string $device_os
 * @property string $device_os_version
 * @property string $browser
 * @property string $browser_version
 * @property string $user_agent
 * @property string $ip
 * @property string $created_at
 */
class Log extends CActiveRecord {
    public $count;
    public $date;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Log the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('brand_name, model_name, marketing_name, device_os, device_os_version, browser, browser_version, user_agent, ip, created_at', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'qr' => array(self::BELONGS_TO, 'Qr', 'qr_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'qr_id' => 'Qr',
            'brand_name' => 'Brand Name',
            'model_name' => 'Model Name',
            'marketing_name' => 'Marketing Name',
            'device_os' => 'Device Os',
            'device_os_version' => 'Device Os Version',
            'browser' => 'Browser',
            'browser_version' => 'Browser Version',
            'user_agent' => 'User Agent',
            'ip' => 'IP Address',
            'created_at' => 'Created At',
        );
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->brand_name = Yii::app()->wurfl->device->getCapability('brand_name');
            $this->model_name = Yii::app()->wurfl->device->getCapability('model_name');
            $this->marketing_name = Yii::app()->wurfl->device->getCapability('marketing_name');
            $this->device_os = Yii::app()->wurfl->device->getCapability('device_os');
            $this->device_os_version = Yii::app()->wurfl->device->getCapability('device_os_version');
            $this->browser = Yii::app()->wurfl->device->getCapability('mobile_browser');
            $this->browser_version = Yii::app()->wurfl->device->getCapability('mobile_browser_version');
            $this->user_agent = Yii::app()->request->userAgent;
            $this->ip = Yii::app()->request->userHostAddress;
            $this->created_at = new CDbExpression('NOW()');
            
            if(empty($this->browser) && empty($this->device_os)) {
                $browser = new EWebBrowser();
                $this->brand_name = $browser->platform;
                $this->browser = $browser->browser;
                $this->browser_version = $browser->version;
            }
        }

        return parent::beforeSave();
    }

}