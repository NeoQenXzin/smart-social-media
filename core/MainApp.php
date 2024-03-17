<?php

require_once __DIR__ . '/../src/Models/Database.php';
require_once __DIR__ . '/../src/Controllers/Controller.php';
require_once __DIR__ . '/../src/Controllers/MainController.php';
require_once __DIR__ . '/../src/Controllers/LoginController.php';
require_once __DIR__ . '/../src/Controllers/LogoutController.php';
require_once __DIR__ . '/../src/Controllers/RegisterController.php';
require_once __DIR__ . '/../src/Controllers/ChatController.php';

class MainApp
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function run()
    {
        $url = $_SERVER['REQUEST_URI'];
        $path = parse_url($url, PHP_URL_PATH);
        $route = trim($path, '/');

        switch ($route) {
            case '':
            case '/':
                $controller = new MainController();
                break;
            case 'login':
                $controller = new LoginController();
                break;
            case 'logout':
                $controller = new LogoutController();
                break;
            case 'signup':
                $controller = new RegisterController();
                break;
                // case 'chat':
                //     $controller = new ChatController($this->db);
                //     break;
            case 'chat':
                $controller = new ChatController($this->db);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $action = $_POST['action'] ?? null;
                    $id = $_POST['id'] ?? null;
                    if ($action == 'delete' && $id) {
                        $controller->deletePost($id);
                    } elseif ($action == 'update' && $id) {
                        $controller->updatePost();
                    }
                } else {
                    $controller->index();
                }
                break;

            default:
                http_response_code(404);
                require_once(__DIR__ . '/../src/Views/error_404.php');
                return;
        }

        if (method_exists($controller, 'index')) {
            $controller->index();
        } else {
            throw new Exception("La méthode index n'existe pas dans le contrôleur spécifié.");
        }
    }
}
