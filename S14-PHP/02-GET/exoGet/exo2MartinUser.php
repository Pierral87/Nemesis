<?php
// user.php

session_start();

$id = $_GET['id'] ?? null;

var_dump(isset($id));

$user = null;

foreach ($_SESSION["users"] as $u) {
      if ($u["id"] == $id) {
            $user = $u;
            break;
      }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>User</title>
</head>

<body>
      <div>
            <p>ID : <?= $user['id'] ?></p>
            <p>Prénom : <?= $user['firstname'] ?></p>
            <p>ID : <?= $user['lastname'] ?></p>
            <p>ID : <?= $user['email'] ?></p>
      </div>
</body>

</html> 