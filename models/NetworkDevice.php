<?php
require_once "Hardware.php";

class NetworkDevice extends Hardware {
    private $ipAddress;
    private $username;
    private $password;

    public function __construct($id_hardware, $id_project, $namaHardware, $jenisHardware, $ipAddress, $username, $password) {
        parent::__construct($id_hardware, $id_project, $namaHardware, $jenisHardware);
        $this->ipAddress = $ipAddress;
        $this->username = $username;
        $this->password = $password;
    }

    public function getIpAddress() { 
        return $this->ipAddress; 
    }
    public function getUsername() { 
        return $this->username; 
    }
    public function getPassword() { 
        return $this->password; 
    }

    public function setIpAddress($ipAddress) { 
        $this->ipAddress = $ipAddress; 
    }
    public function setUsername($username) { 
        $this->username = $username; 
    }
    public function setPassword($password) { 
        $this->password = $password; 
    }
}
?>