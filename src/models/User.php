<?php

class User
{
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register($username, $email, $password)
    {
        // Vérifie si l'email est déjà utilisé
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            throw new Exception("Email déjà utilisé.");
        }

        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertion de l'utilisateur
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashedPassword]);

        return $this->conn->lastInsertId(); // Retourne l'ID de l'utilisateur inscrit
    }


    public function login($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT id, username, password FROM " . $this->table_name . " WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user; // Retourne l'utilisateur si le mot de passe est correct
            }
        }
        return null; // Retourne null si l'authentification échoue
    }
}
