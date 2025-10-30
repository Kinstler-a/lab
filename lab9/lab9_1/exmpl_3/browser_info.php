<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Определение браузера</title>
</head>
<body>
  <h2>Информация о вашем браузере</h2>

  <?php
  // получаем строку User-Agent
  $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Неизвестно';

  // определяем браузер по ключевым словам
  if (stripos($userAgent, 'Chrome') !== false && stripos($userAgent, 'Edg') === false) {
      $browser = 'Google Chrome';
  } elseif (stripos($userAgent, 'Edg') !== false) {
      $browser = 'Microsoft Edge';
  } elseif (stripos($userAgent, 'Firefox') !== false) {
      $browser = 'Mozilla Firefox';
  } elseif (stripos($userAgent, 'Safari') !== false && stripos($userAgent, 'Chrome') === false) {
      $browser = 'Safari';
  } elseif (stripos($userAgent, 'Opera') !== false || stripos($userAgent, 'OPR') !== false) {
      $browser = 'Opera';
  } else {
      $browser = 'Неизвестный браузер';
  }

  echo "<p><strong>Ваш браузер:</strong> $browser</p>";
  echo "<p><strong>Полная строка User-Agent:</strong></p>";
  echo "<pre>$userAgent</pre>";
  ?>
</body>
</html>