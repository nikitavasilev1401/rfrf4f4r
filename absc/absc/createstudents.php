<?php
require_once "db.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['create'])) {
   
    
        $lastName = $_POST["SLastName"];
        $Name = $_POST["SFirstName"];
        $Patronic = $_POST["SMidName"];
        $BirthDay = $_POST["SBirthDate"];
        $Class = $_POST["categoryId"];


     //   $existSql =  "SELECT SLastName, SFirstName, SMidName, SBirthDate, COUNT(*) FROM students GROUP BY SLastName, SFirstName, SMidName, SBirthDate HAVING COUNT(*) > 1 ;";


     $existSql = sprintf("SELECT * FROM `students` WHERE `SLastName` = '$lastName' AND `SFirstName`= '$Name' AND `SMidName` = '$Patronic' AND `SBirthDate` ='$BirthDay'");
      
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){

            echo '<script>alert("Такой ученик уже есть");
            window.location=document.referrer;
            </script>';
        }

        $sql = sprintf("INSERT INTO `students`(`SLastName`, `SFirstName`, `SMidName`, `SBirthDate`, `CId`) VALUES ('$lastName','$Name','$Patronic','$BirthDay','$Class')");
      
        
         $result = mysqli_query($conn, $sql);
      
        if ($result){
            echo '<div class="alert alert-success">Ученик добавлен</div>';
            // echo '<script>alert("Успешно");
            // window.location=document.referrer;
            // </script>';
        }
            else{
                echo "Ошибка: " . $conn->error;
            }
        }
       
        else {
            echo "<script>alert('Ошибка2');
                    window.location=document.referrer;
                </script>";
        }
    }
    


?>