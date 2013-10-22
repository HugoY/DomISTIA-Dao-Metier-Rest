<?php

/**
 * Description of Arduino
 *
 * @author usrlocal
 */
class Arduino {
  private $id; // str
  private $description; // str
  private $mac; // str
  private $ip; // str
  private $port; // int
  
  public function toString() {
    return "id=".$id.", description=[%s]".$description.", mac=[%s]".$mac.", ip=[%s]".$ip.", port=".port;
  }
  
  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getDescription() {
    return $this->description;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function getMac() {
    return $this->mac;
  }

  public function setMac($mac) {
    $this->mac = $mac;
  }

  public function getIp() {
    return $this->ip;
  }

  public function setIp($ip) {
    $this->ip = $ip;
  }

  public function getPort() {
    return $this->port;
  }

  public function setPort($port) {
    $this->port = $port;
  }
}

?>
