<?php 
namespace MonBlog\Model; 

class ArticleModel {
    protected $titre;

    public function __construct($titre) {
        $this->titre = $titre;
    }

    public function getTitre() {
        return $this->titre;
    }
}