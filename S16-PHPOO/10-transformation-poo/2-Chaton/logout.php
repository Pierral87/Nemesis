<?php

use ProjetTransfo\Classes\SessionManager;

require_once "vendor/autoload.php";

SessionManager::start();
SessionManager::remove('user_id');
SessionManager::remove('username');

header("Location: index.php");
exit;
