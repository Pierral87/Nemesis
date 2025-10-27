<?php
session_start();

if (!isset($_SESSION['connected_user'])) {
    header("Location: 3.exoConnexion.php");
    exit;
}

$user = &$_SESSION['connected_user']; // Référence pour mise à jour

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: 3.exoConnexion.php");
        exit;
    }

    // Mise à jour des infos
    if (isset($_POST['update'])) {
        $newEmail = trim($_POST['email']);
        if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $user['email'] = $newEmail;
        }

        if (!empty($_POST['password']) && strlen($_POST['password']) >= 6) {
            $user['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        // Upload avatar
        if (!empty($_FILES['avatar']['name'])) {
            $targetDir = "uploads/";
            if (!is_dir($targetDir)) mkdir($targetDir);
            $fileName = uniqid() . "_" . basename($_FILES["avatar"]["name"]);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
                $user['avatar'] = $targetFile;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-tr from-purple-300 via-pink-300 to-yellow-200 min-h-screen flex items-center justify-center p-6">

<div class="bg-white bg-opacity-90 backdrop-blur-md rounded-3xl shadow-2xl max-w-lg w-full p-10 text-center">

    <!-- Avatar -->
    <div class="mb-6">
        <img src="<?= htmlspecialchars($user['avatar'] ?? "https://i.pravatar.cc/120?u=" . urlencode($user['pseudo'])) ?>"
             alt="Avatar" class="w-28 h-28 rounded-full mx-auto border-4 border-purple-400 shadow-lg">
    </div>

    <h2 class="text-4xl font-extrabold text-purple-700 mb-4 tracking-wide">Bienvenue</h2>
    <p class="text-lg text-gray-800 mb-2">Pseudo : <span class="font-semibold"><?= htmlspecialchars($user['pseudo']) ?></span></p>
    <p class="text-lg text-gray-800 mb-2">Email : <span class="font-semibold"><?= htmlspecialchars($user['email']) ?></span></p>
    <p class="text-gray-500 text-sm italic mb-6">Membre depuis : <?= date("d/m/Y", $_SESSION['registered_at'] ?? time()) ?></p>

    <!-- Formulaire de mise à jour -->
    <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label class="block text-purple-700 font-semibold mb-2">Changer d’email</label>
            <input type="email" name="email" class="w-full border-2 border-purple-400 rounded-xl px-4 py-2" placeholder="Nouvel email">
        </div>

        <div>
            <label class="block text-purple-700 font-semibold mb-2">Changer de mot de passe</label>
            <input type="password" name="password" class="w-full border-2 border-purple-400 rounded-xl px-4 py-2" placeholder="Nouveau mot de passe (6+ caractères)">
        </div>

        <div>
            <label class="block text-purple-700 font-semibold mb-2">Changer d’avatar</label>
            <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden"
                   onchange="document.getElementById('file-chosen').textContent = this.files[0]?.name || 'Aucun fichier choisi';" />
            <label for="avatar"
                   class="cursor-pointer inline-block bg-purple-600 text-white px-4 py-2 rounded-xl hover:bg-purple-700 transition">
                Choisir un fichier
            </label>
            <span id="file-chosen" class="ml-3 text-gray-700 italic">Aucun fichier choisi</span>
        </div>

        <button type="submit" name="update"
                class="w-full bg-gradient-to-r from-green-500 via-emerald-600 to-teal-500 text-white font-bold py-2 rounded-full shadow-lg hover:scale-105 transition-transform duration-300">
            Mettre à jour le profil
        </button>
    </form>

    <!-- Déconnexion -->
    <form method="POST" class="mt-6">
        <button type="submit" name="logout" 
                onclick="return confirm('Voulez-vous vraiment vous déconnecter ?')"
                class="w-full bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-500 text-white font-bold py-2 rounded-full shadow-lg hover:scale-105 transition-transform duration-300">
            Déconnexion
        </button>
    </form>
</div>

</body>
</html>
