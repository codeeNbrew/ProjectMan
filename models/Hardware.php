<?php
class Hardware{
    private $id_hardware;
    private $id_project;
    private $namaHardware;
    private $jenisHardware;
    private $ipAddress;
    private $username;
    private $password;

    public function __construct($id_hardware, $id_project, $namaHardware, $jenisHardware, $ipAddress, $username, $password) {
        $this->id_hardware = $id_hardware;
        $this->id_project = $id_project;
        $this->namaHardware = $namaHardware;
        $this->jenisHardware = $jenisHardware;
        $this->ipAddress = $ipAddress;
        $this->username = $username;
        $this->password = $password;
    }

    public function getIdHardware(){
        return $this->id_hardware;
    }

    public function getIdProject(){
        return $this->id_project;
    }

    public function getNamaHardware(){
        return $this->namaHardware;
    }

    public function getjenisHardware(){
        return $this->namaHardware;
    }

    public function getIpAddress(){
        return $this->ipAddress;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setIdHardware($id_hardware){
        $this->id_hardware = $id_hardware;
    }

    public function setIdProject($id_project){
        $this->id_project = $id_project;
    }

    public function setNamaHardware($namaHardware){
        $this->namaHardware = $namaHardware;
    }

    public function setjenisHardware($jenisHardware){
        $this->jenisHardware = $jenisHardware;
    }

    public function setIpAddress($ipAddress){
        $this->ipAddress = $ipAddress;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setPassword($password){
        $this->password = $password;
    }

}

?>