<?php

class Wurfl extends CApplicationComponent {
    public $wurflDir = 'ext.wurfl.WURFL';
    public $persistenceDir = 'ext.wurfl.resources.storage.persistence';
    public $cacheDir = 'ext.wurfl.resources.storage.cache';
    public $wurflFileDir = 'ext.wurfl.resources';
    public $expiration = 36000;
    /**
     * @var string
     * values: performance, accuracy
     */
    public $matchMode = 'performance';
    private $device = null;
    
    public function init() {
        $this->_load_wrfl();
        parent::init();
    }


    private function _load_wrfl() {
        if($this->device == null) {
            $wurflDir = Yii::getPathOfAlias($this->wurflDir);
            $persistenceDir = Yii::getPathOfAlias($this->persistenceDir);
            $cacheDir = Yii::getPathOfAlias($this->cacheDir);
            
            require_once realpath($wurflDir . '/Application.php');
            Yii::registerAutoloader(array('WURFL_ClassLoader', 'loadClass'));

            // Create WURFL Configuration
            $wurflConfig = new WURFL_Configuration_InMemoryConfig();

            // Set location of the WURFL File
            $wurflConfig->wurflFile(realpath(Yii::getPathOfAlias($this->wurflFileDir) . '/wurfl.zip'));

            // Set the match mode for the API ('performance' or 'accuracy')
            $wurflConfig->matchMode($this->matchMode);

            // Setup WURFL Persistence
            $wurflConfig->persistence('file', array('dir' => $persistenceDir));

            // Setup Caching
            $wurflConfig->cache('file', array('dir' => $cacheDir, 'expiration' => $this->expiration));

            // Create a WURFL Manager Factory from the WURFL Configuration
            $wurflManagerFactory = new WURFL_WURFLManagerFactory($wurflConfig);

            // Create a WURFL Manager
            /* @var $wurflManager WURFL_WURFLManager */
            $wurflManager = $wurflManagerFactory->create();

            $this->device = $wurflManager->getDeviceForHttpRequest($_SERVER);;
        }
    }
    
    public function getDevice() {
        return $this->device;
    }
    
    
}