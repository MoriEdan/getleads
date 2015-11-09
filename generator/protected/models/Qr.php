<?php

/**
 * This is the model class for table "qr".
 *
 * The followings are the available columns in table 'qr':
 * @property string $id
 * @property string $title
 * @property string $data
 * @property string $type
 * @property string $qr_type
 * @property string $user_id
 * @property string $dot
 * @property string $frame_dot
 * @property string $frame
 * @property string $frameColor
 * @property string $frame_dotColor
 * @property string $dotColor
 * @property string $backgroundColor
 * @property string $tag_url
 * @property string $show_in_gallery
 * @property string $created_at
 * @property string $updated_at
 */
class Qr extends CActiveRecord {

    public $hitCount;
    public $qrData;
    
    public static $supported_types = array(
        'text' => 'Text',
        'website' => 'Website',
        'facebook_profile' => 'Facebook Profile',
        'facebook_like' => 'Facebook Like',
        'twitter_profile' => 'Twitter Profile',
        'twitter_status' => 'Twitter Status',
        'linkedin_profile' => 'linkedin_profile',
        'linkedin_share' => 'linkedin_share',
        'telephone' => 'Telephone',
        'sms' => 'SMS',
        'email' => 'Email',
        'email_msg' => 'Email Message',
        'vcard' => 'VCard',
        'mecard' => 'MeCard',
    );

