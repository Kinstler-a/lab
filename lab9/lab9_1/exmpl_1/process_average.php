<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n1 = (float)$_POST['num1'];
    $n2 = (float)$_POST['num2'];
    $n3 = (float)$_POST['num3'];

    $average = ($n1 + $n2 + $n3) / 3;

    echo "<h3>Результат:</h3>";
    echo "<p>Среднее арифметическое чисел $n1, $n2 и $n3 = <b>$average</b></p>";
} else {
    echo "Ошибка: данные не переданы.";
}
?>