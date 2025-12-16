<?php 
$pageTitle = 'Connexion Admin - MiniEvent';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container">
    <div class="login-container">
        <div class="login-box">
            <h2> Connexion Administrateur</h2>
            
            <form action="/admin/login" method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-large">
                    Se connecter
                </button>
            </form>

            <div class="login-help">
                <p><strong>Identifiants par défaut :</strong></p>
                <p>Username: <code>admin</code></p>
                <p>Password: <code>admin123</code></p>
            </div>

            <a href="/events" class="btn btn-secondary">
                ← Retour au site
            </a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
