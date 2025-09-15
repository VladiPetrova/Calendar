<?php

namespace Controller;

use Model\Dao\HolidayDao;

class HolidayController {

    public function seeYourLeaves() {
        if (!isset($_SESSION["user_id"])) {
            header("Location: ?target=base&action=login");
            die();
        }

        $userId = $_SESSION["user_id"];
        $yourLeaves = HolidayDao::getLeavesByUser($userId);

        require_once('View/holiday/your_leaves.php');
    }

    public function editLeave() {
        $holidayId = $_POST["holiday_id"];
        $startDate = $_POST["start_date"];
        $endDate = $_POST["end_date"];
        $userId = $_SESSION["user_id"];

        HolidayDao::updateUserPendingHoliday($holidayId, $startDate, $endDate, $userId);

        header("Location: ?target=holiday&action=seeYourLeaves");
        die();
    }
}
