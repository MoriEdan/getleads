<?php

abstract class MyActiveRecord extends CActiveRecord {
    public $oldAttribute;
    
    public function init() {
        $this->attachEventHandler('onAfterFind', array($this, 'setOldAttributes'));

    }


    public function setOldAttributes($event){
        $this->oldAttribute = (object)($event->sender->attributes);
    }
    
}