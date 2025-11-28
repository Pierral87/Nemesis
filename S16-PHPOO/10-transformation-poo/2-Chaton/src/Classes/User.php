<?php
namespace ProjetTransfo\Classes;

use PDO;

class User
{
    private ?int $id = null;
    private string $username;
    private string $email;
    private string $password;

    public function __construct(array $data)
    {
        $this->username = $data['pseudo'] ?? '';
        $this->email    = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
    }

    public function register(Database $db): bool
    {
        $hash = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt = $db->prepare(
            "INSERT INTO users (pseudo, email, password) VALUES (:u, :e, :p)"
        );
        return $stmt->execute([
            ":u" => $this->username,
            ":e" => $this->email,
            ":p" => $hash
        ]);
    }

    public static function login(Database $db, string $email, string $password): bool
    {
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            SessionManager::set('user_id', $user['id']);
            SessionManager::set('username', $user['pseudo']);
            return true;
        }
        return false;
    }
}
