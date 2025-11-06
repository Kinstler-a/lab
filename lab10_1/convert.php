<?php
function convertToUpper($arr) {
    return array_map('strtoupper', $arr);
}

$languages = ["php", "html", "css"];
$result = convertToUpper($languages);

echo "Исходный массив: " . implode(", ", $languages) . "<br>";
echo "В верхнем регистре: " . implode(", ", $result);
?>