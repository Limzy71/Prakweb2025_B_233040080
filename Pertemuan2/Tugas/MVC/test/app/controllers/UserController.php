<?php

/**
 * Controller User
 * Mengatur tampilan daftar user dan detail user
 */
class UserController
{
    private $userModel;

    // Constructor - buat object User model
    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    // Method utama - routing berdasarkan parameter id
    public function index()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $this->detail($_GET['id']);
        } else {
            $this->list();
        }
    }

    // Tampilkan daftar semua user
    private function list()
    {
        $users = $this->userModel->getAllUsers();
        require_once __DIR__ . '/../views/list.php';
    }

    // Tampilkan detail user berdasarkan id
    private function detail($id)
    {
        $user = $this->userModel->getUserById($id);
        require_once __DIR__ . '/../views/detail.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? ''
            ];

            $this->userModel->addUser($data);
            header('Location: index.php');
            exit;
        }
    }

    public function edit($id)
    {
        $user = $this->userModel->getUserById($id);
        
        require_once __DIR__ . '/../views/edit.php';
    }

    public function update()
    {
        // Ambil data dari form POST
        $id = $_POST['id'];
        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? ''
        ];

        // Panggil method updateUser di model
        $this->userModel->updateUser($id, $data);

        // Redirect kembali ke halaman utama
        header('Location: index.php');
        exit;
    }

    public function delete($id)
    {
        $this->userModel->deleteUser($id);
        
        header('Location: index.php');
        exit;
    }
}
