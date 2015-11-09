<?php

class QrController extends AdminController {

    public function actionList() {
        $limit = 20;
        $q = new CDbCriteria(array(
            'select' => array('*', '(SELECT COUNT(*) FROM log WHERE qr.id = log.qr_id) AS hitCount'),
            'alias' => 'qr',
            'with' => array('user' => array('select' => 'username', 'alias', 'user')),
        ));
        
        $this->addDefaultCriteria($q, array('limit' => $limit, 'order' => 'qr.created_at', 'sort' => 'DESC'));
        
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

}