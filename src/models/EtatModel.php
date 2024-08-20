<?php
namespace Bank\Models;
use Bank\Core\Model\Model;

class EtatModel extends Model
{
    public function __construct() {
        parent::__construct();
      }

    public function findAll(){
        $sql = "SELECT * FROM `etat`";
        return parent::query( $sql);
    }
}