<?php
class Hardware{
    protected $id_hardware;
    protected $id_project;
    protected $namaHardware;
    protected $jenisHardware;

    public function __construct($id_hardware, $id_project, $namaHardware, $jenisHardware) {
        $this->id_hardware = $id_hardware;
        $this->id_project = $id_project;
        $this->namaHardware = $namaHardware;
        $this->jenisHardware = $jenisHardware;

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
        return $this->jenisHardware;
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

}

?>