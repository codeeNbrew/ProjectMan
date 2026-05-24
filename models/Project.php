<?php
class Project{
private $id_project;
private $namaProject;
private $lokasi;
private $noClient;
private $fotoTopologi;

public function __construct($id_project, $namaProject, $lokasi, $noClient, $fotoTopologi){
    $this->id_project = $id_project;
    $this->namaProject = $namaProject;
    $this->lokasi = $lokasi;
    $this->noClient = $noClient;
    $this->fotoTopologi = $fotoTopologi;    
}

public function getIdProject(){
    return $this->id_project;
}

public function getNamaProject(){
    return $this->namaProject;
}

public function getLokasi(){
    return $this->lokasi;
}

public function getNoClient(){
    return $this->noClient;
}

public function getfotoTopologi(){
    return $this->fotoTopologi;
}

public function setNamaProject($namaProject){
    $this->namaProject = $namaProject;
}

public function setLokasi( $lokasi){
    $this->lokasi = $lokasi;
}

public function setNoClient( $noClient){
    $this->noClient = $noClient;
}

public function setfotoTopologi( $fotoTopologi){
    $this->fotoTopologi = $fotoTopologi;
}

}


?>