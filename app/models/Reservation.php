<?php

class Reservation {
    private $conn;
    private $table = 'reservations';

    public $id;
    public $event_id;
    public $name;
    public $email;
    public $phone;
    public $created_at;


    public function __construct($db) {
        $this->conn = $db;
    }


    public function create() {
        $eventModel = new Event($this->conn);
        $availableSeats = $eventModel->getAvailableSeats($this->event_id);
        
        if ($availableSeats <= 0) {
            return false;
        }

        $query = "INSERT INTO " . $this->table . " 
                  (event_id, name, email, phone) 
                  VALUES (:event_id, :name, :email, :phone)";
        
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));

        $stmt->bindParam(':event_id', $this->event_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);

        return $stmt->execute();
    }

    
    public function getByEvent($eventId) {
        $query = "SELECT r.*, e.title as event_title 
                  FROM " . $this->table . " r 
                  LEFT JOIN events e ON r.event_id = e.id 
                  WHERE r.event_id = :event_id 
                  ORDER BY r.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

   
    public function getAll() {
        $query = "SELECT r.*, e.title as event_title 
                  FROM " . $this->table . " r 
                  LEFT JOIN events e ON r.event_id = e.id 
                  ORDER BY r.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

   
    public function countByEvent($eventId) {
        $query = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE event_id = :event_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
