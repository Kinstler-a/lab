<?php
// src/TaskController.php

class TaskController
{
    private \PDO $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    // GET /tasks
    public function index(): array
    {
        $stmt = $this->db->query('SELECT * FROM tasks ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    // GET /tasks/{id}
    public function show(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM tasks WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $task = $stmt->fetch();

        return $task ?: null;
    }

    // POST /tasks
    public function store(array $data): array
    {
        if (empty($data['title'])) {
            throw new InvalidArgumentException('Поле "title" обязательно.');
        }

        $stmt = $this->db->prepare(
            'INSERT INTO tasks (title, description, is_done) 
             VALUES (:title, :description, :is_done)'
        );
        $stmt->execute([
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'is_done'     => isset($data['is_done']) ? (int)$data['is_done'] : 0,
        ]);

        $id = (int)$this->db->lastInsertId();
        return $this->show($id);
    }

    // PUT /tasks/{id}
    public function update(int $id, array $data): ?array
    {
        $task = $this->show($id);
        if (!$task) {
            return null;
        }

        $title       = $data['title']       ?? $task['title'];
        $description = $data['description'] ?? $task['description'];
        $is_done     = isset($data['is_done']) ? (int)$data['is_done'] : (int)$task['is_done'];

        $stmt = $this->db->prepare(
            'UPDATE tasks 
             SET title = :title, description = :description, is_done = :is_done 
             WHERE id = :id'
        );
        $stmt->execute([
            'title'       => $title,
            'description' => $description,
            'is_done'     => $is_done,
            'id'          => $id,
        ]);

        return $this->show($id);
    }

    // DELETE /tasks/{id}
    public function destroy(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM tasks WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
