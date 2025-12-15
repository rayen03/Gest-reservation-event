<?php

class Event {
    private $conn;
    private $table = 'events';

    public $id;
    public $title;
    public $description;
    public $date;
    public $location;
    public $seats;
    public $image;
    public $created_at;

    
    public function __construct($db) {
        $this->conn = $db;
    }

    
    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
    public function getUpcoming() {
        $query = "SELECT * FROM " . $this->table . " WHERE date >= NOW() ORDER BY date ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

   
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    
    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  (title, description, date, location, seats, image) 
                  VALUES (:title, :description, :date, :location, :seats, :image)";
        
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->image = htmlspecialchars(strip_tags($this->image));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':seats', $this->seats, PDO::PARAM_INT);
        $stmt->bindParam(':image', $this->image);

        return $stmt->execute();
    }

    
    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET title = :title, 
                      description = :description, 
                      date = :date, 
                      location = :location, 
                      seats = :seats, 
                      image = :image 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->image = htmlspecialchars(strip_tags($this->image));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':seats', $this->seats, PDO::PARAM_INT);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

   
    public function getAvailableSeats($eventId) {
        $event = $this->getById($eventId);
        if (!$event) return 0;
        
        $query = "SELECT COUNT(*) as reserved FROM reservations WHERE event_id = :event_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        
        return $event['seats'] - $result['reserved'];
    }
}
?>
