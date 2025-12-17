<?php 
$pageTitle = 'Liste des Événements - MiniEvent';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container">
    <section class="page-header">
        <h2>Événements à Venir</h2>
        <p>Découvrez nos événements et réservez votre place dès maintenant!</p>
    </section>

    <div class="events-grid">
        <?php if (empty($events)): ?>
            <div class="no-events">
                <p>Aucun événement disponible pour le moment.</p>
            </div>
        <?php else: ?>
            <?php foreach ($events as $event): ?>
                <article class="event-card">
                    <div class="event-image">
                        <img src="/images/<?php echo htmlspecialchars($event['image']); ?>" 
                             alt="<?php echo htmlspecialchars($event['title']); ?>"
                             onerror="this.src='/images/default-event.jpg'">
                    </div>
                    <div class="event-content">
                        <h3 class="event-title"><?php echo htmlspecialchars($event['title']); ?></h3>
                        <p class="event-description">
                            <?php echo htmlspecialchars(substr($event['description'], 0, 120)) . '...'; ?>
                        </p>
                        <div class="event-meta">
                            <span class="event-date">
                                📅 <?php echo date('d/m/Y à H:i', strtotime($event['date'])); ?>
                            </span>
                            <span class="event-location">
                                📍 <?php echo htmlspecialchars($event['location']); ?>
                            </span>
                            <span class="event-seats">
                                🪑 <?php echo $event['seats']; ?> places
                            </span>
                        </div>
                        <a href="/events/details?id=<?php echo $event['id']; ?>" class="btn btn-primary">
                            Voir les détails
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
