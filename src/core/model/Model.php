<?php 
namespace Bank\Core\Model;
class Model{
  protected \PDO|null $pdo=null;
 public  function __construct(){
    if ( $this->pdo==null) {
        $this->pdo= new \PDO('mysql:host=localhost;dbname=bd_gestion_boutique;charset=utf8',"root","");
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_OBJ,);
    }
  
  }

  public function query(string $sql){
     $result=$this->pdo->query($sql);
    return $result->fetchAll();

}

protected function paginateQuery(string $sql, array $params = [], int $page = 1, int $itemsPerPage = 10): array
{
    $page = max(1, $page);
    $offset = ($page - 1) * $itemsPerPage;

    $countSql = "SELECT COUNT(*) FROM ($sql) AS count_query";
    $statement = $this->pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        $statement->bindValue($key, $value);
    }
    $statement->execute();
    $totalItems = $statement->fetchColumn();

    $paginatedSql = "$sql LIMIT :limit OFFSET :offset";
    $statement = $this->pdo->prepare($paginatedSql);
    foreach ($params as $key => $value) {
        $statement->bindValue($key, $value);
    }
    $statement->bindValue(':limit', $itemsPerPage, \PDO::PARAM_INT);
    $statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
    $statement->execute();
    $data = $statement->fetchAll();

    $totalPages = ceil($totalItems / $itemsPerPage);

    return [
        'data' => $data,
        'totalItems' => $totalItems,
        'totalPages' => $totalPages,
        'currentPage' => $page
    ];
}

}