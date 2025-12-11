<?php

if (!empty($_GET['name']) && !empty($_GET['city'])) {

    $name = htmlspecialchars($_GET['name']);
    $city = htmlspecialchars($_GET['city']);

    echo "Привет, $name! Добро пожаловать из города $city. <br><br>";

    if (!empty($_SERVER['HTTP_REFERER'])) {
        echo "<a href='" . $_SERVER['HTTP_REFERER'] . "'>Вернуться назад</a>";
    }

} else {
    echo "Недостаточно параметров!";
}

?>