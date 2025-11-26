<?php

use MonBlog\Controller\ArticleController;

require "Controller/ArticleController.php";

$controller = new ArticleController;
$controller->afficherArticle();