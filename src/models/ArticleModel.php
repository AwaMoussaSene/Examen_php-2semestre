<?php
namespace Bank\Models;
use Bank\Core\Model\Model;


class ArticleModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll(string $ref){
        $sql="SELECT * FROM `article`WHERE reference='$ref'";
        return parent::query($sql);

    }

    public function sommeStockArticle(){
        $sql="SELECT sum(qtestock) as stock_total FROM `article`";
        return parent::query($sql);
    }

    public function sommeStockVendu(){
        $sql="SELECT sum(quantite) as stock_vendu FROM `dettearticle`";
        return parent::query($sql);
    }
   
}