<?php
class QueryBuilder
{

    private $query;
    private $isInsert;
    private $isSelect;

    public function __construct()
    {
        $this->query = "";
        $this->isInsert = false;
        $this->isSelect = false;
    }

    public function select()
    {
        $this->isSelect = true;
        $this->query .= "SELECT ";
        return $this;
    }

    public function insert()
    {
        $this->isInsert = true;
        $this->query .= "INSERT INTO";
        return $this;
    }


    public function tableName(string $tableName)
    {
        if ($this->isSelect) {
            $this->query .= "FROM " . $tableName . " ";
            return $this;
        } else {
            $this->query .= " " . $tableName;
        }
        return $this;
    }

    /*
        SELECT * FROM <TABLO> WHERE ID = ... AND/OR NAME=...
        INSERT INTO <TABLO>(columns) VALUES(.....) 
    */


    /**
     * @param string[] $params
     */
    public function columns(array $params)
    {
        $base = "";

        if ($this->isSelect) {

            $paramSize = count($params);

            foreach ($params as $index => $param) {
                if (($paramSize - 1) == $index) {
                    $base .= $param . " ";
                } else {
                    $base .= $param . ", ";
                }
            }
            $this->query .= $base;
            return $this;
        } else {
            $base .= "(";
            $paramSize = count($params);
            foreach ($params as $index => $param) {
                if ($index == ($paramSize - 1)) {
                    $base .= $param . ") ";
                } elseif ($index < $paramSize) {
                    $base .= $param . ", ";
                }
            }
            $base .= "VALUES(";
            foreach ($params as $index => $param) {
                if ($index == ($paramSize - 1)) {
                    $base .= ":".$param . ")";
                } elseif ($index < $paramSize) {
                    $base .= ":".$param . ", ";
                }
            }
            $this->query .= $base;
            return $this;
        }
    }


    /**
     * @param string[] $params
     * @param string|null $operator
     */
    public function where(array $params, ?string $operator = null)
    {
        $base = "WHERE ";

        $paramSize = count($params);
        if ($paramSize > 1 && $operator == null) {
            return $this;
        }
        foreach ($params as $index => $param) {
            if (($paramSize - 1) == $index) {
                $base .= $param . " = :" . $param;
            } else {
                $base .= $param . " = :" . $param . " " . $operator . " ";
            }
        }
        $this->query .= $base;

        return $this;
    }


    public function getQuery(): string
    {
        $chainedQuery = $this->query;
        $this->isSelect = false;
        $this->isInsert = false;
        $this->query = "";
        return $chainedQuery;
    }
}
