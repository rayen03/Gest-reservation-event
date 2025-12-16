<?php 
$pageTitle = 'Dashboard Admin - MiniEvent';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container">
    <div class="admin-header">
        <h2> Dashboard Admin</h2>
        <a href="/admin/events/create" class="btn btn-primary">
            Créer un événement
        </a>
    </div>

    <div class="admin-stats">
        <div class="stat-card">
            <h3>Total Événements</h3>
            <p class="stat-number"><?php echo count($events); ?></p>
        </div>
    </div>

    <div class="admin-table-container">
        <h3>Gestion des Événements</h3>
        
        <?php if (empty($events)): ?>
            <div class="no-data">
                <p>Aucun événement créé. Commencez par en ajouter un!</p>
            </div>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Places</th>
                        <th>Réservations</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                        <?php
                        require_once __DIR__ . '/../../models/Reservation.php';
                        $reservationModel = new Reservation($this->db);
                        $reservedCount = $reservationModel->countByEvent($event['id']);
                        ?>
                        <tr>
                            <td><?php echo $event['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($event['title']); ?></strong></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($event['date'])); ?></td>
                            <td><?php echo htmlspecialchars($event['location']); ?></td>
                            <td><?php echo $event['seats']; ?></td>
                            <td>
                                <a href="/admin/reservations?event=<?php echo $event['id']; ?>" class="link-info">
                                    <?php echo $reservedCount; ?> réservation(s)
                                </a>
                            </td>
                            <td class="action-buttons">
                                <a href="/events/details?id=<?php echo $event['id']; ?>" 
                                   class="btn btn-small btn-info" title="Voir">
                                    
                                </a>
                                <a href="/admin/events/edit?id=<?php echo $event['id']; ?>" 
                                   class="btn btn-small btn-secondary" title="Modifier">
                                    
                                </a>
                                <a href="/admin/events/delete?id=<?php echo $event['id']; ?>" 
                                   class="btn btn-small btn-danger" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement?')"
                                   title="Supprimer">
                                    
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
