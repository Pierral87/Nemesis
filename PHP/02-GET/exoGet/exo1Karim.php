<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pays</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
<?php

if (isset($_GET["pays"])) {
    if ($_GET["pays"] == "france") :
        $pays = "Français";
     elseif ($_GET["pays"] == "italie") :
        $pays = "Italiano";
     elseif ($_GET["pays"] == "portugal") :
        $pays = "Portugais";
     elseif ($_GET["pays"] == "chine") :
        $pays = "Chinois";
     endif;
}
?>
<div class="container text-center mt-5">
    <div class="row row-cols-2">
        <div class="col">
            <a href="?pays=france">France</a>
        </div>
        <div class="col">
            <a href="?pays=italie">Italie</a>
        </div>
        <div class="col">
            <a href="?pays=portugal">Portugal</a>
        </div>
        <div class="col">
            <a href="?pays=chine">Chine</a>
        </div>
    </div>

    <?php
    if (!empty($pays)) : ?>
        <h1>Vous êtes : <?= $pays ?></h1>
    <?php else : ?>
        <h1>Choisissez un pays</h1>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>