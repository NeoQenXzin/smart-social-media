<?php

class RegisterController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->userModel = new User($db);
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            try {
                $this->userModel->register($username, $email, $password);
                echo "Inscription réussie. <a href='/login'>Cliquez ici pour vous connecter</a>";
            } catch (Exception $e) {
                echo "Erreur lors de l'inscription : " . $e->getMessage();
                require_once __DIR__ . '/../Views/sign_up.php';
            }
        } else {
            require_once __DIR__ . '/../Views/Header.php';
            require_once __DIR__ . '/../Views/sign_up.php';
        }
    }
}
