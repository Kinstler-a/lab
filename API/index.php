<?php

header('Content-Type: application/json; charset=utf-8');

// Файлы лежат в той же папке, поэтому без ../src
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/TaskController.php';
$config = require __DIR__ . '/config.php';

try {
    $db  = new Database($config['db']);
    $pdo = $db->getConnection();
    $controller = new TaskController($pdo);

    $method = $_SERVER['REQUEST_METHOD'];
    $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Разбираем URL, например: /API/tasks или /API/tasks/1
    $parts = array_values(array_filter(explode('/', $uri)));

    // Ищем сегмент 'tasks' в любом месте пути
    $tasksIndex = array_search('tasks', $parts, true);

    if ($tasksIndex === false) {
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
        exit;
    }

    // ID будет следующим сегментом после 'tasks', если он есть
    $id = $parts[$tasksIndex + 1] ?? null;
    if ($id !== null && !ctype_digit($id)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid ID']);
        exit;
    }
    $id = $id !== null ? (int)$id : null;

    // Тело запроса (для POST/PUT/PATCH)
    $input = file_get_contents('php://input');
    $data  = json_decode($input, true) ?? [];

    switch ($method) {
        case 'GET':
            if ($id === null) {
                $result = $controller->index();
                echo json_encode($result);
            } else {
                $task = $controller->show($id);
                if ($task) {
                    echo json_encode($task);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Task not found']);
                }
            }
            break;

        case 'POST':
            try {
                $newTask = $controller->store($data);
                http_response_code(201);
                echo json_encode($newTask);
            } catch (InvalidArgumentException $e) {
                http_response_code(422);
                echo json_encode(['error' => $e->getMessage()]);
            }
            break;

        case 'PUT':
        case 'PATCH':
            if ($id === null) {
                http_response_code(400);
                echo json_encode(['error' => 'Task ID is required']);
                break;
            }
            $updated = $controller->update($id, $data);
            if ($updated) {
                echo json_encode($updated);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Task not found']);
            }
            break;

        case 'DELETE':
            if ($id === null) {
                http_response_code(400);
                echo json_encode(['error' => 'Task ID is required']);
                break;
            }
            $deleted = $controller->destroy($id);
            if ($deleted) {
                echo json_encode(['message' => 'Task deleted']);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Task not found']);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'error'   => 'Internal server error',
        'message' => $e->getMessage(),
    ]);
}
