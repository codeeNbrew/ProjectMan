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
            $foto = trim($_POST['fotoTopologi']);
            $project = new Project(null, $nama, $lokasi, $noClient, $foto);

            if ($this->model->createProject($project)) {
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
            $ip = trim($_POST['ipAddress']);
            $user = trim($_POST['username']);
            $pass = trim($_POST['password']);

            $hardware = new Hardware(null, $id_project, $nama, $jenis, $ip, $user, $pass);

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
            $ip = trim($_POST['ipAddress']);
            $user = trim($_POST['username']);
            $pass = trim($_POST['password']);

            $hardware = new Hardware($id_hardware, $id_project, $nama, $jenis, $ip, $user, $pass);

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