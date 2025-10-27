<?php
// index.php

session_start();
// session_destroy();


$_SESSION["users"] =
      [
            [
                  "id" => "1",
                  "firstname" => "Sophie",
                  "lastname" => "Tesseidre",
                  "email" => "sophie@gmail.com"
            ],
            [
                  "id" => "2",
                  "firstname" => "Martin",
                  "lastname" => "Rouault",
                  "email" => "martin@gmail.com"
            ]
      ];

var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Users</title>
</head>

<body>
      <table>
            <thead>
                  <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">LastName</th>
                        <th scope="col">Email</th>
                  </tr>
            </thead>
            <tbody>
                  <?php
                  foreach ($_SESSION["users"] as $user) {
                        echo "
                              <tr>
                                    <th scope='row'>{$user['id']}</th>
                                    <td>{$user['firstname']}</td>
                                    <td>{$user['lastname']}</td>
                                    <td>{$user['email']}</td> 
                                    <td><a href='exo2MartinUser.php?id={$user['id']}'>Voir</a></td>
                                    <td><a href=''>Modifier</a></td> 
                                    <td><a href=''>Supprimer</a></td> 
                              </tr>
                              ";
                  }

                  ?>
            </tbody>
      </table>
</body>

</html>