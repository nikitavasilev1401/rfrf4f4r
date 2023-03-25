<?php

error_reporting(E_ALL);

ini_set('display_errors', 1);

function connect()
{
    $server = "localhost";
    $username = "root";
    $password = "root";
    $database = "schoolLast";

    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn) {
        die("Error" . mysqli_connect_error());
    }
    return $conn;
}
$request = $_POST;

$func = $request['function'];

function Get()
{
    $id = $_POST['id'];
    $server = "localhost";
    $username = "root";
    $password = "root";
    $database = "schoolLast";

    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn) {
        die("Error" . mysqli_connect_error());
    }

    $query = "SELECT * FROM students WHERE CId = " . $id;

    $result = $conn->query($query);

    echo "<table border='1' >

    <tr>

    <td align=center><b>System ID</b></td>

    <td align=center><b>Имя</b></td>

    <td align=center><b>Фамилия</b></td>

    <td align=center><b>Отчество</b></td>

    <td align=center><b>Дата рождения</b></td>

    <td align=center><b>Класс</b></td></tr>";

    while($row = $result->fetch_row()){
        [$classNum, $classLet] = getClass($row[5]);
        echo "<tr>";
        echo "<td>".$row[0]."</td>";
        echo "<td>".$row[1]."</td>";
        echo "<td>".$row[2]."</td>";
        echo "<td>".$row[3]."</td>";
        echo "<td>$classNum-$classLet</td>";
        echo "<td><button onclick=\"del(this.value)\" value=$row[0] id=\"delete\">Удалить</button></td>";
        echo "</tr>";

    }

    echo "</table>";


}

function getClass($id)
{
    $conn = connect();

    $query = "SELECT * FROM classes WHERE CId = $id";

    $result = $conn->query($query);

    $row = $result->fetch_row();

    return [$row[1], $row[2]];

}

function Add()
{
    $SLastName = $_POST["SLastName"] ? $_POST["SLastName"] : exit();
    $SFirstName = $_POST["SFirstName"] ? $_POST["SFirstName"] : exit();
    $SMidName = $_POST["SMidName"] ? $_POST["SMidName"] : exit();
    $SBirthDate = $_POST["SBirthDate"] ? $_POST["SBirthDate"] : exit();
    $CId = $_POST["CId"] ? $_POST["CId"] : exit();

    $conn = connect();

    $query = "SELECT * FROM students WHERE SLastName = '$SLastName' AND SFirstName =  '$SFirstName' AND SMidName = '$SMidName' AND SBirthDate = '$SBirthDate'";
    
    $result = $conn->query($query);

    if($result->num_rows > 0)
    {
        echo ("Уже есть");
        exit();
    }

    $query = "INSERT INTO students(SLastName, SFirstName, SMidName, SBirthDate, CId) VALUES(\"$SLastName\", \"$SFirstName\", \"$SMidName\",\"$SBirthDate\", \"$CId\")";

    $conn->query($query);
    echo("Добавлено");
}

function Delete()
{
    $id = $_POST['id'];

    $query = "DELETE FROM students WHERE SId = \"$id\"";
    
    $conn = connect();

    $conn->query($query);

}
switch ($func):

case "Get":
    Get();
    break;
case "Add":
    Add();
    break;
case "Del":
    Delete();
    break;
default:

endswitch;
