<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Register user
    public function register($name, $email, $password)
    {
        // Проверяем, что переданы все необходимые данные
        if (empty($name) || empty($email) || empty($password)) {
            return false;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        // Биндим значения
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $hashed_password);

        // Выполняем запрос
        try {
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            // Обрабатываем исключение, логируем и т.д.
            return false;
        }
    }

    // Login User
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row && password_verify($password, $row->password)) {
            return $row;
        } else {
            return false;
        }
    }

    // Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        // Биндим значение
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        return $row ? true : false;
    }

    // Get User by ID
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        // Биндим значение
        $this->db->bind(':id', $id);

        return $this->db->single();
    }
}
