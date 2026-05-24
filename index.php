<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// ---------------------------------------

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "config/Database.php";
require_once "models/Model.php";
require_once "controllers/AuthController.php";
require_once "controllers/ProjectController.php";

$database = new Databases();
$model = new Model($database);

$action = isset($_GET['action']) ? $_GET['action'] : 'listProject';

switch ($action) {
    case 'login':
        $authController = new AuthController($model);
        $authController->login();
        break;
        
    case 'logout':
        $authController = new AuthController($model);
        $authController->logout();
        break;
        
    case 'listProject':
        $projectController = new ProjectController($model);
        $projectController->listProject();
        break;
        
    case 'addProject':
        $projectController = new ProjectController($model);
        $projectController->addProject();
        break;
        
    case 'detailProject':
        $projectController = new ProjectController($model);
        $projectController->detailProject();
        break;
    
    case 'addHardware':
        $projectController = new ProjectController($model);
        $projectController->addHardware();
        break;
        
    case 'editHardware':
        $projectController = new ProjectController($model);
        $projectController->editHardware();
        break;
        
    case 'deleteHardware':
        $projectController = new ProjectController($model);
        $projectController->removeHardware();
        break;

    default:
        header("Location: index.php?action=listProject");
        exit;
}
?>