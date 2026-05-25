<?php
require_once "Hardware.php";

class NonNetworkDevice extends Hardware {
    private $lokasiHardware;

    public function __construct($id_hardware, $id_project, $namaHardware, $jenisHardware, $lokasiFisik) {
        parent::__construct($id_hardware, $id_project, $namaHardware, $jenisHardware);
        
        $this->lokasiHardware = $lokasiFisik;
    }

    public function getLokasiHardware() { 
        return $this->lokasiHardware; 
    }
    public function setLokasiHardware($lokasiFisik) { 
        $this->lokasiHardware = $lokasiFisik; 
    }
}
?>