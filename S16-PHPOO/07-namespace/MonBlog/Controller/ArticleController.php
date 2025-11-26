<?php 
namespace MonBlog\Controller;

use MonBlog\Model\ArticleModel;

require "Model\ArticleModel.php";

class ArticleController {

    public function afficherArticle() {
        $article = new ArticleModel("Introduction aux namespaces en PHP");
        echo $article->getTitre();
    }

}