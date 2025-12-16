<?php

require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../../config/database.php';

class ReservationController {
    private $db;
    private $reservationModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->reservationModel = new Reservation($this->db);
    }


    public function create() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /events');
            exit();
        }


        $errors = [];
        
        if (empty($_POST['event_id']) || !filter_var($_POST['event_id'], FILTER_VALIDATE_INT)) {
            $errors[] = "ID d'événement invalide";
        }
        
        if (empty($_POST['name']) || strlen($_POST['name']) < 3) {
            $errors[] = "Le nom doit contenir au moins 3 caractères";
        }
        
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email invalide";
        }
        
        if (empty($_POST['phone']) || !preg_match('/^[\d\s\+\-\(\)]{8,20}$/', $_POST['phone'])) {
            $errors[] = "Numéro de téléphone invalide";
        }

        if (!empty($errors)) {
            $_SESSION['error'] = implode('<br>', $errors);
            header('Location: /events/details?id=' . $_POST['event_id']);
            exit();
        }

$this->reservationModel->event_id = $_POST['event_id'];
        $this->reservationModel->name = $_POST['name'];
        $this->reservationModel->email = $_POST['email'];
        $this->reservationModel->phone = $_POST['phone'];

        if ($this->reservationModel->create()) {
            $_SESSION['success'] = "Votre réservation a été enregistrée avec succès!";
            header('Location: /events/details?id=' . $_POST['event_id']);
            exit();
        } else {
            $_SESSION['error'] = "Échec de la réservation. Places épuisées ou erreur système.";
            header('Location: /events/details?id=' . $_POST['event_id']);
            exit();
        }
    }
}
?>