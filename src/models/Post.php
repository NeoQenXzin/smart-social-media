<?php

class Post
{
    private $conn;
    private $table_name = "posts";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createPost($titre, $contenu, $auteur, $user_id)
    {
        $query = "INSERT INTO " . $this->table_name . " (titre, contenu, auteur,user_id, created_at) VALUES (?, ?, ?,?, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$titre, $contenu, $auteur, $user_id]);
    }

    public function getAllPosts()
    {
        $query = "SELECT id, titre, contenu ,auteur, user_id, created_at FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletePostById($postId, $userId)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$postId, $userId]);
    }

    public function updatePost($postId, $titre, $contenu, $userId)
    {
        $query = "UPDATE " . $this->table_name . " SET titre = ?, contenu = ? WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$titre, $contenu, $postId, $userId]);
    }

    public function getPostById($postId, $userId)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$postId, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
