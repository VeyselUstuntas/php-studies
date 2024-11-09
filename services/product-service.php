<?php
class ProductService
{


    private Database $database;

    public function __construct(protected QueryBuilder $queryBuilder)
    {
        $this->database = new Database();
    }

    public function getAllProducts(): array
    {
        /**
         * @var Product[] $productList
         * 
         */
        $productList = [];

        try {
            $connection = $this->database->connection;
            $query = $this->queryBuilder->select()->columns(["*"])->tableName("product")->getQuery();
            // var_dump($query);
            $stmt = $connection->prepare($query);
            // $stmt = $connection->prepare("SELECT * FROM product");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productList[] = new Product($row["id"], $row["name"], $row["price"]);
            }
            return $productList;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
