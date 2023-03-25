<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>
<body>

<?php

$page_title = "Вывод товаров";
$page = isset($_GET["page"]) ? $_GET["page"] : 1;

// устанавливаем ограничение количества записей на странице
$records_per_page = 5;

// подсчитываем лимит запроса
$from_record_num = ($records_per_page * $page) - $records_per_page;
include_once "database.php";
include_once "objects/product.php";
include_once "objects/Spisok.php";

// создаём экземпляры классов БД и объектов
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Spisok($db);

// запрос товаров
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();
$stmtt = $product->readAlll($from_record_num, $records_per_page);
$numm = $stmtt->rowCount();
$stmttt = $product->readAllll($from_record_num, $records_per_page);
$nummm = $stmttt->rowCount();
?>

<?php
// отображаем товары, если они есть
if ($num > 0) {

    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
        
        echo " <th>Фамилия</th>";
        echo " <th>Имя</th>";
        echo " <th>Отчество</th>";
        echo " <th>Дата рождения</th>";	
        echo "</tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
                $ID = $row['SId'];
                $Last = $row['SLastName'];
                $Name = $row['SFirstName'];
                $Mid = $row['SMidName'];
                $Birth = $row['SBirthDate'];
              
                echo '<tr>
                        
                        <td>' . $Last . '</td>
                        <td>' . $Name . '...</td>
                        <td>' . $Mid . '</td>
                        <td>' . $Birth . '</td>
                       
                    </tr>';
        }

    echo "</table>";

    // здесь будет пагинация
}

// сообщим пользователю, что товаров нет
else {
    echo "<div class='alert alert-info'>Товары не найдены.</div>";
}
if ($numm > 0) {

    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
        
        echo " <th>Количество учеников</th>";
        	
        echo "</tr>";
        while ($row = $stmtt->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
                
                $Last = $row['count']
                ??null;

          
              
                echo '<tr>
                        
                        <td>' . $Last . '</td>
                       
                       
                    </tr>';
        }

    echo "</table>";

    // здесь будет пагинация
}
if ($nummm > 0) {

    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
        
        echo " <th>Фамилия</th>";
        echo " <th>Имя</th>";
        echo " <th>Отчество</th>";
        echo " <th>Дата рождения</th>	";	
        echo "</tr>";
        while ($row = $stmttt->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
            $ID = $row['SId']
            ??null;
            $Last = $row['SLastName'];
            $Name = $row['SFirstName'];
            $Mid = $row['SMidName'];
            $Birth = $row['SBirthDate'];
            
            echo '<tr>   
            <td>' . $Last . '</td>
            <td>' . $Name . '...</td>
            <td>' . $Mid . '</td>
            <td>' . $Birth . '</td>
           
        </tr>';
        }

    echo "</table>";

    // здесь будет пагинация
}
?>
</body>
</html>