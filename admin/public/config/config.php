<?php

session_start();

abstract class Config
{
    private string $user;
    private string $pass;
    private string $db;
    private string $tbl;
    protected $pdo;

    public function __construct()
    {
            $this->connect();
    }

    public function connect()
    {
        try {
                $this->user = 'phpmyadmin';
                $this->pass = 'alikaram98';
                $this->db = 'cms';
                $this->pdo = new PDO("mysql:host=localhost;dbname={$this->db};charset=utf8", $this->user, $this->pass);
        } catch (PDOException $e) {
                exit('Error : ' . $e->getMessage());
        }
    }
    
    public function setTbl($tbl)
    {
        $this->tbl = $tbl;
    }
    
    public function selectData($field) 
    {
        if (is_array($field)) {
            $fields = implode(',', $field);
            $sql = $this->pdo->prepare("select {$fields} from {$this->tbl}");
        } else {
            $sql = $this->pdo->prepare("select {$field} from {$this->tbl}");
        }
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_OBJ);
        return $row;
    }
    
    public function deleteData($id)
    {
        $sql = $this->pdo->prepare("delete from {$this->tbl} where id=:id");
        $sql->bindParam(":id", $id, PDO::PARAM_INT);
        $sql->execute();
    }
    
    public function insertData($data)
    {
        if (is_array($data)) {
            $field = array_keys($data);
            $fields = implode(',', $field);
            $vals = ':' . implode(',:', $field);
            $sql = $this->pdo->prepare("insert into {$this->tbl} ({$fields}) values ({$vals})");
            foreach ($data as $key => $value) {
                $type = gettype($value);
                switch ($type) {
                    case 'string':
                        $sql->bindParam(":$key", $data[$key]);
                        break;
                    case 'integer':
                        $sql->bindParam(":$key", $data[$key], PDO::PARAM_INT);
                        break;
                    case 'boolean':
                        $sql->bindParam(":$key", $data[$key], PDO::PARAM_BOOL);
                        break;
                }
            }
            $sql->execute();
        }
    }
    
    public function showData($field, $value)
    {
        $sql = $this->pdo->prepare("select * from {$this->tbl} where $field=:val");
        $sql->bindParam(":val", $value, PDO::PARAM_INT);
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    
    public function updateData($data, $id)
    {
        if (is_array($data)) {
            $field = array_keys($data);
            foreach ($field as $value) {
                $arr[] = $value . '=:' . $value;
            }
            $str = implode(',', $arr);
            $sql = $this->pdo->prepare("update {$this->tbl} set {$str} where id=:id");
            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            foreach ($data as $key => $value) {
                $type = gettype($value);
                switch ($type) {
                    case 'string':
                        $sql->bindParam(":$key", $data[$key]);
                        break;
                    case 'integer':
                        $sql->bindParam(":$key", $data[$key], PDO::PARAM_INT);
                        break;
                    default:
                        $sql->bindParam(":$key", $data[$key], PDO::PARAM_INT);
                        break;
                }
            }
            $sql->execute();
        }
    }
    
    public function chooseData($field, $sort)
    {
        if (is_array($field)){
            $total = count($field);
            switch (true) {
                case ($total == 2) and ($sort == true):
                    $sql = $this->pdo->prepare("select * from {$this->tbl} where $field[0]=:val1 and $field[1]=:val2 order by sort asc");
                    break;
                case ($total == 2) and ($sort == false):
                    $sql = $this->pdo->prepare("select * from {$this->tbl} where $field[0]=:val1 and $field[1]=:val2");
                    break;
                case ($total == 1) and ($sort == true):
                    $sql = $this->pdo->prepare("select * from {$this->tbl} where $field[0]=:val where order by sort asc");
                    break;
                case ($total == 1) and ($sort == false):
                    $sql = $this->pdo->prepare("select * from {$this->tbl} where $field[0]=:val");
                    break;
            }
            return $sql;
        }
    }
    
    public function likeData($field, $value, $sort)
    {
        $sql = $this->pdo->prepare("select * from {$this->tbl} $field='%$value%'");
        if ($sort == 'true') {
            $sql = $this->pdo->prepare("select * from {$this->tbl} $field='%$value%' order by sort");
        }
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_OJB);
        return $row;
    }
    
    public function exteraSql($str)
    {
        $sql = $this->pdo->prepare("{$str}");
        return $sql;
    }
}


?>