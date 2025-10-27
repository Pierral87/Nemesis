<?php
$content = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["plat"])) {
    $plat = htmlspecialchars($_POST["plat"]);

    $content = "
    <div class='card'>
        <div class='card-header bg-success text-white'>
            <h5>Votre choix</h5>
        </div>
        <div class='card-body'>
            <p><strong>Plat choisi :</strong> $plat</p>
        </div>
    </div>";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix plat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Choisissez un plat</h1>

                <form action="" method="POST" class="mb-4">
                    <div class="mb-3">
                        <label for="plat" class="form-label">Plat</label>
                        <select class="form-select" id="plat" name="plat">
                            <option value="pates">Pâtes</option>
                            <option value="riz">Riz</option>
                            <option value="pizza">Pizza</option>
                            <option value="tacos">Tacos</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
                <?= $content ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>