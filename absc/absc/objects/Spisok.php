<?php

class Spisok
{
    // подключение к базе данных и имя таблицы
    private $conn;
    private $table_name = "classes";

    // свойства объекта
    public $id;
    public $name;
    public $bebra;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // данный метод используется в раскрывающемся списке
    function read()
    {
        // запрос MySQL: выбираем столбцы в таблице «categories»
        $query = 
                    "SELECT
                    Cld, CLevel,Cletter
                FROM
                " . $this->table_name . "
                ORDER BY
                    CLevel,Cletter";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    function readName()
    {
        // запрос MySQL
        $query = "SELECT CLevel,Cletter FROM " . $this->table_name . " WHERE Cld = ? limit 0,1";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->name = $row["CLevel"];
         $this->bebra = $row["Cletter"];
    }

}

?>