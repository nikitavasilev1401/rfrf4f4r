<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script src="jquery-1.9.1.min.js">

    </script>
    <script type="text/javascript" src="jquery-1.3.2.js"> </script>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#add_student").click(function() {
                var e = document.getElementById("CId");
                var value = e.options[e.selectedIndex].value;
                $.ajax({

                    type: "POST",

                    url: "students_functions.php",

                    data: {
                        "function": "Add",
                        "SLastName" : document.getElementById('SLastName').value,
                        "SFirstName" : document.getElementById('SFirstName').value,
                        "SMidName" : document.getElementById('SMidName').value,
                        "SBirthDate" : document.getElementById('SBirthDate').value,
                        "CId" : String(value),
                    },

                    success: function(response) {

                        alert(response);    

                    }

                });

            });

        });
    </script>
    <title>Document</title>
</head>

<body>

    <main>
        <div class="container">

            <nav>
                <ul>
                    <li><a href="Report.php">Отчеты</a></li>
                    <li><a href="students.php">Добавление ученика</a></li>
                    <li><a href="Student_list.php">Список учащихся</a></li>
                </ul>
            </nav>


            <div class="block">
                <?php
                include_once "database.php";
                include_once "objects/product.php";
                include_once "objects/Spisok.php";
                $database = new Database();
                $db = $database->getConnection();

                // создадим экземпляры классов Product и Category
                $product = new Product($db);
                $category = new Spisok($db);
                $ry = new Spisok($db);

                ?>
                    <div class="form-container">
                <form class="form-box2" method="POST" action="login.php">
                    <img src="img/user.png" alt="" class="user">
                    <h1>Добавление ученика</h1>
                    <input required type="text" id="SLastName" placeholder="Фамилия">
                    <input required type="text" id="SFirstName" placeholder="Имя">
                    <input required type="text" id="SMidName" placeholder="Отчество">
                    <p class="data_ro">Дата рождения<input required class="inputreg" id="SBirthDate" type="date"></p>
                    <?php
                    include "db.php";

                      $query = "SELECT * FROM classes";

                      $result = $conn->query($query);



                      // помещаем их в выпадающий список
                      echo "<select class='form-control' id='CId'>";
                      echo "<option>Выбрать класс</option>";

                      while ($row = $result->fetch_row()) {
                          echo "<option value='{$row[0]}' >$row[1]-$row[2]</option>";
                      }

                      echo "</select>";
                    ?>
                    <input type="submit" id="add_student" value="Добавить">
                </form>
            </div>

                

</body>

</html>