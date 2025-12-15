<?php

require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../../config/database.php';

class EventController {
    private $db;
    private $eventModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->eventModel = new Event($this->db);
    }

    
    public function list() {
        $events = $this->eventModel->getUpcoming();
        require_once __DIR__ . '/../views/events/list.php';
    }

    
    public function details() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: /events');
            exit();
        }

        $eventId = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        if (!$eventId) {
            header('Location: /events');
            exit();
        }

        $event = $this->eventModel->getById($eventId);
        
        if (!$event) {
            header('Location: /events');
            exit();
        }

        $availableSeats = $this->eventModel->getAvailableSeats($eventId);
        
        require_once __DIR__ . '/../views/events/details.php';
    }
}
?>
