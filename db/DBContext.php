<?php

namespace Myapp;

class DBContext
{
    private $tableName = null;

    public function __construct($tableName)
    {
        if ($this->isTableExists($tableName)) {
            $this->tableName = $tableName;
        } else throw new \Exception("error table selected");

    }

    private function isTableExists($tableName)
    {
        $result = $this->executeQuery("SHOW TABLES");
        foreach ($result as $key => $value) {
            if (strcasecmp($tableName, $value["Tables_in_" . DB_NAME]) == 0) {
                return true;
            }
        }
        return false;
    }

    protected function executeQuery($query, $mode = "SELECT")
    {
        $conn = DBConnector::openConnection();
        $result = mysqli_query($conn, $query);

        switch ($mode) {
            case "SELECT":
            {
                $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
                break;
            }
            default:
            {
                $result = mysqli_affected_rows($conn);
            }
        }
        DBConnector::closeConnection();
        return $result;
    }

    public function getOneRow($Id)
    {
        $query = "SELECT * FROM $this->tableName WHERE Id = $Id";
        $result = $this->executeQuery($query);
        return count($result) == 1 ? $result[0] : null;
    }

    public function getId($filter = [])
    {
        if (count($filter) > 0) {
            $query = "SELECT Id FROM $this->tableName WHERE ";
            foreach ($filter as $key => $value) {
                if ($value == null) {
                    $query .= "$key IS NULL AND ";
                } else {
                    $query .= "$key = '$value' AND ";
                }
            }
            $query = mb_substr($query, 0, mb_strlen($query) - 4);
            $id = $this->executeQuery($query);
            if (count($id) == 1) {
                return $id[0]['Id'];
            } else {
                return null;
            }
        } else {
            throw new \Exception("filter is empty");
        }
    }

    public function getManyRows($filter = [], $orderName = "Id", $orderMode = "ASC", $offset = 0, $rows = 100)
    {
        $query = "SELECT * FROM $this->tableName";
        if (count($filter) > 0) {
            $query .= " WHERE ";
            foreach ($filter as $key => $value) {
                if ($value == null) {
                    $query .= "$key IS NULL AND ";
                } else {
                    $query .= "$key = '$value' AND ";
                }
            }
            $query = mb_substr($query, 0, mb_strlen($query) - 4);
        }
        $query .= " ORDER BY $orderName $orderMode LIMIT $offset, $rows";
        return $this->executeQuery($query);
    }

    public function addOneRow($data = [])
    {
        $query = "INSERT INTO $this->tableName (";
        $values = "";
        foreach ($data as $key => $value) {
            $query .= "$key, ";
            $values .= "'$value', ";
        }
        $query = mb_substr($query, 0, mb_strlen($query) - 2);
        $query .= ") VALUES(";
        $values = mb_substr($values, 0, mb_strlen($values) - 2);
        $query .= $values . ")";

        return $this->executeQuery($query, "INSERT");
    }

    public function updateOneRow($id, $data = [])
    {
        if (count($data) > 0) {
            $query = "UPDATE $this->tableName SET ";
            foreach ($data as $key => $value) {
                if ($value == null) {
                    $query .= "`$key` = NULL, ";
                } else {
                    $query .= "`$key` = '$value', ";
                }
            }
            $query = mb_substr($query, 0, mb_strlen($query) - 2);
            $query .= " WHERE Id = $id";

            return $this->executeQuery($query, "UPDATE");
        } else throw new \Exception("new data is empty");
    }

    public function deleteOneRow($id)
    {
        $query = "DELETE FROM $this->tableName WHERE Id = $id";
        return $this->executeQuery($query, "DELETE");
    }

    public function deleteManyRows($filter = [])
    {
        $query = "DELETE FROM $this->tableName WHERE ";
        foreach ($filter as $key => $value) {
            if ($value == null) {
                $query .= "$key IS NULL AND ";
            } else {
                $query .= "$key = '$value' AND ";
            }
        }
        $query = mb_substr($query, 0, mb_strlen($query) - 4);
        return $this->executeQuery($query, "DELETE");
    }

}