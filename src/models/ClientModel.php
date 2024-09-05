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
        $sql = "SELECT * FROM `client`c join `categorie`ca on c.idcat=ca.idcat WHERE telephone='$tel'";
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
public function findDetteByIdClient(int $idclient, int $page = 1, int $itemsPerPage = 10) {
    $offset = ($page - 1) * $itemsPerPage;
    
    $sql = "SELECT d.iddet, d.dated, d.montant, d.numero, d.idclient, d.idetat, d.idb,c.montantseuil,
                   c.nom, c.prenom, c.telephone, c.adresse, c.email, et.libelle,c.photo,ct.libelle as libelle_categorie,
                   COALESCE(SUM(p.montantpay), 0) AS verse,
                   (d.montant - COALESCE(SUM(p.montantpay), 0)) AS restant
            FROM dette d
            JOIN client c ON d.idclient = c.idclient
            JOIN etat et ON d.idetat = et.idetat
            JOIN categorie ct ON ct.idcat = c.idcat
            LEFT JOIN paiement p ON d.iddet = p.iddet
            WHERE d.idclient = $idclient
            GROUP BY d.iddet, d.dated, d.montant, d.numero, d.idclient, d.idetat, d.idb,
                     c.nom, c.prenom, c.telephone, c.adresse, c.email, et.libelle,ct.libelle,c.montantseuil,c.photo
            LIMIT $itemsPerPage OFFSET $offset";
    
    return parent::query($sql);
}
// public function findDetteByIdClient(int $idclient, int $page = 1, int $itemsPerPage = 10) {
//     $offset = ($page - 1) * $itemsPerPage;
    
//     $sql = "SELECT d.iddet, d.dated, d.montant, d.numero, d.idclient, d.idetat, d.idb,
//                c.nom, c.prenom, c.telephone, c.adresse, c.email, et.libelle, c.photo, ct.libelle AS libelle_categorie,
//                COALESCE(SUM(p.montantpay), 0) AS verse,
//                (d.montant - COALESCE(SUM(p.montantpay), 0)) AS restant,
//                (c.montantseuil + (d.montant - COALESCE(SUM(p.montantpay), 0))) AS montantseuil
//         FROM dette d
//         JOIN client c ON d.idclient = c.idclient
//         JOIN etat et ON d.idetat = et.idetat
//         JOIN categorie ct ON ct.idcat = c.idcat
//         LEFT JOIN paiement p ON d.iddet = p.iddet
//         WHERE d.idclient = $idclient
//         GROUP BY d.iddet, d.dated, d.montant, d.numero, d.idclient, d.idetat, d.idb,
//                  c.nom, c.prenom, c.telephone, c.adresse, c.email, et.libelle, ct.libelle, c.montantseuil, c.photo
//         LIMIT $itemsPerPage OFFSET $offset";
    
//     return parent::query($sql);
// }

public function sommeDetteByClient($idclient){
    $sql = "SELECT c.nom, c.prenom, SUM(d.montant) AS montant_total
        FROM dette d
        JOIN client c ON d.idclient = c.idclient
        WHERE d.idclient = $idclient
        GROUP BY c.idclient";
    return parent::query($sql);
}
// public function sommeCompteByClient($idclient){
//     $sql = "SELECT c.prenom,d.datedepot, SUM(d.montant) AS montant_total
//         FROM depot d
//         JOIN client c ON d.idclient = c.idclient
//         WHERE d.idclient = $idclient
//         GROUP BY c.idclient";
//     return parent::query($sql);
// }
public function sommeCompteByClient($idclient) {
    $sql = "SELECT c.prenom, d.datedepot, 
                   SUM(p.montantpay - de.montant) AS montant_total
            FROM depot d
            JOIN client c ON d.idclient = c.idclient
            JOIN dette de ON de.idclient = c.idclient
            LEFT JOIN paiement p ON de.iddet = p.iddet
            WHERE d.idclient = $idclient
            GROUP BY c.idclient";
    
    return parent::query($sql);
}

public function countDetteByIdClient(int $idclient) {
    $sql = "SELECT COUNT(d.iddet) AS total
            FROM dette d
            WHERE d.idclient = $idclient";
    $result = parent::query($sql);
    return $result[0]->total;
}
// public function getAllClient(string $tel = "", string $categorie = "", int $page = 1, int $itemsPerPage = 10)
// {
//     $sql = "SELECT c.idclient, c.nom, c.prenom, c.telephone, c.adresse, c.email, 
//                    ct.libelle, c.montantseuil,d.iddet,
//                    COALESCE(SUM(d.montant), 0) AS montant_total 
//             FROM `client` c 
//             LEFT JOIN `categorie` ct ON c.idcat = ct.idcat 
//             LEFT JOIN `dette` d ON c.idclient = d.idclient 
//             WHERE c.telephone LIKE :tel";

//     $params = [':tel' => "%$tel%"];

//     if ($categorie) {
//         $sql .= " AND ct.libelle LIKE :categorie";
//         $params[':categorie'] = "%$categorie%";
//     }

//     $sql .= " GROUP BY c.idclient, c.nom, c.prenom, c.telephone, c.adresse, c.email, ct.libelle,c.montantseuil,d.iddet";
//     return $this->paginateQuery($sql, $params, $page, $itemsPerPage);
// }
public function getAllClient(string $tel = "", string $categorie = "", int $page = 1, int $itemsPerPage = 10)
{
    $sql = "SELECT c.idclient, c.nom, c.prenom, c.telephone, c.adresse, c.email, 
                   ct.libelle, c.montantseuil,
                   COALESCE(SUM(d.montant), 0) AS montant_total 
            FROM `client` c 
            LEFT JOIN `categorie` ct ON c.idcat = ct.idcat 
            LEFT JOIN `dette` d ON c.idclient = d.idclient 
            WHERE c.telephone LIKE :tel";

    $params = [':tel' => "%$tel%"];

    if ($categorie) {
        $sql .= " AND ct.libelle LIKE :categorie";
        $params[':categorie'] = "%$categorie%";
    }

    $sql .= " GROUP BY c.idclient, c.nom, c.prenom, c.telephone, c.adresse, c.email, ct.libelle, c.montantseuil";
    return $this->paginateQuery($sql, $params, $page, $itemsPerPage);
}

public function addClient(array $datas):int{
    $sql="INSERT INTO `client`(nom,prenom,telephone,adresse,email,montantseuil,idb,idcat,photo,pwd) 
    VALUES(:nom,:prenom,:telephone,:adresse,:email,:montantseuil,:idb,:idcat,:photo,:pwd)";
    $statement = $this->pdo->prepare($sql);
    $statement->execute($datas);
    return $this->pdo->lastInsertId();
}
public function findByTel(string $tel){
    $sql="SELECT * from `client` where telephone like '$tel' ";
    return parent::query($sql);
}
public function updateSeuilClient(int $seuil, int $idclient)
{
    $sql = "UPDATE client SET montantseuil = $seuil WHERE idclient = $idclient";
    return parent::query($sql);
}
public function updateCategorieClient(int $idclient, int $idcat)
{
    $sql = "UPDATE client SET idcat = $idcat WHERE idclient = $idclient";
    return parent::query($sql);
}

}