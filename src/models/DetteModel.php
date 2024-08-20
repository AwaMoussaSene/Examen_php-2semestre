<?php
namespace Bank\Models;

use Bank\Core\Model\Model;

class DetteModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'dette';
    }
    
    public function addDette(array $datas):int{
        $sql="INSERT INTO `dette`(dated,montant,numero,idclient,idetat,idb) VALUES(:dated,:montant,:numero,:idclient,:idetat,:idb)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($datas);
        return $this->pdo->lastInsertId();
    }

    public function addArticleDette(array $datas):int{
        $sql="INSERT INTO `dettearticle`(iddet,ida,quantite) VALUES(:iddet,:ida,:quantite)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($datas);
        return $this->pdo->lastInsertId();
    }
    public function findAll(string $etat = "", string $date = "", string $tel = "", int $page = 1, int $itemsPerPage = 10)
{
    $sql = "SELECT 
                d.iddet, d.dated, d.montant, d.numero, d.idclient, d.idetat, d.idb,
                cl.nom, cl.prenom, cl.telephone, cl.adresse, cl.email,
                et.libelle ,
                COALESCE(SUM(p.montantpay), 0) AS verse,
                (d.montant - COALESCE(SUM(p.montantpay), 0)) AS restant
            FROM dette d
            JOIN client cl ON d.idclient = cl.idclient
            JOIN etat et ON d.idetat = et.idetat
            LEFT JOIN paiement p ON d.iddet = p.iddet";
            $condition = [];
            $params = [];

            if ($etat) {
                $condition[] = "et.libelle = :etat";
                $params[':etat'] = $etat;
            }
            if ($date) {
                $condition[] = "d.dated = :date";
                $params[':date'] = $date;
            }
            if ($tel) {
                $condition[] = "cl.telephone LIKE :tel";
                $params[':tel'] = "%$tel%";
            }

            if (!empty($condition)) {
                $sql .= " WHERE " . implode(" AND ", $condition);
            }

            $sql .= " GROUP BY d.iddet
                    HAVING verse <= d.montant";

            $statement = $this->pdo->prepare($sql);

            foreach ($params as $key => $value) {
                $statement->bindValue($key, $value);
            }

            $statement->execute();
            return $this->paginateQuery($sql, $params, $page, $itemsPerPage);
}
            
public function updateStock(int $articleId, int $totalQteCmde)
{
    $qteStock = $this->getQteStock($articleId);
    $newQteStock = $qteStock - $totalQteCmde;
    $sql = "UPDATE article SET qtestock = :qtestock WHERE ida = :ida";
    $statement = $this->pdo->prepare($sql);
    $statement->execute([
        'qtestock' => $newQteStock,
        'ida' => $articleId
    ]);
}

public function getQteStock(int $articleId): int
{
    $sql = "SELECT qtestock FROM article WHERE ida = :ida";
    $statement = $this->pdo->prepare($sql);
    $statement->execute(['ida' => $articleId]);
    $result = $statement->fetch();
    return $result ? (int)$result->qtestock : 0;
}

public function sommeDettes(){
    $sql="SELECT sum(montant) as dette_total FROM `dette`";
    return parent::query($sql);

}
public function sommeDettesDuJour() {
    $sql = "SELECT SUM(montant) AS dette_total 
            FROM `dette` 
            WHERE DATE(dated) = CURDATE()";
    return parent::query($sql);
}

 public function genererNumeroDette()
    {
        $n = mt_rand(0, 9999999999);
        return 'DET' . str_pad($n, 10, '0', STR_PAD_LEFT);
    }
}