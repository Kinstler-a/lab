<?php
function average($arr) {
    if (count($arr) == 0) return 0;
    return array_sum($arr) / count($arr);
}

$numbers = [4, 8, 6, 10];
echo "Массив: " . implode(", ", $numbers) . "<br>";
echo "Среднее значение: " . average($numbers);
?>