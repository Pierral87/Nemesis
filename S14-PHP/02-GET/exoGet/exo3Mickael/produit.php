<?php
session_start();

// Récupération du produit via GET
$id = $_GET['id'] ?? null;
$produit = null;

if ($id) {
    foreach ($_SESSION['produits'] as $p) {
        if ($p['id'] == $id) {
            $produit = $p;
            break;
        }
    }
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Fiche produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .produit {
            max-width: 400px;
            margin: auto;
            text-align: center;
        }

        .produit img {
            width: 100%;
            height: auto;
            border-radius: 6px;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007BFF;
        }
    </style>
</head>

<body>
    <h1>Fiche produit</h1>

    <?php if ($produit): ?>
        <div class="produit">
            <img src="<?= $produit['image'] ?>" alt="<?= htmlspecialchars($produit['nom']) ?>">
            <h2><?= htmlspecialchars($produit['nom']) ?></h2>
            <p><?= htmlspecialchars($produit['description']) ?></p>
            <p><strong>Catégorie :</strong> <?= htmlspecialchars($produit['categorie']) ?></p>
            <a href="3-exoProductList.php">← Retour à la boutique</a>
        </div>
    <?php else: ?>
        <p>Produit introuvable.</p>
        <a href="3-exoProductList.php">← Retour à la boutique</a>
    <?php endif; ?>
</body>

</html>