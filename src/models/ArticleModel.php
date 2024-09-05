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
    public function findAllArticle(int $page = 1, int $itemsPerPage = 10){
        $sql="SELECT * FROM `article`";
        return parent::paginateQuery($sql,[], $page, $itemsPerPage);

    }

    public function sommeStockArticle(){
        $sql="SELECT sum(qtestock) as stock_total FROM `article`";
        return parent::query($sql);
    }

    public function sommeStockVendu(){
        $sql="SELECT sum(quantite) as stock_vendu FROM `dettearticle`";
        return parent::query($sql);
    }
    public function addArticle(array $datas):int{
        $sql="INSERT INTO `article`(libelle,prixunitaire,qtestock,reference) 
        VALUES(:libelle,:prixunitaire,:qtestock,:reference)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($datas);
        return $this->pdo->lastInsertId();
    }
    public function genererReferenceArticle()
    {
        $n = mt_rand(0, 9999999999);
        return 'ART' . str_pad($n, 10, '0', STR_PAD_LEFT);
    }
}