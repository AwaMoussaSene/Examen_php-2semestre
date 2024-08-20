<?php
namespace Bank\Models;

use Bank\Core\Model\Model;

class ClientModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll(string $tel)
    {
        $sql = "SELECT * FROM `client`WHERE telephone='$tel'";
        return parent::query($sql);

    }
    public function findAllClient(string $tel = "", int $page = 1, int $itemsPerPage = 10)
    {
        $sql = "SELECT c.idclient, c.nom, c.prenom, c.telephone, c.adresse, c.email, 
                       ct.libelle, d.iddet, d.dated, d.montant, d.numero, d.idetat, d.idb, 
                       COALESCE(SUM(d.montant), 0) AS montant_total 
                FROM `client` c 
                LEFT JOIN `categorie` ct ON c.idcat = ct.idcat 
                LEFT JOIN `dette` d ON c.idclient = d.idclient 
                WHERE c.telephone LIKE :tel 
                GROUP BY c.idclient, c.nom, c.prenom, c.telephone, c.adresse, c.email, ct.libelle";

        $params = [':tel' => "%$tel%"];

        return $this->paginateQuery($sql, $params, $page, $itemsPerPage);
    }

    public function countClient()
    {
        $sql = "SELECT COUNT(idclient) as nombre_client FROM `client`";
        return parent::query($sql);
    }
// public function findDetteByIdClient(int $idclient, int $page = 1, int $itemsPerPage = 10) {
//     $sql = "SELECT d.iddet, d.dated, d.montant, d.numero, d.idclient, d.idetat, d.idb,
//                    c.nom, c.prenom, c.telephone, c.adresse, c.email, et.libelle,
//                    COALESCE(SUM(p.montantpay), 0) AS verse,
//                    (d.montant - COALESCE(SUM(p.montantpay), 0)) AS restant
//             FROM dette d
//             JOIN client c ON d.idclient = c.idclient
//             JOIN etat et ON d.idetat = et.idetat
//             LEFT JOIN paiement p ON d.iddet = p.iddet
//             WHERE d.idclient = $idclient
//             GROUP BY d.iddet, d.dated, d.montant, d.numero, d.idclient, d.idetat, d.idb,
//                      c.nom, c.prenom, c.telephone, c.adresse, c.email, et.libelle";

//     return parent::query($sql);
// }
public function findDetteByIdClient(int $idclient, int $page = 1, int $itemsPerPage = 10) {
    $offset = ($page - 1) * $itemsPerPage;
    
    $sql = "SELECT d.iddet, d.dated, d.montant, d.numero, d.idclient, d.idetat, d.idb,
                   c.nom, c.prenom, c.telephone, c.adresse, c.email, et.libelle,ct.libelle as libelle_categorie,
                   COALESCE(SUM(p.montantpay), 0) AS verse,
                   (d.montant - COALESCE(SUM(p.montantpay), 0)) AS restant
            FROM dette d
            JOIN client c ON d.idclient = c.idclient
            JOIN etat et ON d.idetat = et.idetat
            JOIN categorie ct ON ct.idcat = c.idcat
            LEFT JOIN paiement p ON d.iddet = p.iddet
            WHERE d.idclient = $idclient
            GROUP BY d.iddet, d.dated, d.montant, d.numero, d.idclient, d.idetat, d.idb,
                     c.nom, c.prenom, c.telephone, c.adresse, c.email, et.libelle,ct.libelle
            LIMIT $itemsPerPage OFFSET $offset";
    
    return parent::query($sql);
}

public function countDetteByIdClient(int $idclient) {
    $sql = "SELECT COUNT(d.iddet) AS total
            FROM dette d
            WHERE d.idclient = $idclient";
    
    $result = parent::query($sql);
    return $result[0]->total;
}

}