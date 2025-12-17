<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'MiniEvent - Gestion d\'Événements'; ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container">
            <div class="header-content">
                <h1 class="site-logo">
                    <a href="/events">🎉 MiniEvent</a>
                </h1>
                <nav class="main-nav">
                    <a href="/events" class="nav-link">Événements</a>
                    <?php if (isset($_SESSION['admin_id'])): ?>
                        <a href="/admin/dashboard" class="nav-link">Dashboard</a>
                        <a href="/admin/logout" class="nav-link">Déconnexion</a>
                    <?php else: ?>
                        <a href="/admin/login" class="nav-link">Admin</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

    <main class="main-content">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
