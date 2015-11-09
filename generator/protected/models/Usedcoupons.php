<?php

/**
 * This is the model class for table "usedcoupons".
 *
 * The followings are the available columns in table 'usedcoupons':
 * @property integer $id
 * @property integer $user_id
 * @property string $coupon
 * @property string $citycode
 * @property integer $add_date
 */
class Usedcoupons extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usedcoupons the static model class
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
		return 'usedcoupons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                     array('coupon,citycode', 'required'),
			array('user_id, add_date', 'numerical', 'integerOnly'=>true),
			array('coupon', 'length', 'max'=>255),
			array('citycode', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, coupon, citycode, add_date', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'coupon' => 'Coupon',
			'citycode' => 'City code',
			'add_date' => 'Add Date',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('coupon',$this->coupon,true);
		$criteria->compare('citycode',$this->citycode,true);
		$criteria->compare('add_date',$this->add_date);
if(isset(Yii::app()->user->id)&& Yii::app()->user->id!='' && Yii::app()->user->getState('role')==='shop'){
    $criteria->addCondition('user_id='.Yii::app()->user->id);
}
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}