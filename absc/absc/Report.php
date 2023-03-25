<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
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
                <form method="POST" class="b-block" action="createstudents.php"> 
                    <table class="table table-striped table-hover text-center">
                <thead>
                    <h3>Показать самого младшего первоклассника (из всей школы)</h3>
                    <tr>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Дата рождения</th>						
                    </tr>
                </thead>
                <tbody>
                <?php include 'db.php';?>
                    <?php
                    $sql = sprintf("SELECT * FROM `students` where `SBirthDate` = (select max(`SBirthDate`) from `students`);");
                   
                        $result = mysqli_query($conn, $sql);
                      
                        while($row = mysqli_fetch_assoc($result)){
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
                        
                      
                    ?>
                </tbody>
            </table>
            <table class="table table-striped table-hover text-center">
                    <h2>Подсчитать количество учеников во всех вторых классах</h2>
                    <tr>
                        <p>Число</p>
                    </tr>
                <tbody>
                    <?php
                     
                        
                    ?>
                        <?php

                        $sql = sprintf("SELECT count(students.SId) as count from classes left join students on classes.CId = students.CId where classes.CLevel = 2 group by classes.CLevel");
                           
                        $resultAll = mysqli_query($conn, $sql);
                        if(!$resultAll){
                            die(mysqli_error($conn));
                        }

                        if (mysqli_num_rows($resultAll) > 0) {
                            while($rowData = mysqli_fetch_array($resultAll)){
                                echo $rowData["count"].'<br>';
                            }
                        }
                       // echo $resultAll
                        ?>
                </tbody>
            </table>
           <table class="table table-striped table-hover text-center">
                <thead>
                <h2> Вывести список именинников в июле</p>
                    <tr>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Дата рождения</th>
                    </tr>
                </thead>
                <tbody>
              
                    <?php
                            $sqlll = sprintf("SELECT students.SLastName,students.SFirstName,students.SMidName,students.SBirthDate
                            from students where SBirthDate LIKE '____-07-__'");
                        $resulttt = mysqli_query($conn, $sqlll);
                        while($row = mysqli_fetch_assoc($resulttt)){
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
                    ?>
                </tbody>
            </table>
                </form>
            </div>

        </div>
    </main>
    
</body>
</html>