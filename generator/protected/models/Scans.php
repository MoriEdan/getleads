<?php

/**
 * This is the model class for table "scans".
 *
 * The followings are the available columns in table 'scans':
 * @property string $id
 * @property string $ip
 * @property string $scan
 * @property string $browser
 * @property string $platform
 * @property string $client
 * @property integer $counter
 */
class Scans extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Scans the static model class
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
		return 'scans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('scan, client, counter', 'required'),
			array('counter', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>15),
			array('browser, client', 'length', 'max'=>50),
			array('platform', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ip, scan, browser, platform, client, counter, qrtitle', 'safe', 'on'=>'search'),
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
			'ip' => 'Ip',
			'scan' => 'Scan',
			'browser' => 'Browser',
			'platform' => 'Platform',
			'client' => 'Client',
			'counter' => 'Counter',
                        'qrtitle'=> 'Title',
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
               	$criteria->compare('id',$this->id,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('scan',$this->scan,true);
		$criteria->compare('browser',$this->browser,true);
		$criteria->compare('platform',$this->platform,true);
		$criteria->compare('client',$this->client,true);
                $criteria->compare('qrtitle',$this->qrtitle,true);
		$criteria->compare('counter',$this->counter);
if(Yii::app()->user->getState('company')!=''){
     $criteria->addCondition("client='".Yii::app()->user->getState('company')."'");
   
}

      return  new CActiveDataProvider($this, array('criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => array(
                    'scan'=>CSort::SORT_DESC,)
            ),
            'pagination' => array('pageSize' => 20,)
        ));
		
	}
        public function myDataProvider()
{

    $dataProvider=new CActiveDataProvider('Scans', array(
        'criteria'=>array(
            'condition'=>'scan=2',
        ),
        'pagination'=>array(
            'pageSize'=>20,
        ),
    ));

    return $dataProvider;

}
}