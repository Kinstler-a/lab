<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    echo "<h3>Добро пожаловать, $login!</h3>";
    echo "<p>Ваш пароль: $password (никогда не храните так данные!)</p>";
} else {
    echo "Неверный метод запроса!";
}
?>