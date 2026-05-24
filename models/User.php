<?php
class User{
    private $id_user;
    private $username;
    private $password;
    private $nama_lengkap;


    public function __construct($id_user,$username,$password,$nama_lengkap){
        $this->id_user = $id_user;
        $this->username = $username;
        $this->password = $password;
        $this->nama_lengkap = $nama_lengkap;
    }

    public function getId_user(){
        return $this->id_user;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getNamaLengkap(){
        return $this->nama_lengkap;
    }

    public function setIdUser($id_user){
        $this->id_user = $id_user;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setNamaLengkap($nama_lengkap){
        $this->nama_lengkap = $nama_lengkap;
    }
}
?>