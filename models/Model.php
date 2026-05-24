<?php
require_once "Project.php";
require_once "Hardware.php";
require_once "User.php";

class Model{
    private $db;

    public function __construct($dbConnection){
        $this->db = $dbConnection->getConnection();
    }

    public function login($username, $password){
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            
            if ($password === $row['password']) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['login'] = true;
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
                
                return true; 
            }
        }

        return false;
    }
    
    public function createProject(Project $project) {
        $nama = $project->getNamaProject();
        $lokasi = $project->getLokasi();
        $noClient = $project->getNoClient();
        $foto = $project->getfotoTopologi();

        $query = "INSERT INTO projects (namaProject, lokasi, noClient, fotoTopologi) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss", $nama, $lokasi, $noClient, $foto);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readProject() {
        $query = "SELECT * FROM projects ORDER BY id_project DESC";
        $result = $this->db->query($query);

        $listProject = [];

        while ($row = $result->fetch_assoc()) {
            $projectObjek = new Project(
                $row['id_project'],
                $row['namaProject'],
                $row['lokasi'],
                $row['noClient'],
                $row['fotoTopologi']
            );
            $listProject[] = $projectObjek;
        }

        return $listProject;
    }

    public function updateProject(Project $project) {
        $id = $project->getIdProject();
        $nama = $project->getNamaProject();
        $lokasi = $project->getLokasi();
        $noClient = $project->getNoClient();
        $foto = $project->getfotoTopologi();

        $query = "UPDATE projects SET namaProject = ?, lokasi = ?, noClient = ?, fotoTopologi = ? WHERE id_project = ?";
        $stmt = $this->db->prepare($query);
        
        $stmt->bind_param("ssssi", $nama, $lokasi, $noClient, $foto, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteProject($id) {
        $query = "DELETE FROM projects WHERE id_project = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function createHardware(Hardware $hardware) {
        $id_project = $hardware->getIdProject();
        $nama = $hardware->getNamaHardware();
        $jenis = $hardware->getjenisHardware();
        $ip = $hardware->getIpAddress();
        $user = $hardware->getUsername();
        $pass = $hardware->getPassword();

        $query = "INSERT INTO hardware (id_project, namaHardware, jenisHardware, ipAddress, username, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        
        $stmt->bind_param("isssss", $id_project, $nama, $jenis, $ip, $user, $pass);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readHardware($idProject) {
        $query = "SELECT * FROM hardware WHERE id_project = ? ORDER BY id_hardware DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idProject);
        $stmt->execute();
        $result = $stmt->get_result();

        $listHardware = [];

        while ($row = $result->fetch_assoc()) {
            $hardwareObjek = new Hardware(
                $row['id_hardware'],
                $row['id_project'],
                $row['namaHardware'],
                $row['jenisHardware'],
                $row['ipAddress'],
                $row['username'],
                $row['password']
            );
            $listHardware[] = $hardwareObjek;
        }

        return $listHardware;
    }

    public function updateHardware(Hardware $hardware) {
        $id_hardware = $hardware->getIdHardware();
        $nama = $hardware->getNamaHardware();
        $jenis = $hardware->getjenisHardware();
        $ip = $hardware->getIpAddress();
        $user = $hardware->getUsername();
        $pass = $hardware->getPassword();

        $query = "UPDATE hardware SET namaHardware = ?, jenisHardware = ?, ipAddress = ?, username = ?, password = ? WHERE id_hardware = ?";
        $stmt = $this->db->prepare($query);
        
        $stmt->bind_param("sssssi", $nama, $jenis, $ip, $user, $pass, $id_hardware);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteHardware($id) {
        $query = "DELETE FROM hardware WHERE id_hardware = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    
}
?>