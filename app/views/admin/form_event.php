<?php 
$isEdit = isset($event) && !empty($event);
$pageTitle = ($isEdit ? 'Modifier' : 'Créer') . ' un Événement - MiniEvent';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container">
    <div class="form-container">
        <h2><?php echo $isEdit ? '✏️ Modifier' : '➕ Créer'; ?> un Événement</h2>

        <form action="<?php echo $isEdit ? '/admin/events/edit?id=' . $event['id'] : '/admin/events/create'; ?>" 
              method="POST" class="event-form">
            
            <div class="form-group">
                <label for="title">Titre de l'événement *</label>
                <input type="text" id="title" name="title" required minlength="3"
                       value="<?php echo $isEdit ? htmlspecialchars($event['title']) : ''; ?>"
                       placeholder="Ex: Conference Tech 2025">
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea id="description" name="description" required rows="6"
                          placeholder="Décrivez l'événement en détail..."><?php echo $isEdit ? htmlspecialchars($event['description']) : ''; ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="date">Date et heure *</label>
                    <input type="datetime-local" id="date" name="date" required
                           value="<?php echo $isEdit ? date('Y-m-d\TH:i', strtotime($event['date'])) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="seats">Nombre de places *</label>
                    <input type="number" id="seats" name="seats" required min="1"
                           value="<?php echo $isEdit ? $event['seats'] : ''; ?>"
                           placeholder="Ex: 100">
                </div>
            </div>

            <div class="form-group">
                <label for="location">Lieu *</label>
                <input type="text" id="location" name="location" required
                       value="<?php echo $isEdit ? htmlspecialchars($event['location']) : ''; ?>"
                       placeholder="Ex: Centre de Conférence, Tunis">
            </div>

            <div class="form-group">
                <label for="image">Image (nom de fichier)</label>
                <input type="text" id="image" name="image"
                       value="<?php echo $isEdit ? htmlspecialchars($event['image']) : 'default-event.jpg'; ?>"
                       placeholder="Ex: conference.jpg">
                <small>Placez l'image dans le dossier /public/images/</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-large">
                    <?php echo $isEdit ? '💾 Enregistrer les modifications' : '➕ Créer l\'événement'; ?>
                </button>
                <a href="/admin/dashboard" class="btn btn-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
