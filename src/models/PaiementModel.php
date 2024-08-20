<?php
namespace Bank\Models;

use Bank\Core\Model\Model;


class PaiementModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findByIdDette(string $iddet)
    {
        $sql = "SELECT 
    d.iddet,
    c.prenom,
    c.nom,
    d.montant,
    c.adresse,
    b.nom AS boutiquier_nom,
    b.prenom AS boutiquier_prenom,
    IFNULL(SUM(p.montantpay), 0) AS verse,
    d.montant - IFNULL(SUM(p.montantpay), 0) AS restant
FROM 
    dette d
JOIN 
    client c ON c.idclient = d.idclient
JOIN 
    boutiquier b ON b.idb = d.idb
LEFT JOIN 
    paiement p ON p.iddet = d.iddet
WHERE 
    d.iddet = '$iddet'
GROUP BY 
    d.iddet, c.prenom, c.nom, d.montant, c.adresse,b.nom, b.prenom";
        return parent::query($sql);

    }
    public function findByIdDetteArticle(string $iddet)
    {
        $sql = "SELECT 
                a.libelle,
                da.quantite,
                a.prixunitaire,
                (da.quantite * a.prixunitaire) AS montant_article
                FROM 
                    dettearticle da
                JOIN 
                    article a ON a.ida = da.ida
                WHERE 
                    da.iddet = '$iddet'";
        return parent::query($sql);

    }
    public function findByIdDettePaiement(string $iddet)
    {
        $sql = "SELECT 
            p.idp,
            p.datep,
            p.reference,
            p.montantpay
            FROM 
                paiement p
            WHERE 
                p.iddet = '$iddet';";
        return parent::query($sql);

    }
    public function addPaiement(array $datas):int{
        $sql="INSERT INTO `paiement`(datep,montantpay,reference,iddet) VALUES(:datep,:montantpay,:reference,:iddet)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($datas);
        return $this->pdo->lastInsertId();
    }
    public function genererNumeroPAY()
    {
        $n = mt_rand(0, 9999999999);
        return 'PAY' . str_pad($n, 10, '0', STR_PAD_LEFT);
    }
}