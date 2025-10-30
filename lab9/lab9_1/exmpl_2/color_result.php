<?php
$color = $_GET['color'] ?? 'white';

$allowed = ['lightblue','lightgreen','lightyellow','lightpink','lightgray','white'];
if (!in_array($color, $allowed, true)) {
    $color = 'white';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Ваш выбранный цвет</title>
</head>
<body style="margin:0; padding:30px; background-color: <?= htmlspecialchars($color) ?>;">
  <h2>Вы выбрали цвет: <?= htmlspecialchars($color) ?></h2>
  <p>Это отдельная страница с изменённым фоном.</p>
  <p><a href="color_form.html">Выбрать другой цвет</a></p>
</body>
</html>