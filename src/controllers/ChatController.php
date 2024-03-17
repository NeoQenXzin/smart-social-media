<?php

require_once __DIR__ . '/../Models/Post.php';
require_once __DIR__ . '/../Models/Database.php';

class ChatController extends Controller
{
    private $postModel;

    public function __construct($db)
    {
        $this->postModel = new Post($db);
    }

    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = trim($_POST['titre']);
            $content = trim($_POST['contenu']);
            $author = $_SESSION['username'];
            $userId = $_SESSION['user_id'];
            if (!empty($title) && !empty($content)) {
                $this->postModel->createPost($title, $content, $author, $userId);
            } else {
                $_SESSION['error'] = "Les champs titre et contenu sont requis.";
            }
            $this->redirect('/chat?view_posts=1');
        } else {
            $posts = $this->postModel->getAllPosts();
            require_once __DIR__ . '/../Views/Header.php';
            require_once __DIR__ . '/../Views/home.php';
        }
    }

    public function deletePost($postId)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
            return;
        }
        $post = $this->postModel->getPostById($postId, $_SESSION['user_id']);
        if ($post) {
            $this->postModel->deletePostById($postId, $_SESSION['user_id']);
            $_SESSION['message'] = "Post supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Action non autorisée.";
        }
        $this->redirect('/chat?view_posts=1');
    }

    public function updatePost()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postId = $_POST['id'];
            $title = trim($_POST['titre']);
            $content = trim($_POST['contenu']);
            if (!empty($title) && !empty($content)) {
                $this->postModel->updatePost($postId, $title, $content, $_SESSION['user_id']);
                $_SESSION['message'] = "Post modifié avec succès.";
            } else {
                $_SESSION['error'] = "Les champs titre et contenu sont requis.";
            }
            $this->redirect('/chat?view_posts=1');
        }
    }
}
