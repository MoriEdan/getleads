<?php

class MyYiiMailMessage extends YiiMailMessage {

    public function setBody($body = '', $contentType = null, $charset = null) {
        if ($this->view !== null) {
            if (!is_array($body))
                $body = array('body' => $body);

            // if Yii::app()->controller doesn't exist create a dummy 
            // controller to render the view (needed in the console app)
            if (isset(Yii::app()->controller))
                $controller = Yii::app()->controller;
            else
                $controller = new CController('YiiMail');

            // renderPartial won't work with CConsoleApplication, so use 
            // renderInternal - this requires that we use an actual path to the 
            // view rather than the usual alias
            $viewPath= Yii::app()->theme->getBasePath() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . Yii::app()->mail->viewPath . DIRECTORY_SEPARATOR . $this->view . '.php';
            $body = $controller->renderInternal($viewPath, array_merge($body, array('mail' => $this)), true);
        }
        return $this->message->setBody($body, $contentType, $charset);
    }

}