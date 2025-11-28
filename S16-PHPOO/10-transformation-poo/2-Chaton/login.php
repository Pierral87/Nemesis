<?php

use ProjetTransfo\Classes\Database;
use ProjetTransfo\Classes\User;

include 'src/partials/_navbar.php'; 


$db = new Database();

$isSubmitted = ($_SERVER['REQUEST_METHOD'] === 'POST');
$loginError = '';

if ($isSubmitted) {
    if (User::login($db, $_POST['email'], $_POST['password'])) {
        header("Location: index.php");
        exit;
    } else {
        $loginError = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion OO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

    <h1>Connexion</h1>
    <a href="register.php" class="btn btn-outline-secondary btn-sm mt-2">⇦ Aller à l'inscription</a>

    <?php if ($loginError): ?>
        <div class="alert alert-danger mt-4"><?= $loginError ?></div>
    <?php endif; ?>

    <form method="POST" class="mt-4 col-md-6">
        <div class="mb-3">
            <label class="form-label">Email :</label>
            <input type="email" name="email" class="form-control" 
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Mot de passe :</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Se connecter</button>
    </form>

</body>
</html>
