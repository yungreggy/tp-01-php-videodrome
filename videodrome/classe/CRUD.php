<?php

class CRUD extends PDO
{
    public function __construct()
    {
        parent::__construct('mysql:host=localhost; dbname=videodrome; port=3306; charset=utf8', 'root', '');
    }

  public function __destruct()
  {
   
  }


    /**
     *
     * @param string $table 
     * @param array $data A
     * @return bool 
     */
    public function insert($table, $data)
    {
        try {

            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $stmt = $this->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function delete($table, $id)
    {
        try {
            $sql = "DELETE FROM $table WHERE id = :id";
            $stmt = $this->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getCode();
        }
    }

    public function update($table, $data, $where)
    {
        try {
            $fields = array_keys($data);
            $sql = "UPDATE $table SET ";

            foreach ($fields as $field) {
                $sql .= "$field = :$field, ";
            }
            $sql = rtrim($sql, ', ');

            $whereFields = array_keys($where);
            $sql .= " WHERE ";
            foreach ($whereFields as $field) {
                $sql .= "$field = :$field AND ";
            }
            $sql = rtrim($sql, ' AND ');

            $stmt = $this->prepare($sql);

            // Bind values
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            foreach ($where as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }


    public function select($table, $fields = '*')
    {
        try {
            $sql = "SELECT $fields FROM $table";
            $stmt = $this->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function selectById($table, $field, $value, $additionalTables = [])
    {
        try {
            $sql = "SELECT * FROM $table";

            // Handle additional tables to join on
            foreach ($additionalTables as $additionalTable => $onCondition) {
                $sql .= " JOIN $additionalTable ON $onCondition";
            }

            $sql .= " WHERE $table.$field = :value LIMIT 1";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(':value', $value);
            $stmt->execute();

            // Fetch the result into an associative array
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }


    public function insertIfNotExist($table, $fields, $values)
    {
        try {
            // Vérifier si l'enregistrement existe déjà
            $checkSql = "SELECT id FROM $table WHERE ";
            foreach ($fields as $field) {
                $checkSql .= "$field = ? AND ";
            }
            $checkSql = rtrim($checkSql, ' AND ');
            $stmt = $this->prepare($checkSql);
            $stmt->execute($values);
            $existingId = $stmt->fetchColumn();

            if ($existingId) {
                return $existingId;
            }

            // Insérer le nouvel enregistrement
            $columns = implode(", ", $fields);
            $placeholders = implode(", ", array_fill(0, count($fields), "?"));
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $stmt = $this->prepare($sql);
            $stmt->execute($values);

            return $this->lastInsertId();

        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function selectBy($table, $column, $value)
    {
        $sql = "SELECT * FROM $table WHERE $column = :value";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($keyword)
    {
        try {
            $sql = "SELECT * FROM films WHERE titre LIKE :keyword";
            $stmt = $this->prepare($sql);
            $stmt->bindValue(':keyword', '%' . $keyword . '%');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }
    public function selectByJoin($table1, $table2, $key1, $key2, $whereField, $whereValue)
    {
        $sql = "SELECT $table1.* FROM $table1
                JOIN $table2 ON $table1.$key1 = $table2.$key2
                WHERE $table2.$whereField = :whereValue";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':whereValue', $whereValue);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>