<?php

if (isset($_GET['a']) && isset($_GET['b'])) {

    $a = (int) $_GET['a'];
    $b = (int) $_GET['b'];

    echo "Сумма: " . ($a + $b) . "<br>";
    echo "Разность: " . ($a - $b) . "<br>";
    echo "Произведение: " . ($a * $b) . "<br>";

    if ($b != 0) {
        echo "Частное: " . ($a / $b);
    } else {
        echo "Частное: деление на ноль невозможно";
    }

} else {
    echo "Передайте параметры a и b!";
}

?>