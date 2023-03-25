<?php

class Product
{
    // подключение к базе данных и имя таблицы
    private $conn;
    private $table_name = "students";

    // свойства объекта
    public $id;
    public $SFirstName;
    public $SLastName;
    public $SMidName;
    public $SBirthDate;
    public $CId;
   

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // метод создания товара
    function create()
    {
        // запрос MySQL для вставки записей в таблицу БД «products»
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                SLastName=:SLastName, SFirstName=:SFirstName, SMidName=:SMidName, SBirthDate=:SBirthDate, CId=:CId";

        $stmt = $this->conn->prepare($query);

        // опубликованные значения
        $this->SLastName = htmlspecialchars(strip_tags($this->SLastName));
        $this->SFirstName = htmlspecialchars(strip_tags($this->SFirstName));
        $this->SMidName = htmlspecialchars(strip_tags($this->SMidName));
        $this->SBirthDate = htmlspecialchars(strip_tags($this->SBirthDate));
        $this->CId = htmlspecialchars(strip_tags($this->CId));
    
        // получаем время создания записи
       // $this->timestamp = date("Y-m-d H:i:s");

        // привязываем значения
        $stmt->bindParam(":SLastName", $this->SLastName);
        $stmt->bindParam(":SFirstName", $this->SFirstName);
        $stmt->bindParam(":SMidName", $this->SMidName);
        $stmt->bindParam(":SBirthDate", $this->SBirthDate);
        $stmt->bindParam(":CId", $this->CId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function readAll($from_record_num, $records_per_page)
{
    // запрос MySQL

    $query = sprintf("SELECT * FROM " . $this->table_name . " where `SBirthDate` = (select max(`SBirthDate`) from `students`);");


    // $query = "SELECT
    //             id, name, description, price, category_id
    //         FROM
    //             " . $this->table_name . "
    //         ORDER BY
    //             name ASC
    //         LIMIT
    //             {$from_record_num}, {$records_per_page}";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
}
function readAlll($from_record_num, $records_per_page)
{
    // запрос MySQL

    $query = sprintf("SELECT * FROM " . $this->table_name . " where `SBirthDate` = (select max(`SBirthDate`) from `students`);");

    $query = sprintf("SELECT count(students.SId) as count from classes left join students on classes.Cld = students.CId where classes.CLevel = 2 group by classes.CLevel");
    // $query = "SELECT
    //             id, name, description, price, category_id
    //         FROM
    //             " . $this->table_name . "
    //         ORDER BY
    //             name ASC
    //         LIMIT
    //             {$from_record_num}, {$records_per_page}";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
}
function readAllll($from_record_num, $records_per_page)
{
    // запрос MySQL

   
    
    $query = sprintf("SELECT students.SLastName,students.SFirstName,students.SMidName,students.SBirthDate
    from students where SBirthDate LIKE '____-07-__'");
    // $query = "SELECT
    //             id, name, description, price, category_id
    //         FROM
    //             " . $this->table_name . "
    //         ORDER BY
    //             name ASC
    //         LIMIT
    //             {$from_record_num}, {$records_per_page}";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
}
}
?>
