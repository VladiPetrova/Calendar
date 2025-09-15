<?php

namespace Model\Dao;

class UserDao extends DbConnection {

    public static function getUserByEmail($email) {
        $pdo = self::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public static function insertUser($email, $password, $first_name, $last_name) {
        $pdo = self::getPdo();
        $stmt = $pdo->prepare("
            INSERT INTO users (email, password, first_name, last_name, is_admin)
            VALUES (?, ?, ?, ?, '0')
        ");
        $stmt->execute([$email, $password, $first_name, $last_name]);
    }
    
}
