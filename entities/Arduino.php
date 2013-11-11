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
  
  public function __construct($id, $description, $mac, $ip, $port) {
      $this->setId($id);
      $this->setDescription($description);
      $this->setMac($mac);
      $this->setIp($ip);
      $this->setPort($port);
  }
  
  public function toString() {
    return "id=".$this->id.", description=".$this->description.", mac=".$this->mac.", ip=".$this->ip.", port=".$this->port;
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
