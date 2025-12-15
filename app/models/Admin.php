<?php

class Admin {
    private $conn;
    private $table = 'admin';

    public $id;
    public $username;
    public $password_hash;

   
    public function __construct($db) {
        $this->conn = $db;
    }

    
    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $admin = $stmt->fetch();
        
        if ($admin && password_verify($password, $admin['password_hash'])) {
            return $admin;
        }
        
        return false;
    }

    
    public static function isLoggedIn() {
        return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
    }

    
    public static function requireAuth() {
        if (!self::isLoggedIn()) {
            header('Location: /admin/login');
            exit();
        }
    }

    
    public function create() {
        $query = "INSERT INTO " . $this->table . " (username, password_hash) VALUES (:username, :password_hash)";
        
        $stmt = $this->conn->prepare($query);
        
        $hashed_password = password_hash($this->password_hash, PASSWORD_DEFAULT);
        
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password_hash', $hashed_password);
        
        return $stmt->execute();
    }

   
    public function getById($id) {
        $query = "SELECT id, username, created_at FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
