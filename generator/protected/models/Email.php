<?php

/**
 * This is the model class for table "email".
 *
 * The followings are the available columns in table 'email':
 * @property integer $id
 * @property string $email_id
 * @property string $timestamp
 * @property string $ip
 * @property string $browser
 * @property string $created_at
 * @property string $modified_at
 * @property integer $status
 */
class Email extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Email the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'email';
	}
        
        public function beforeSave() {
          
            return parent::beforeSave();
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email_id, timestamp, ip, browser, created_at', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('email_id, ip, browser', 'length', 'max'=>256),
			array('modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email_id, timestamp, ip, browser, created_at, modified_at, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email_id' => 'Ihre E-Mail',
			'timestamp' => 'Timestamp',
			'ip' => 'Ip',
			'browser' => 'Browser',
			'created_at' => 'Created At',
			'modified_at' => 'Modified At',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('timestamp',$this->timestamp,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('browser',$this->browser,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}