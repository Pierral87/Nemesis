<?php
session_start();

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

$pseudo = "";
$password = "";
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["pseudo"], $_POST["password"])) {
    $pseudo = trim($_POST['pseudo'] ?? "");
    $password = $_POST['password'] ?? "";

    if ($pseudo === "" || $password === "") {
        $errors[] = "Veuillez remplir tous les champs.";
    } else {
        $userFound = null;

        
        foreach ($_SESSION['users'] as $user) {
            if ($user['pseudo'] === $pseudo) {
                $userFound = $user;
                break;
            }
        }

        if (!$userFound) {
            $errors[] = "Pseudo introuvable.";
        } else {
            if (password_verify($password, $userFound['password'])) {
                $_SESSION['connected_user'] = $userFound;
                header("Location: SelsabilProfil.php");
                exit;
            } else {
                $errors[] = "Mot de passe incorrect.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-tr from-purple-300 via-pink-300 to-yellow-200 min-h-screen flex items-center justify-center p-6">

<div class="bg-white bg-opacity-80 backdrop-blur-md rounded-3xl shadow-2xl max-w-md w-full p-10">
    <h2 class="text-4xl font-extrabold text-purple-700 mb-6 text-center tracking-wide">Connexion</h2>

    <?php if (!empty($errors)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 shadow-inner">
            <ul class="list-disc list-inside">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" class="space-y-6">
        <div>
            <label for="pseudo" class="block text-purple-700 font-semibold mb-2">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" value="<?= htmlspecialchars($pseudo) ?>"
                   class="w-full px-4 py-3 border-2 border-purple-400 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-300 transition duration-300"
                   required />
        </div>

        <div>
            <label for="password" class="block text-purple-700 font-semibold mb-2">Mot de passe</label>
            <input type="password" id="password" name="password"
                   class="w-full px-4 py-3 border-2 border-purple-400 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-300 transition duration-300"
                   required />
        </div>

        <button type="submit"
                class="w-full bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-500 text-white font-bold py-3 rounded-full shadow-lg hover:scale-105 transition-transform duration-300">
            Se connecter
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="2.exoInscription.php" class="text-purple-700 font-bold hover:underline">Pas encore inscrit ? S'inscrire</a>
    </div>
</div>

</body>
</html>
