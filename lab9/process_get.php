<?php
if (isset($_GET['username'])&& isset($_GET['age'])){
    $name=htmlspecialchars($_GET['username']);
    $age=(int) $_GET['age'];

    echo "<h3>Здравствуйте , $name!</h3>";
    echo "<p>Вам $age лет.</p>";
    }else{
        echo"Пожалуйста, введите данные через форму.";
    }
    ?>