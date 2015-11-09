<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property string $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $parent_id
 * @property string $updated_at
 * @property string $created_at
 * @property integer $is_active
 */
class Page extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Page the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'page';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, content', 'required'),
            array('is_active', 'numerical', 'integerOnly' => true),
            array('title, slug', 'length', 'max' => 255),
            array('parent_id', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, slug, content, parent_id, updated_at, created_at, is_active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pages' => array(self::HAS_MANY, 'Page', 'parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'content' => 'Content',
            'parent_id' => 'Parent',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'is_active' => 'Is Active',
        );
    }
    
    public function beforeValidate() {
        parent::beforeValidate();
        
        // check if duplicate slug exists
        $slug = Utility::seoName($this->title);
        
        if($this->isNewRecord) {
            $page = $this->findByAttributes(array('slug' => $slug));
        }
        else {
            $page = $this->find('slug = :slug AND id <> :id', array(':slug' => $slug, ':id' => $this->id));
        }
        
        if($page) {
            $labels = $this->attributeLabels();
            $this->addError('title', 'Duplicate ' . $labels['title'] . ' exists.');
            return false;
        }
        
        return true;
    }

    public function beforeSave() {
        $this->slug = Utility::seoName($this->title);
        
        if ($this->isNewRecord) {
            $this->created_at = new CDbExpression('NOW()');
            $this->updated_at = new CDbExpression('NOW()');
        } else {
            $this->updated_at = new CDbExpression('NOW()');
        }
        
        return parent::beforeSave();
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('parent_id', $this->parent_id, true);
        $criteria->compare('updated_at', $this->updated_at, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('is_active', $this->is_active);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}