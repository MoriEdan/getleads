<?php

class QrController extends Controller {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('transparent', 'customize', 'edit', 'stats', 'gallery_toggle', 'download', 'delete', 'delete_logos'),
                'roles' => array('ownQr'),
            ),
            array('allow',
                'actions' => array('list', 'customize', 'transparent'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('choose', 'generateTransQr', 'generate', 'tag', 'gallery', 'downloadVcard',),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public static function registerImageQrAutoloader() {
        spl_autoload_register(function($class) {
                    if (substr($class, 0, 9) == 'Madlogics') {
                        require_once __DIR__ . '/../extensions/' . strtr($class, '\\', '/') . '.php';
                    }
                });
    }

    public function actionCustomize() {
        $id = Yii::app()->request->getParam('id');
        $qr = $this->loadModel($id);
        $just_saved = false;

        if (isset($_POST['customize'])) {
            $customize_what = $_POST['customize'];
            $type = $_POST['type'];
            $shape = $_POST['shape'];
            $color = $_POST['color'];

            if ($customize_what == 'shape') {
                if ($type && $shape) {
                    $qr->$type = $shape;
                    $qr->save();
                    $just_saved = true;
                }
            } else if ($customize_what == 'color') {
                if ($type && $color) {
                    $type = $type . 'Color';
                    $qr->$type = $color;
                    $qr->save();
                    $just_saved = true;
                }
            }
        }

        if ((isset($_POST['customize']) && $customize_what == $_POST['customize'] && $_FILES['logo']['error'] == 0) || $qr->logo_image) {
            if ($just_saved == false) {
                $qr->save();
            }

            $saved_logo_image = $qr->logo_image;
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
                $qr->deleteLogos();
                $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
                $logo_path = Yii::getPathOfAlias("webroot.logos.$id") . '.' . $ext;
                move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path);
            } else if ($saved_logo_image) {
                $ext = pathinfo($saved_logo_image, PATHINFO_EXTENSION);
                $logo_path = $saved_logo_image;
            }


            Qr::embedLogo($qr->image_path, $logo_path);
        }

        $this->render('customize', array(
            'qr' => $qr,
            'shapes' => QrTag::installedShapes(),
            'shape_url' => QrTag::publishFiles(),
        ));
    }

    public function actionDelete_logos() {
        $id = Yii::app()->request->getParam('id');
        $qr = $this->loadModel($id);
        $qr->deleteLogos();
        $qr->save();
        $this->redirect(array("qr/customize/$id"));
    }

    public function actionGenerate() {
	    $this->addEdit();
    }

    public function actionEdit() {
        $id = Yii::app()->request->getParam('id');
        $this->addEdit($id);
    }

    public function actionTag() {
        // set theme
        $theme_name = 'mobile';
        Yii::app()->theme = $theme_name;
        #####################################################################################################

        $id = Yii::app()->request->getParam('id');
        $id = Utility::getIDFromTag($id);

        $qr = $this->loadModel($id);
        
        if($qr->user->is_active == 0) {
            $this->redirect(Yii::app()->homeUrl);
        }

        $log = new Log();
        $log->qr_id = $id;
        $log->save();

        switch ($qr->type) {
            case 'website':
                Yii::app()->request->redirect($qr->qrData->url);
                break;
            case 'facebook_profile':
                Yii::app()->request->redirect($qr->qrData->url);
                break;
            case 'twitter_profile':
                Yii::app()->request->redirect($qr->qrData->url);
                break;
            case 'twitter_status':
                if (preg_match('@^(https?://)?(www\.)?twitter\.com@', strtolower($qr->qrData->tweet))) {
                    if (!Utility::beginsWith(strtolower($qr->qrData->tweet), 'http://') && !Utility::beginsWith(strtolower($qr->qrData->tweet), 'https://')) {
                        Yii::app()->request->redirect('http://' . $qr->qrData->tweet);
                    }
                    Yii::app()->request->redirect($qr->qrData->tweet);
                } else {
                    Yii::app()->request->redirect('http://twitter.com/home?status=' . urlencode($qr->qrData->tweet));
                }
                break;
            case 'linkedin_profile':
                Yii::app()->request->redirect($qr->qrData->url);
                break;
            case 'linkedin_share':
                Yii::app()->request->redirect($qr->qrData->url);
                break;
            case 'telephone':
                header('Location: tel:' . $qr->qrData->number);
                exit;
            case 'email':
                header('Location: mailto:' . $qr->qrData->email);
                exit;
            case 'email_msg':
                header('Location: mailto:' . $qr->qrData->email . '?subject=' . $qr->qrData->subject . '&body=' . $qr->qrData->body);
                exit;
            case 'sms':
                header('Location: sms:' . $qr->qrData->number);
                exit;
        }

        $this->render('tag', array(
            'qr' => $qr,
        ));
    }

    public function actionDownloadVcard() {
        $id = Yii::app()->request->getParam('id');
        $qr = $this->loadModel($id);
        if ($qr->type == 'vcard') {
            $out = '';
            $out .= 'BEGIN:VCARD' . "\n";
            $out .= 'VERSION:2.1' . "\n";
            $out .= 'N:' . $qr->qrData->lname . ';' . $qr->qrData->fname . "\n";
            $out .= 'FN:' . $qr->qrData->fname . "\n";
            $out .= 'ORG:' . $qr->qrData->org . "\n";
            $out .= 'TITLE:' . $qr->qrData->job_title . "\n";
            $out .= 'TEL;WORK;VOICE:' . $qr->qrData->telephone . "\n";
            $out .= 'TEL;MOBILE;VOICE:' . $qr->qrData->cell . "\n";
            $out .= 'EMAIL;PREF;INTERNET:' . $qr->qrData->email . "\n";
            $out .= 'END:VCARD';

            header("Pragma: no-cache"); // required
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false); // required for certain browsers
            header("Content-type: text/vcard");
            header("Content-Disposition: attachment; filename=\"vcard.vcf\"");
            header("Content-Transfer-Encoding: binary");
            echo $out;

            Yii::app()->end();
        }
    }

    private function addEdit($id = 0) {
        $model = new QrGenerateForm('nosubmit');

        if ($id) {
            Yii::app()->user->checkAccess('ownQr');

            $qr = $this->loadModel($id);
            $attributes = array();
            foreach ($qr->qrData as $prop => $value) {
                $attributes[$qr->type . '_data_' . $prop] = $value;
            }
            $model->title = $qr->title;
            $model->qr_type = $qr->type;
            $model->attributes = $attributes;
        } else {
            $qr = new Qr();
            $qr->qr_type = Yii::app()->request->getParam('type');
            $qr->qr_type = in_array($qr->qr_type, array('custom', 'transparent')) ? $qr->qr_type : 'custom';
        }


        if (isset($_POST['QrGenerateForm'])) {
            $model->setScenario($_POST['QrGenerateForm']['qr_type']);
            $model->attributes = $_POST['QrGenerateForm'];
            if ($model->validate()) {
                $qr->title = $model->title;
                $qr->type = $model->qr_type;
                $qr->user_id = Yii::app()->user->getId();
                $qr->data = $_POST['QrGenerateForm'];
                $qr->save();
                Qr::saveInSession($qr->id);
                if (!$id) {
                    $this->redirect(array($qr->qr_type == 'custom' ? 'customize' : 'transparent', 'id' => $qr->id));
                } else {
                    if ($logo_path = $qr->logo_image) {
                        Qr::embedLogo($qr->image_path, $logo_path);
                    }
                    Utility::setFlash(Yii::t('dict', "QR Code $id edited successfully."), 'success');
                    $this->redirect(array('list'));
                }
            }
        }

        $model->setScenario('nosubmit');
        $qr_type = $model->qr_type;

        $this->render('generate', array(
            'mode' => $id ? 'edit' : 'add',
            'model' => $model,
            'qr_type' => $qr_type,
        ));
    }

    public function actionChoose() {
        $this->render('choose');
    }

    public function actionTransparent() {
        $model = new QrTransparentForm();
        $id = Yii::app()->request->getParam('id');
        
        $image= '';
        $file_path = '';
        if (isset($_POST['QrTransparentForm'])) {
            $model->attributes = $_POST['QrTransparentForm'];
            $model->file = CUploadedFile::getInstance($model, 'file');

            if ($model->validate()) {
                $ext = $model->file->getExtensionName();

                $file_name = $id . '_image.' . $ext;
                $file_path = Yii::getPathOfAlias('webroot.qrs.') . DIRECTORY_SEPARATOR . $file_name;
                $image = Yii::app()->baseUrl . '/qrs/' . $file_name;

                $model->file->saveAs($file_path);
                Yii::app()->session['trans_qr_code_file'] = $file_path;
                Yii::app()->session['qr_id'] = $id;
            }
        }
        $this->render('transparent', array('model' => $model, 'image' => $image, 'file_path' => $file_path));
    }

    public function actionGenerateTransQr() {

        self::registerImageQrAutoloader();
        Yii::import('ext.qr.phpqrcode.qrlib', true);
        $model = Qr::model()->findByPk(Yii::app()->session['qr_id']);

        $size = isset($_GET['size']) ? intval($_GET['size']) : 0;
        $x = isset($_GET['x']) ? intval($_GET['x']) : 0;
        $y = isset($_GET['y']) ? intval($_GET['y']) : 0;

        $imgTmp = imagecreatefromstring(file_get_contents(Yii::app()->session['trans_qr_code_file']));
        $img = imagecreatetruecolor(imagesx($imgTmp), imagesy($imgTmp));
        imagefill($img, 0, 0, imagecolorallocatealpha($img, 255, 255, 255, 127));
        imagecopymerge($img, $imgTmp, 0, 0, 0, 0, imagesx($imgTmp), imagesy($imgTmp), 100);
        imagedestroy($imgTmp);
        imagesavealpha($img, true);

        $size = $size < 100 ? min(array(imagesx($img), imagesy($img))) : $size;

        $data = QRCode::text($model->tag_url, false, 'Q');
        $data = array_map('str_split', $data);
        array_walk_recursive($data, 'intval');

        $qr = new \Madlogics\VisualQr($img);
        $qr->setData($data);
        $qr->setSize($size)->setX($x)->setY($y);

        header('Content-Type: image/png');
        $im2 = $qr->render()->getImageQrIm();
        imagepng($im2);
        imagepng($im2, $model->image_path);
        exit;
    }

    public function actionList() {
        $limit = 20;
        $page = Yii::app()->request->getQuery('page');
        $offset = (max($page, 1) - 1) * $limit;

        $q = new CDbCriteria(array(
            'condition' => 't.user_id = :user_id',
            'params' => array(':user_id' => Yii::app()->user->getId()),
            'order' => 't.id DESC',
            'limit' => $limit,
            'offset' => $offset,
        ));

        $qrs = Qr::model()->findAll($q);

        $count = Qr::model()->count($q);
        $pages = new CPagination($count);

        // results per page
        $pages->pageSize = $limit;
        $pages->applyLimit($q);

        $this->render('list', array(
            'qrs' => $qrs,
            'pages' => $pages,
        ));
    }

    public function actionStats() {
        $qr = null;

        $id = Yii::app()->request->getParam('id');
        $qr = $this->loadModel($id);

        $d1 = Yii::app()->request->getQuery('d1');
        $d2 = Yii::app()->request->getQuery('d2');

        $d1 = empty($d1) ? date('Y-m-d', strtotime('-30 days')) : $d1;
        $d2 = empty($d2) ? date('Y-m-d') : $d2;

        $criteria1 = new CDbCriteria(array(
            'select' => 'COUNT(*) count, DATE(created_at) date',
            'condition' => ' qr_id = :qr_id AND DATE(created_at) BETWEEN :d1 AND :d2 ',
            'params' => array(
                ':qr_id' => $id,
                ':d1' => $d1,
                ':d2' => $d2,
            ),
            'group' => 'DATE(created_at)',
        ));

        $result = Log::model()->findAll($criteria1);
        $data = array();
        foreach ($result as $row) {
            $data[date('d M Y', strtotime($row->date))] = $row->count;
        }


        $criteria2 = new CDbCriteria(array(
            'condition' => 'qr_id = :qr_id AND DATE(created_at) BETWEEN :d1 AND :d2',
            'params' => array(
                ':qr_id' => $id,
                ':d1' => $d1,
                ':d2' => $d2,
            ),
            'order' => 'created_at DESC',
        ));
        $logs = Log::model()->findAll($criteria2);


//        $this->addJs(base_url() . 'js/flotr2/flotr2.min.js');

        $this->render('stats', array(
            'id' => $id,
            'qr' => $qr,
            'd1' => $d1,
            'd2' => $d2,
            'data' => $data,
            'logs' => $logs,
        ));
    }

    public function actionGallery_toggle() {
        $id = Yii::app()->request->getParam('id');
        $qr = $this->loadModel($id);
//        $qr->show_in_gallery = !$qr->show_in_gallery;
        $qr->saveAttributes(array('show_in_gallery' => !$qr->show_in_gallery));
        $this->redirect(array('list'));
    }

    public function actionDelete() {
        $id = Yii::app()->request->getParam('id');
        $qr = $this->loadModel($id);
        Log::model()->deleteAll('qr_id = :qr_id', array(
            ':qr_id' => $id,
        ));
        $qr->delete();
        Utility::setFlash(Yii::t('dict', 'Deleted successfully.'), 'success');
        $this->redirect(array('list'));
    }

    public function actionGallery() {
        $limit = 9;
        $page = Yii::app()->request->getQuery('page');
        $offset = (max($page, 1) - 1) * $limit;
        $q = new CDbCriteria(array(
            'condition' => 't.show_in_gallery = 1',
            'order' => 't.id DESC',
            'limit' => $limit,
            'offset' => $offset,
        ));

        $qrs = Qr::model()->findAll($q);

        $count = Qr::model()->count($q);
        $pages = new CPagination($count);

        // results per page
        $pages->pageSize = $limit;
        $pages->applyLimit($q);

        $this->render('gallery', array(
            'qrs' => $qrs,
            'pages' => $pages,
        ));
    }

    public function actionDownload() {
        $id = Yii::app()->request->getParam('id');
        $qr = Qr::model()->findByPk($id);
        
        if($qr->qr_type == 'custom') {
            $this->downloadCustomQr($qr);
        }
        else {
            $this->downloadImageQr($qr);
        }
        
    }
    
    protected function downloadImageQr($qr) {
        $mime = 'application/image-png';
        $file = $qr->image_path;
        
        header("Pragma: no-cache"); // required
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false); // required for certain browsers
        header("Content-type: $mime");
        header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
        header("Content-Transfer-Encoding: binary");
        readfile($file);
        Yii::app()->end();
    }
    
    protected function downloadCustomQr($qr) {
        $size = Yii::app()->request->getQuery('size', 'small');

        switch ($size) {
            case 'medium':
                $sz = 30;
                break;
            case 'large':
                $sz = 50;
                break;
            case 'xlarge':
                $sz = 60;
                break;
            default:
                $sz = 14;
                break;
        }

        $ext = '.png';
        $mime = 'application/image-png';
        if ($size != 'small') {
            $ext = '.jpg';
            $mime = 'image/jpeg';
        }

        $fileName = uniqid();
        $file = Yii::getPathOfAlias('webroot.tmp') . DIRECTORY_SEPARATOR . $fileName . '.png';
        $qr->generate($file, $sz);

        header("Pragma: no-cache"); // required
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false); // required for certain browsers
        header("Content-type: $mime");
        header("Content-Disposition: attachment; filename=\"" . $fileName . $ext . "\"");
        header("Content-Transfer-Encoding: binary");
        if ($size != 'small') {
            $fileJpg = Yii::getPathOfAlias('webroot.tmp') . DIRECTORY_SEPARATOR . $fileName . '_tmp' . $ext;
            imagejpeg(imagecreatefrompng($file), $fileJpg);
            $fileContent = file_get_contents($fileJpg);
            $fileContent = substr_replace($fileContent, pack("cnn", 1, 300, 300), 13, 5);
            echo $fileContent;
        } else {
            readfile($file);
        }
        Yii::app()->end();
    }

    public function loadModel($id) {
        $model = Qr::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The QR Code does not exists.');
        }
        return $model;
    }

}

