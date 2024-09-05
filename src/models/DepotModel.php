<?php
namespace Bank\Models;
use Bank\Core\Model\Model;

class DepotModel extends Model{
    public function findAllDepot($idclient){
        $sql = "SELECT * FROM depot d join client c on d.idclient=c.idclient where c.idclient=$idclient";
        return parent::query($sql);
    }
    // public function findAllDepot($idclient) {
    //     $sql = "SELECT d.*, 
    //                    c.nom, c.prenom, c.telephone, c.adresse, c.email, c.montantseuil,
    //                    (de.montant - COALESCE(SUM(p.montantpay), 0) + c.montantseuil) AS montant_depot
    //             FROM depot d
    //             JOIN client c ON d.idclient = c.idclient
    //             JOIN dette de ON de.idclient = c.idclient
    //             LEFT JOIN paiement p ON de.iddet = p.iddet
    //             WHERE c.idclient = $idclient
    //             GROUP BY d.iddepot, c.nom, c.prenom, c.telephone, c.adresse, c.email, c.montantseuil, de.montant";
        
    //     return parent::query($sql);
    // }
    public function findAll(){
        $sql = "SELECT 
                    d.*,
                    c.nom,
                    c.prenom, 
                    c.telephone,
                    c.adresse,
                    c.email
                FROM depot d 
                JOIN client c ON d.idclient = c.idclient";
        
        return parent::query($sql);

    }
    public function addDepot(array $datas):int{
        $sql="INSERT INTO `depot`(datedepot,montant,idclient) 
        VALUES(:datedepot,:montant,:idclient)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($datas);
        return $this->pdo->lastInsertId();
    }
}