<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "config/Database.php";
require_once "models/Model.php";

require_once "controllers/AuthController.php";
require_once "controllers/ProjectController.php";

$database = new Databases();
$model = new Model($database);

$authController = new AuthController($model);
$projectController = new ProjectController($model);

$action = isset($_GET['action']) ? $_GET['action'] : 'listProject';

switch ($action) {
    case 'login':
        $authController->login();
        break;
        
    case 'logout':
        $authController->logout();
        break;
        
    case 'listProject':
        $projectController->listProject();
        break;
        
    case 'detailProject':
        $projectController->detailProject();
        break;
    
    case 'addHardware':
        $projectController->addHardware();
        break;
        
    case 'editHardware':
        $projectController->editHardware();
        break;
        
    case 'deleteHardware':
        $projectController->removeHardware();
        break;

    default:
        header("Location: index.php?action=listProject");
        exit;
}