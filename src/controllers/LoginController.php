<?php
require_once __DIR__ . '/../models/User.php';

class LoginController extends Controller
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
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $user = $this->userModel->login($username, $password);

            if ($user && !empty($username) && !empty($password)) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $this->redirect('/');
            } else {
                $error = "Identifiants incorrects";
                require_once __DIR__ . '/../Views/Login.php';
            }
        } else {
            require_once __DIR__ . '/../Views/Login.php';
        }
    }
}
