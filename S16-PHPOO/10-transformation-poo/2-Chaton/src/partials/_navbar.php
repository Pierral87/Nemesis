<?php

use ProjetTransfo\Classes\Config;
use ProjetTransfo\Classes\SessionManager;

require_once 'vendor/autoload.php';
SessionManager::start();

$isLogged = SessionManager::get('username') !== null;
$username = SessionManager::get('username');
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">MonSiteOO</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar" aria-controls="mainNavbar"
                aria-expanded="false" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Inscription</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Connexion</a></li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <?php if ($isLogged): ?>
                    <li class="nav-item">
                        <span class="navbar-text me-3">
                            👤 Connecté : <strong><?= htmlspecialchars($username) ?></strong>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger btn-sm" href="logout.php">
                            Déconnexion
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-success btn-sm me-2" href="register.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm" href="login.php">Connexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
