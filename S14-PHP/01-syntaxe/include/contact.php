<?php 
require_once("partials/_config.php");
require_once("partials/_functions.php");




// ICI CODE PHP DE LA PAGE EN COURS // GESTION DE FILTRE ET ENVOI DE L'EMAIL



require_once("partials/_header.php"); // ICI DEBUT DES AFFICHAGES ET INITIALISATION DES HEADERS HTTP
require_once("partials/_nav.php");
?>
<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Inscrivez vous pour pouvoir commander : </h1>
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>
<?php
require_once("partials/_footer.php");
