<?php 
$pageTitle = 'Réservations - ' . htmlspecialchars($event['title']);
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container">
    <div class="admin-header">
        <h2>📋 Réservations pour : <?php echo htmlspecialchars($event['title']); ?></h2>
        <a href="/admin/dashboard" class="btn btn-secondary">
            ← Retour au dashboard
        </a>
    </div>

    <div class="event-summary">
        <div class="summary-item">
            <strong>Date :</strong>
            <?php echo date('d/m/Y à H:i', strtotime($event['date'])); ?>
        </div>
        <div class="summary-item">
            <strong>Lieu :</strong>
            <?php echo htmlspecialchars($event['location']); ?>
        </div>
        <div class="summary-item">
            <strong>Places totales :</strong>
            <?php echo $event['seats']; ?>
        </div>
        <div class="summary-item">
            <strong>Réservations :</strong>
            <span class="badge"><?php echo count($reservations); ?></span>
        </div>
        <div class="summary-item">
            <strong>Places restantes :</strong>
            <span class="<?php echo ($event['seats'] - count($reservations)) > 0 ? 'text-success' : 'text-error'; ?>">
                <?php echo $event['seats'] - count($reservations); ?>
            </span>
        </div>
    </div>

    <div class="admin-table-container">
        <?php if (empty($reservations)): ?>
            <div class="no-data">
                <p>Aucune réservation pour cet événement.</p>
            </div>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Date de réservation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo $reservation['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($reservation['name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($reservation['email']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['phone']); ?></td>
                            <td><?php echo date('d/m/Y à H:i', strtotime($reservation['created_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
