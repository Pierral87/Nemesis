<?php

/* 

    EXERCICE GET : 
        Créer une page d'accueil de site ecommerce avec une liste de produit et page produit

            Etapes : 
                1 - Lancer l'instruction session_start(), cela vous donne accès à une superglobale nommée $_SESSION (c'est un array) qui peut stocker les données de votre choix et les transporter tout au long de la navigation 
                
                2 - Dans cette superglobale, à un indice [produits], insérer des données fictives de produits, par exemple, id, nom, description, categorie, image (utilisez picsum pour générer des photos aléatoires) (cet array va représenter le retour d'une requête de selection en base de données)
                
                3 - Créer une base de page html pour créer un affichage de liste des produits représentant les produits présents dans votre array session
                
                4 - Rajouter un menu de votre choix permettant de choisir la catégorie de produits
                
                5 - Créer une communication de votre choix par GET via ce menu ou filtre pour n'afficher que les produits d'une certaine catégorie
                
                6 - Sur chaque affichage produit, créer un bouton qui amènera sur la fiche produit (autre page) pour n'avoir que ce produit là d'affiché (utilisation de GET ici aussi)
                
                7 - Une fois l'exercice terminé, lancer l'instruction session_destroy();

*/

session_start();

// Initialisation des produits si absent
if (!isset($_SESSION['produits'])) {
    $_SESSION['produits'] = [
        [
            'id' => 1,
            'nom' => 'Chaussures de sport',
            'description' => 'Chaussures confortables pour le running.',
            'categorie' => 'sport',
            'image' => 'https://picsum.photos/200/200?random=1'
        ],
        [
            'id' => 2,
            'nom' => 'Sac à dos',
            'description' => 'Sac à dos léger et pratique pour les voyages.',
            'categorie' => 'voyage',
            'image' => 'https://picsum.photos/200/200?random=2'
        ],
        [
            'id' => 3,
            'nom' => 'Montre connectée',
            'description' => 'Suivez vos performances et notifications.',
            'categorie' => 'technologie',
            'image' => 'https://picsum.photos/200/200?random=3'
        ],
        [
            'id' => 4,
            'nom' => 'T-shirt',
            'description' => 'T-shirt en coton bio, confortable.',
            'categorie' => 'vetement',
            'image' => 'https://picsum.photos/200/200?random=4'
        ],
        [
            'id' => 5,
            'nom' => 'Sac de sport',
            'description' => 'Sac de sport robuste et spacieux.',
            'categorie' => 'sport',
            'image' => 'https://picsum.photos/200/200?random=5'
        ]
    ];
}

// Gestion du filtre catégorie via GET
$categorie = $_GET['categorie'] ?? null;

// Filtrer les produits si catégorie sélectionnée
$produits_affiches = [];
if ($categorie) {
    foreach ($_SESSION['produits'] as $produit) {
        if ($produit['categorie'] === $categorie) {
            $produits_affiches[] = $produit;
        }
    }
} else {
    $produits_affiches = $_SESSION['produits'];
}

// Liste des catégories pour le menu
$categories = ['sport', 'voyage', 'technologie', 'vetement']; ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Mini e-commerce</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .menu {
            margin-bottom: 20px;
        }

        .menu a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
        }

        .produits {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .produit {
            border: 1px solid #ccc;
            padding: 10px;
            width: 200px;
            text-align: center;
            border-radius: 6px;
        }

        .produit img {
            width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .produit a.button {
            display: inline-block;
            margin-top: 8px;
            padding: 6px 12px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h1>Bienvenue sur notre boutique</h1>

    <!-- Menu catégorie -->
    <div class="menu">
        <span>Filtrer par catégorie : </span>
        <a href="3-exoProductList.php">Tous</a>
        <?php foreach ($categories as $cat): ?>
            <a href="3-exoProductList.php?categorie=<?= $cat ?>"><?= ucfirst($cat) ?></a>
        <?php endforeach; ?>
    </div>

    <!-- Liste des produits -->
    <div class="produits">
        <?php foreach ($produits_affiches as $produit): ?>
            <div class="produit">
                <img src="<?= $produit['image'] ?>" alt="<?= htmlspecialchars($produit['nom']) ?>">
                <h3><?= htmlspecialchars($produit['nom']) ?></h3>
                <p><?= htmlspecialchars($produit['description']) ?></p>
                <a class="button" href="produit.php?id=<?= $produit['id'] ?>">Voir le produit</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>