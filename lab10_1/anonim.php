<?php
$square = fn($x) => $x * $x;

$numbers = [1, 2, 3, 4, 5];
$result = array_map($square, $numbers);

echo "Исходный массив: " . implode(", ", $numbers) . "<br>";
echo "Квадраты: " . implode(", ", $result);
?>