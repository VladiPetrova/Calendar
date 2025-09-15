<?php

namespace Model\Dao;

class HolidayDao extends DbConnection {

    public function __construct() {
        //so that it doesn't inherit private constructor
    }

    public static function addHoliday($startDate, $endDate, $userId) {
        $pdo = self::getPdo();
        $stmt = $pdo->prepare("INSERT INTO holidays (start_date, end_date, status, user_id) VALUES (?,?,'pending',?)");
        $stmt->execute([$startDate, $endDate, $userId,]);
    }

    public static function getPendingRequests() {
        $pdo = self::getPdo();
        $stmt = $pdo->query("
            SELECT holidays.*, users.first_name, users.last_name
            FROM holidays
            JOIN users ON holidays.user_id = users.id
            WHERE holidays.status = 'pending'
            ORDER BY holidays.start_date
        ");
        return $stmt->fetchAll();
    }

    public static function updateHolidayStatus($holidayId, $status) {
        $pdo = self::getPdo();
        $stmt = $pdo->prepare("UPDATE holidays SET status = ? WHERE id = ?");
        $stmt->execute([$status, $holidayId]);
    }

    public static function getLeavesByUser($userId) {
        $pdo = self::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM holidays WHERE user_id = ? ORDER BY start_date DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public static function updateUserPendingHoliday($holidayId, $startDate, $endDate, $userId) {
        $pdo = self::getPdo();
        $stmt = $pdo->prepare("UPDATE holidays SET start_date = ?, end_date = ? 
                           WHERE id = ? AND user_id = ? AND status = 'pending'");
        $stmt->execute([$startDate, $endDate, $holidayId, $userId]);
    }

    public function getHolidaysInRange($userId, $startOfMonth, $endOfMonth) {
        $pdo = self::getPdo();
        $sql = "
SELECT * FROM holidays
WHERE start_date >= ?
AND end_date <= ?
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$startOfMonth, $endOfMonth]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getNameById($user_id) {
        $pdo = self::getPdo();
        $sql = "
SELECT u.first_name FROM holidays as h
JOIN users as u
ON h.user_id = u.id
WHERE h.user_id = ?
LIMIT 1
";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchColumn();
    }
}
