<?php

require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../../config/database.php';

class AdminController {
    private $db;
    private $adminModel;
    private $eventModel;
    private $reservationModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->adminModel = new Admin($this->db);
        $this->eventModel = new Event($this->db);
        $this->reservationModel = new Reservation($this->db);
    }

    
    public function login() {
        if (Admin::isLoggedIn()) {
            header('Location: /admin/dashboard');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $_SESSION['error'] = "Veuillez remplir tous les champs";
                require_once __DIR__ . '/../views/admin/login.php';
                return;
            }

            $admin = $this->adminModel->login($username, $password);

            if ($admin) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                header('Location: /admin/dashboard');
                exit();
            } else {
                $_SESSION['error'] = "Identifiants incorrects";
            }
        }

        require_once __DIR__ . '/../views/admin/login.php';
    }

    
    public function logout() {
        session_destroy();
        header('Location: /admin/login');
        exit();
    }

  
    public function dashboard() {
        Admin::requireAuth();
        $events = $this->eventModel->getAll();
        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    
    public function createEvent() {
        Admin::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            if (empty($_POST['title']) || strlen($_POST['title']) < 3) {
                $errors[] = "Le titre doit contenir au moins 3 caractères";
            }

            if (empty($_POST['description'])) {
                $errors[] = "La description est requise";
            }

            if (empty($_POST['date'])) {
                $errors[] = "La date est requise";
            }

            if (empty($_POST['location'])) {
                $errors[] = "Le lieu est requis";
            }

            if (empty($_POST['seats']) || !filter_var($_POST['seats'], FILTER_VALIDATE_INT) || $_POST['seats'] < 1) {
                $errors[] = "Le nombre de places doit être un entier positif";
            }

            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors);
                require_once __DIR__ . '/../views/admin/form_event.php';
                return;
            }

            $this->eventModel->title = $_POST['title'];
            $this->eventModel->description = $_POST['description'];
            $this->eventModel->date = $_POST['date'];
            $this->eventModel->location = $_POST['location'];
            $this->eventModel->seats = $_POST['seats'];
            $this->eventModel->image = $_POST['image'] ?? 'default-event.jpg';

            if ($this->eventModel->create()) {
                $_SESSION['success'] = "Événement créé avec succès";
                header('Location: /admin/dashboard');
                exit();
            } else {
                $_SESSION['error'] = "Échec de la création de l'événement";
            }
        }

        $event = null; 
        require_once __DIR__ . '/../views/admin/form_event.php';
    }

    
    public function editEvent() {
        Admin::requireAuth();

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: /admin/dashboard');
            exit();
        }

        $eventId = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        if (!$eventId) {
            header('Location: /admin/dashboard');
            exit();
        }

        $event = $this->eventModel->getById($eventId);
        
        if (!$event) {
            $_SESSION['error'] = "Événement introuvable";
            header('Location: /admin/dashboard');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            if (empty($_POST['title']) || strlen($_POST['title']) < 3) {
                $errors[] = "Le titre doit contenir au moins 3 caractères";
            }

            if (empty($_POST['description'])) {
                $errors[] = "La description est requise";
            }

            if (empty($_POST['date'])) {
                $errors[] = "La date est requise";
            }

            if (empty($_POST['location'])) {
                $errors[] = "Le lieu est requis";
            }

            if (empty($_POST['seats']) || !filter_var($_POST['seats'], FILTER_VALIDATE_INT) || $_POST['seats'] < 1) {
                $errors[] = "Le nombre de places doit être un entier positif";
            }

            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors);
                require_once __DIR__ . '/../views/admin/form_event.php';
                return;
            }

            $this->eventModel->id = $eventId;
            $this->eventModel->title = $_POST['title'];
            $this->eventModel->description = $_POST['description'];
            $this->eventModel->date = $_POST['date'];
            $this->eventModel->location = $_POST['location'];
            $this->eventModel->seats = $_POST['seats'];
            $this->eventModel->image = $_POST['image'] ?? $event['image'];

            if ($this->eventModel->update()) {
                $_SESSION['success'] = "Événement modifié avec succès";
                header('Location: /admin/dashboard');
                exit();
            } else {
                $_SESSION['error'] = "Échec de la modification";
            }
        }

        require_once __DIR__ . '/../views/admin/form_event.php';
    }

    
    public function deleteEvent() {
        Admin::requireAuth();

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: /admin/dashboard');
            exit();
        }

        $eventId = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        if (!$eventId) {
            header('Location: /admin/dashboard');
            exit();
        }

        $this->eventModel->id = $eventId;

        if ($this->eventModel->delete()) {
            $_SESSION['success'] = "Événement supprimé avec succès";
        } else {
            $_SESSION['error'] = "Échec de la suppression";
        }

        header('Location: /admin/dashboard');
        exit();
    }


    public function viewReservations() {
        Admin::requireAuth();

        if (!isset($_GET['event']) || empty($_GET['event'])) {
            header('Location: /admin/dashboard');
            exit();
        }

        $eventId = filter_var($_GET['event'], FILTER_VALIDATE_INT);
        if (!$eventId) {
            header('Location: /admin/dashboard');
            exit();
        }

        $event = $this->eventModel->getById($eventId);
        
        if (!$event) {
            $_SESSION['error'] = "Événement introuvable";
            header('Location: /admin/dashboard');
            exit();
        }

        $reservations = $this->reservationModel->getByEvent($eventId);
        
        require_once __DIR__ . '/../views/admin/reservations.php';
    }
}
?>
