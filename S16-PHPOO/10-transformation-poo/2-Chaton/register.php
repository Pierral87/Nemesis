<?php

use ProjetTransfo\Classes\Database;
use ProjetTransfo\Classes\FormValidator;
use ProjetTransfo\Classes\User;

include 'src/partials/_navbar.php'; 


$db = new Database();

$isSubmitted = ($_SERVER['REQUEST_METHOD'] === 'POST');
$errors = [];
$success = false;

if ($isSubmitted) {
    $validator = new FormValidator($_POST);

    if ($validator->validate()) {
        $user = new User($_POST);
        if ($user->register($db)) {
            $success = true;
        } else {
            $errors['global'] = "Erreur lors de l'enregistrement en base.";
        }
    } else {
        $errors = $validator->getErrors();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription OO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

    <h1>Inscription</h1>
    <a href="login.php" class="btn btn-outline-secondary btn-sm mt-2">⇦ Aller à la connexion</a>

    <?php if ($success): ?>
        <div class="alert alert-success mt-4">
            🎉 Inscription réussie ! Vous pouvez maintenant vous connecter.
        </div>
    <?php endif; ?>

    <?php if (isset($errors['global'])): ?>
        <div class="alert alert-danger mt-4"><?= $errors['global'] ?></div>
    <?php endif; ?>

    <form method="POST" class="mt-4 col-md-6">
        <div class="mb-3">
            <label class="form-label">Pseudo</label>
            <input type="text" name="username" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>" 
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            <div class="invalid-feedback"><?= $errors['username'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= $errors['password'] ?? '' ?></div>
        </div>

        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>

</body>
</html>
