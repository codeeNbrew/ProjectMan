<?php

class ProjectController {
    private $model;
    public function __construct($model) {
        $this->model = $model;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
            header("Location: index.php?action=login");
            exit;
        }
    }
    public function listProject() {
        $projects = $this->model->readProject();
        require_once "views/project/index.php";
    }
    public function detailProject() {
        $id_project = $_GET['id'];
        $hardwares = $this->model->readHardware($id_project);
        
        require_once "views/project/detail.php";
    }

    public function addProject() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = trim($_POST['namaProject']);
            $lokasi = trim($_POST['lokasi']);
            $noClient = trim($_POST['noClient']);
            $namaFotoBaru = null;

            if (isset($_FILES['fotoTopologi']) && $_FILES['fotoTopologi']['error'] === 0) {
                $fileTmp = $_FILES['fotoTopologi']['tmp_name'];
                $fileNamaAsli = $_FILES['fotoTopologi']['name'];
                $ekstensi = pathinfo($fileNamaAsli, PATHINFO_EXTENSION);
                
                $namaFotoBaru = time() . '_' . uniqid() . '.' . $ekstensi;
                
                $targetFolder = "uploads/" . $namaFotoBaru;

                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                move_uploaded_file($fileTmp, $targetFolder);
            }

            $project = new Project(null, $nama, $lokasi, $noClient, $namaFotoBaru);

            if ($this->model->createProject($project)) {
                header("Location: index.php?action=listProject");
                exit;
            }
        }
    }

    public function editProject() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_project'];
            $nama = trim($_POST['namaProject']);
            $lokasi = trim($_POST['lokasi']);
            $noClient = trim($_POST['noClient']);
            
            $projects = $this->model->readProject();
            $fotoLama = null;
            foreach ($projects as $p) {
                if ($p->getIdProject() == $id) {
                    $fotoLama = $p->getfotoTopologi();
                    break;
                }
            }
            
            $namaFotoBaru = $fotoLama;

            if (isset($_FILES['fotoTopologi']) && $_FILES['fotoTopologi']['error'] === 0) {
                $fileTmp = $_FILES['fotoTopologi']['tmp_name'];
                $fileNamaAsli = $_FILES['fotoTopologi']['name'];
                $ekstensi = pathinfo($fileNamaAsli, PATHINFO_EXTENSION);
                
                $namaFotoBaru = time() . '_' . uniqid() . '.' . $ekstensi;
                
                $targetFolder = "uploads/" . $namaFotoBaru;

                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                if (move_uploaded_file($fileTmp, $targetFolder)) {
                    if (!empty($fotoLama) && file_exists("uploads/" . $fotoLama)) {
                        unlink("uploads/" . $fotoLama);
                    }
                }
            }

            $project = new Project($id, $nama, $lokasi, $noClient, $namaFotoBaru);

            if ($this->model->updateProject($project)) {
                header("Location: index.php?action=listProject");
                exit;
            }
        }
    }

    public function removeProject() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $projects = $this->model->readProject();
            foreach ($projects as $p) {
                if ($p->getIdProject() == $id) {
                    $foto = $p->getfotoTopologi();
                    if (!empty($foto) && file_exists("uploads/" . $foto)) {
                        unlink("uploads/" . $foto);
                    }
                    break;
                }
            }

            if ($this->model->deleteProject($id)) {
                header("Location: index.php?action=listProject");
                exit;
            }
        }
    }

    public function addHardware() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_project = $_POST['id_project'];
            $nama = trim($_POST['namaHardware']);
            $jenis = trim($_POST['jenisHardware']); 

            $perangkatNonNetwork = ['non network hardware'];

            if (in_array(strtolower($jenis), $perangkatNonNetwork)) {
                $lokasiHw = trim($_POST['lokasiHardware']); 
                $hardware = new NonNetworkDevice(null, $id_project, $nama, $jenis, $lokasiHw);
            } else {
                $ip = trim($_POST['ipAddress']);
                $user = trim($_POST['username']);
                $pass = trim($_POST['password']);
                $hardware = new NetworkDevice(null, $id_project, $nama, $jenis, $ip, $user, $pass);
            }

            if ($this->model->createHardware($hardware)) {
                header("Location: index.php?action=detailProject&id=" . $id_project);
                exit;
            }
        }
    }

    public function editHardware() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_hardware = $_POST['id_hardware'];
            $id_project = $_POST['id_project'];
            $nama = trim($_POST['namaHardware']);
            $jenis = trim($_POST['jenisHardware']);

            $perangkatNonNetwork = ['non network hardware'];

            if (in_array(strtolower($jenis), $perangkatNonNetwork)) {
                $lokasiHw = trim($_POST['lokasiHardware']); 
                $hardware = new NonNetworkDevice($id_hardware, $id_project, $nama, $jenis, $lokasiHw);
            } else {
                $ip = trim($_POST['ipAddress']);
                $user = trim($_POST['username']);
                $pass = trim($_POST['password']);
                $hardware = new NetworkDevice($id_hardware, $id_project, $nama, $jenis, $ip, $user, $pass);
            }

            if ($this->model->updateHardware($hardware)) {
                header("Location: index.php?action=detailProject&id=" . $id_project);
                exit;
            }
        }
    }

    public function removeHardware() {
        $id_hardware = $_GET['id_hardware'];
        $id_project = $_GET['id_project'];

        if ($this->model->deleteHardware($id_hardware)) {
            header("Location: index.php?action=detailProject&id=" . $id_project);
            exit;
        }
    }
}