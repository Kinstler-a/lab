<?php
function reverseString($str) {
    return strrev($str);
}

$text = "Привет";
echo "Исходная строка: $text<br>";
echo "Перевёрнутая: " . reverseString($text);
?>
