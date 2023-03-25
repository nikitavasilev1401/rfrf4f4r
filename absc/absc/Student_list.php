<html>
<link rel="stylesheet" href="css/style.css">
<?php

// сохраните это в display.php

// отображение ошибок 

error_reporting(E_ALL);

ini_set('display_errors', 1);

// ошибки заканчиваются здесь 

// вызов страницы для подключения к базе данных

require_once('db.php');

?>


<!--Save this as index.php-->

<script src="//code.jquery.com/jquery-1.9.1.js"></script>

<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $("#fetchStudents").click(function() {
            var e = document.getElementById("class_selector");
            var value = e.value;
            console.log(value);
            $.ajax({ //создайте ajax-запрос к файлу display.php

                type: "POST",

                url: "students_functions.php",

                data: {
                    "function": "Get",
                    "id": value
                },

                success: function(response) {

                    $("#responsecontainer").html(response);

                    //alert(response);

                }

            });

        });

    });


    function del(value) {
        console.log(value);
        let isExecuted = confirm("Уверены?");
        if (isExecuted) {
            $.ajax({ //создайте ajax-запрос к файлу display.php

                type: "POST",

                url: "students_functions.php",

                data: {
                    "function": "Del",
                    "id": value
                },

                success: function(response) {

                    document.reload();
                    alert("Удалено");

                    //alert(response);

                }

            });
        }

    }
</script>

<body>
<nav>
                <ul>
                    <li><a href="Report.php">Отчеты</a></li>
                    <li><a href="students.php">Добавление ученика</a></li>
                    <li><a href="Student_list.php">Список учащихся</a></li>
                </ul>
            </nav>

    <h3 align="center">Manage Student Details</h3>
    <p><select size="3" multiple id="class_selector">
            <?php

            $query = " SELECT * FROM classes";

            $result = $conn->query($query);

            echo ("<option disabled>Выберите класс</option>");

            while ($row = $result->fetch_row()) {
                echo ("<option value=" . $row[0] . ">" . $row[2] . "</option>");
            }

            ?>
        </select></p>
    <p><input type="submit" value="Отправить" id="fetchStudents"></p>

    <table border="1" align="center">

        <tr>

            <td> <input type="button" id="display" value="Display All Data" /> </td>

        </tr>

    </table>

    <div id="responsecontainer" align="center">

    </div>

</body>

</html>


<?php

function getClass($id)
{
    $server = "localhost";
    $username = "root";
    $password = "root"; 
    $database = "schoolLast";

    $conn = mysqli_connect($server, $username, $password, $database);

    $query = "SELECT * FROM classes WHERE CId = $id";

    $result = $conn->query($query);

    $row = $result->fetch_row();

    return [$row[1], $row[2]];
}

$query = " SELECT * from students";

$result = $conn->query($query);

echo "<table border='1' >

    <tr>

    <td align=center><b>Номер</b></td>

    <td align=center><b>Фамилия</b></td>

    <td align=center><b>Имя</b></td>

    <td align=center><b>Отчество</b></td>

    <td align=center><b>Дата рождения</b></td>

    <td align=center><b>Класс</b></td></tr>

    <td align=center><b></b></td></tr>";

while ($row = $result->fetch_row()) {
    [$classNum, $classLet] = getClass($row[5]);
    echo "<tr>";
    echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "</td>";
    echo "<td>" . $row[2] . "</td>";
    echo "<td>" . $row[3] . "</td>";
    echo "<td>" . $row[4] . "</td>";
    echo "<td>$classNum-$classLet</td>";
    echo "<td><button onclick=\"del(this.value)\" value=$row[0] id=\"delete\">Удалить</button></td>";
    echo "</tr>";
}

echo "</table>";

?>

<?php

// сохраните это в dbconnector.php

function connected_Db()
{
    include_once "db.php";
}

$con = connected_Db();

if ($conn) {

    //echo "успешное соединение ";
} else {

    //echo "ошибки при соединении ";

    exit();
}

?>