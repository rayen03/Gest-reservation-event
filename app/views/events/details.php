<?php 
$pageTitle = htmlspecialchars($event['title']) . ' - MiniEvent';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container">
    <div class="event-details">
        <div class="event-details-image">
            <img src="/images/<?php echo htmlspecialchars($event['image']); ?>" 
                 alt="<?php echo htmlspecialchars($event['title']); ?>"
                 onerror="this.src='/images/default-event.jpg'">
        </div>

        <div class="event-details-content">
            <h2><?php echo htmlspecialchars($event['title']); ?></h2>
            
            <div class="event-info-grid">
                <div class="info-item">
                    <strong>📅 Date :</strong>
                    <span><?php echo date('d/m/Y à H:i', strtotime($event['date'])); ?></span>
                </div>
                <div class="info-item">
                    <strong>📍 Lieu :</strong>
                    <span><?php echo htmlspecialchars($event['location']); ?></span>
                </div>
                <div class="info-item">
                    <strong>🪑 Places totales :</strong>
                    <span><?php echo $event['seats']; ?></span>
                </div>
                <div class="info-item">
                    <strong>✅ Places disponibles :</strong>
                    <span class="<?php echo $availableSeats > 0 ? 'text-success' : 'text-error'; ?>">
                        <?php echo $availableSeats; ?>
                    </span>
                </div>
            </div>

            <div class="event-description">
                <h3>Description</h3>
                <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
            </div>

            <?php if ($availableSeats > 0): ?>
                <div class="reservation-form-section">
                    <h3>Réserver ma place</h3>
                    <form action="/reservations/create" method="POST" id="reservationForm" class="reservation-form">
                        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                        
                        <div class="form-group">
                            <label for="name">Nom complet *</label>
                            <input type="text" id="name" name="name" required minlength="3" 
                                   placeholder="Ex: Ahmed Ben Ali">
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required 
                                   placeholder="Ex: ahmed@example.com">
                        </div>

                        <div class="form-group">
                            <label for="phone">Téléphone *</label>
                            <input type="tel" id="phone" name="phone" required 
                                   placeholder="Ex: +216 20 123 456">
                        </div>

                        <button type="submit" class="btn btn-primary btn-large">
                            Confirmer ma réservation
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <div class="alert alert-error">
                    <strong>Désolé !</strong> Toutes les places pour cet événement sont réservées.
                </div>
            <?php endif; ?>

            <a href="/events" class="btn btn-secondary">
                ← Retour aux événements
            </a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
