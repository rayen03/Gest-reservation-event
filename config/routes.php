<?php

return [
    '' => ['controller' => 'EventController', 'action' => 'list'],
    'events' => ['controller' => 'EventController', 'action' => 'list'],
    'events/details' => ['controller' => 'EventController', 'action' => 'details'],
    'reservations/create' => ['controller' => 'ReservationController', 'action' => 'create'],
    
    'admin/login' => ['controller' => 'AdminController', 'action' => 'login'],
    'admin/logout' => ['controller' => 'AdminController', 'action' => 'logout'],
    'admin/dashboard' => ['controller' => 'AdminController', 'action' => 'dashboard'],
    'admin/events/create' => ['controller' => 'AdminController', 'action' => 'createEvent'],
    'admin/events/edit' => ['controller' => 'AdminController', 'action' => 'editEvent'],
    'admin/events/delete' => ['controller' => 'AdminController', 'action' => 'deleteEvent'],
    'admin/reservations' => ['controller' => 'AdminController', 'action' => 'viewReservations'],
];
?>
