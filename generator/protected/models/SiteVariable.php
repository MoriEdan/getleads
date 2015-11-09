<?php

/**
 * This is the model class for table "site_variable".
 *
 * The followings are the available columns in table 'site_variable':
 * @property string $variable
 * @property string $title
 * @property string $value
 */
class SiteVariable extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SiteVariable the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'site_variable';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('variable, title, value', 'required'),
            array('variable', 'length', 'max' => 32),
            array('title', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('variable, title, value', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'variable' => 'Variable',
            'title' => 'Title',
            'value' => 'Value',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('variable', $this->variable, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('value', $this->value, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    
    public static function get($variable, $default = '') {
        $variable = strtoupper($variable);
        
        if($rec = self::model()->findByPk($variable)) {
            return $rec->value;
        }
        
        return $default;
    }

}