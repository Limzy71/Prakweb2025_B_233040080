<?php
// Load semua file yang diperlukan
require_once __DIR__ . '/../app/config/Database.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/controllers/UserController.php';

// Buat koneksi database
$database = new Database();
$pdo = $database->connect();

// Jalankan controller
$controller = new UserController($pdo);

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

if ($action == 'add' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->add();
} elseif ($action == 'edit' && $id) {
    $controller->edit($id);
} elseif ($action == 'update' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->update();
} else if ($action == 'delete' && $id) {
    $controller->delete($id);
} else {
    $controller->index();
}