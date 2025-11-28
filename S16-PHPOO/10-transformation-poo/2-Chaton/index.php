<?php
include 'src/partials/_navbar.php'; 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

    <?php if ($username): ?>
        <h1>Bienvenue <?= htmlspecialchars($username) ?> !</h1>
        <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
    <?php else: ?>
        <h1>Bienvenue 👋</h1>
        <?php var_dump($_SESSION) ?>
        <a href="login.php" class="btn btn-primary">Connexion</a>
        <a href="register.php" class="btn btn-success">Inscription</a>
    <?php endif; ?>

</body>
</html>
