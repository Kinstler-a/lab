<?php
$str = "Программирование на PHP";
echo "Длина строки: " . strlen($str) . "<br>";
echo "В верхнем регистре: " . strtoupper($str) . "<br>";
echo "В нижнем регистре: " . strtolower($str) . "<br>";

$numbers = [5, 12, 8, 3];
echo "Максимум: " . max($numbers) . "<br>";
echo "Минимум: " . min($numbers) . "<br>";
echo "Сумма элементов: " . array_sum($numbers) . "<br>";

echo "Округление 3.56: " . round(3.56) . "<br>";
echo "Модуль числа -5: " . abs(-5) . "<br>";
echo "Случайное число (1–10): " . rand(1,10);
?>