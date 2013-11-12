<?php

require_once '../../dao/Recorder.php';
require_once '../../dao/Dao.php';

class DaoTest extends PHPUnit_Framework_TestCase {

    public function testInstanciationRecorder() {
        $recorder = new Recorder();
        $this->assertClassHasAttribute('dao', 'recorder');
        return $recorder;
    }

    /**
     * @depends testInstanciationRecorder
     */
    public function testInstanciationDao($recorder) {
        $dao = new Dao($recorder);
        $this->assertNotNull($dao->lesArduinos);
        $this->assertNotNull($dao->serveurEnregistrement);
        return $dao;
    }

    /**
     * @depends testInstanciationRecorder
     * @depends testInstanciationDao
     */
    public function testSetDao($recorder, $dao) {
        $recorder->setDao($dao);
        $this->assertNotNull($recorder->dao);
    }
    
    

}