    public function init() {
        parent::init();
        $this->qrData = new stdClass();
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Qr the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'qr';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('data, type', 'required'),
           // array('title', 'length', 'max' => 255),
            array('type', 'length', 'max' => 50),
            array('user_id', 'length', 'max' => 10),
            array('user_id, dot, frame_dot, frame, dotColor, backgroundColor, frame_dotColor, frameColor, show_in_gallery, qr_type,company', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, data, type, user_id, created_at, updated_at', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'logs' => array(self::HAS_MANY, 'Log', 'qr_id'),
            'hits' => array(self::STAT, 'Log', 'qr_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'data' => 'Data',
            'type' => 'Type',
            'qr_type' => 'QR Type',
            'user_id' => 'User',
            'dot' => 'Dot Shape',
            'frame_dot' => 'Frame Dot Shape',
            'frame' => 'Frame Color',
            'dotColor' => 'Dot Color',
            'backgroundColor' => 'Background Color',
            'frame_dotColor' => 'Frame Dot Color',
            'frameColor' => 'Frame Shape',
            'show_in_gallery' => 'Show in Gallery',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'company' =>'Company',
        );
    }

    public function beforeSave() {
        parent::beforeSave();
        if ($this->isNewRecord) {
            
            // custom qr code
            if($this->qr_type == 'custom') {
                $this->dot = 'QrTagDotSquare';
                $this->frame_dot = 'QrTagFrameDotSquare';
                $this->frame = 'QrTagFrameSquare';
                $this->dotColor = '000000';
                $this->frame_dotColor = '000000';
                $this->frameColor = '000000';
                $this->backgroundColor = 'ffffff';
            }
            $this->created_at = new CDbExpression('NOW()');
            $this->updated_at = new CDbExpression('NOW()');
            $this->show_in_gallery = 0;
            /*
            $url = $this->getSystem_tag_url();
            if(Utility::isBitlyActive()) {
                if($bitlyUrl = Utility::getBitlyUrl($url)) {
                    $url = $bitlyUrl;
                }
            }
            
            $this->tag_url = $url;
            */
        } else {
            $this->updated_at = new CDbExpression('NOW()');
        }

        // get only related attributes according to the QR Type and refill the serialized data attribute
        if (is_array($this->data)) {
            $newData = array();
            foreach ($this->data as $attribute => $value) {
                if (Utility::beginsWith($attribute, $this->type . '_data')) {
                    $newData[$this->type][substr($attribute, strlen($this->type . '_data') + 1)] = $value;
                }
            }
            $newData = array_map('strip_tags', array_pop($newData));
            $this->data = serialize(array($newData));
        }

        return true;
    }

    public function afterSave() {
        parent::afterSave();

        if(empty($this->tag_url)) {
            $url = $this->getSystem_tag_url();
            if(Utility::isBitlyActive()) {
                if($bitlyUrl = Utility::getBitlyUrl($url)) {
                    $url = $bitlyUrl;
                }
            }
            $this->isNewRecord = false;
            $this->saveAttributes(array('tag_url' => $url));
        }
        else {
            $url = $this->tag_url;
        }
        
        // custom qr code
        if ($this->qr_type == 'custom') {
            $qr = new QrTag();
            $qr->bgColor = $this->backgroundColor;

            if (class_exists($this->frame_dot)) {
                $dotShape = new $this->dot;
            } else {
                $dotShape = new QrTagDotSquare();
            }

            $dotShape->color = $this->dotColor;
            $dotShape->size = 14;

            $qr->text = $url;
            $qr->setDot($dotShape); // size may change internally

            if (class_exists($this->frame_dot)) {
                $qr->frameDot = new $this->frame_dot;
            } else {
                $qr->frameDot = new QrTagFrameDotSquare();
            }

            $qr->frameDot->color = $this->frame_dotColor;

            if (class_exists($this->frame_dot)) {
                $qr->frame = new $this->frame;
            } else {
                $qr->frame = new QrTagFrameSquare();
            }

            $qr->frame->color = $this->frameColor;
            $qr->file = Yii::getPathOfAlias('webroot.qrs') . DIRECTORY_SEPARATOR . $this->id . '.png';
            $qr->generate();
        }

        return true;
    }

    public function generate($file, $size) {
        $qr = new QrTag();
        $qr->bgColor = $this->backgroundColor;

        if (class_exists($this->frame_dot)) {
            $dotShape = new $this->dot;
        } else {
            $dotShape = new QrTagDotSquare();
        }

        $dotShape->color = $this->dotColor;
        
        $dotShape->size = $size;
        $qr->text = $this->tag_url;
        
        $qr->setDot($dotShape);

        if (class_exists($this->frame_dot)) {
            $qr->frameDot = new $this->frame_dot;
        } else {
            $qr->frameDot = new QrTagFrameDotSquare();
        }

        $qr->frameDot->color = $this->frame_dotColor;

        if (class_exists($this->frame_dot)) {
            $qr->frame = new $this->frame;
        } else {
            $qr->frame = new QrTagFrameSquare();
        }

        $qr->frame->color = $this->frameColor;
        $qr->file = $file;
        $qr->generate();
        
        if($logo_image = $this->getLogo_image()) {
            self::embedLogo($file, $logo_image);
        }
    }
    
    public function deleteLogos() {
        $logo_path = Yii::getPathOfAlias("webroot.logos.$this->id") . '.{jpg,gif,jpeg,png}';
        $logos = glob($logo_path, GLOB_BRACE);
        if(!empty($logos)) {
        	foreach($logos as $logo) {
           		 @unlink($logo);
        	}
        }
    }
    
    public function afterDelete() {
        $logs = $this->logs;
        if($logs) {
            foreach ($logs as $log){
                $log->delete();
            }
        }
        @unlink($this->getImage_path());
        $this->deleteLogos();
        
        return parent::afterDelete();
    }

    public static function embedLogo($qr_path, $logo_path) {
        $ext = pathinfo($logo_path, PATHINFO_EXTENSION);
        
        // logo image
        switch(strtolower($ext)) {
            case 'png':
                $logoIm = imagecreatefrompng($logo_path);
                break;
            case 'jpg':
                $logoIm = imagecreatefromjpeg($logo_path);
                break;
            case 'gif':
                $logoIm = imagecreatefromgif($logo_path);
                break;
        }
        
        $logoWidth = imagesx($logoIm);
        $logoHeight = imagesy($logoIm);
        
        // qr image
        $im = imagecreatefrompng($qr_path);
        $width = imagesx($im);
        $height = imagesy($im);
        
        if($logoWidth > $logoHeight) {
            $ratio = $logoWidth / $logoHeight;
            $newLogoWidth = $width * 0.2;
            $newLogoHeight = $height * 0.2 / $ratio;
        }
        else {
            $ratio = $logoHeight / $logoWidth;
            $newLogoWidth = $width * 0.2 / $ratio;
            $newLogoHeight = $height * 0.2;
        }
        
//        if($logoWidth < $newLogoWidth && $logoHeight < $newLogoHeight) {
//            $newLogoWidth = $logoWidth;
//            $newLogoHeight = $logoHeight;
//        }

        $newLogoIm = imagecreatetruecolor($newLogoWidth, $newLogoHeight);
        imagecopy ($newLogoIm, $im, 0, 0, $width/2 - $newLogoWidth/2, $height/2 - $newLogoHeight/2, $newLogoWidth, $newLogoHeight);
        imagecopyresized($newLogoIm, $logoIm, 0, 0, 0, 0, $newLogoWidth, $newLogoHeight, $logoWidth, $logoHeight);
        imagecopymerge($im, $newLogoIm, $width/2 - $newLogoWidth/2, $height/2 - $newLogoHeight/2, 0, 0, $newLogoWidth, $newLogoHeight, 100);
        imagepng($im, $qr_path);
    }
    
    public function afterFind() {
        if ($this->data) { // set the QR Type attributes
            $data = unserialize($this->data);
            $data = array_pop($data);
            if ($data) {
                if (is_array($data)) {
                    foreach ($data as $attr => $value) {
                        $this->qrData->$attr = $value;
                    }
                }
            }
        }
        parent::afterFind();
        return true;
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
        $criteria->compare('data', $this->data, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);
         $criteria->compare('company', $this->company, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getType_name() {
        return isset(self::$supported_types[$this->type]) ? self::$supported_types[$this->type] : '';
    }

    public function getImage_url() {
        return Yii::app()->baseUrl . '/' . Yii::app()->params['qr_folder'] . '/' . $this->id . '.png';
    }

    public function getImage_path() {
        return Yii::getPathOfAlias('webroot.' . Yii::app()->params['qr_folder'] . '.' . $this->id) . '.png';
    }

    public function getSystem_tag_url() {
        return Yii::app()->createAbsoluteUrl(Utility::getTagFromID($this->id));
//        return Yii::app()->createAbsoluteUrl($this->id);
    }
    
    public function getLogo_image() {
        $logo = Yii::getPathOfAlias("webroot.logos.$this->id");
        if(file_exists($logo . '.png')) {
            return $logo . '.png';
        }
        else if(file_exists($logo . '.jpg')) {
            return $logo . '.jpg';
        }
        else if(file_exists($logo . '.gif')) {
            return $logo . '.gif';
        }
        
        return false;
    }

    public static function saveInSession($id) {
        $arr = Yii::app()->session['in_session_qrs'] ? Yii::app()->session['in_session_qrs'] : array();
        $arr[] = $id;
        Yii::app()->session['in_session_qrs'] = $arr;
    }
 
    public static function getInSession() {
        return Yii::app()->session['in_session_qrs'] ? Yii::app()->session['in_session_qrs'] : array();
    }

    public static function isInSession($id) {
        $arr = self::getInSession();
        return in_array($id, $arr);
    }
}