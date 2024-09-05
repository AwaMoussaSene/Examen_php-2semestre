<?php
namespace Bank\Models;
use Bank\Core\Model\Model;
class CategorieModel extends Model
{
    public function findAllCategorie(){
        $sql = "SELECT * FROM categorie";
        return parent::query($sql);
    }
    public function getCategorie(){
        $sql = "SELECT * FROM categorie WHERE libelle IN ('nouveau', 'solvable')";
        return parent::query($sql);
    }
    public function findCategorieByLibelle(string $libelle)
{
    $sql = "SELECT * FROM categorie WHERE libelle like '$libelle' ";
    return parent::query($sql);
}
}