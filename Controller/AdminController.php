<?php

namespace Controller;

use Model\Dao\HolidayDao;

class AdminController {

    public function seeRequests() {
        if ($_SESSION["isAdmin"] == false) {
            header("Location: ?target=base&action=index");
            die();
        }
        $pendingRequests = HolidayDao::getPendingRequests();
        require_once('View/admin/requests.php');
    }

    public function handleRequest() {
        if ($_SESSION["isAdmin"] == false) {
            header("Location: ?target=base&action=index");
            die();
        }
        if (isset($_POST["holiday_id"]) && isset($_POST["action"])) {
            $holidayId = $_POST["holiday_id"];
            $action = $_POST["action"];

            HolidayDao::updateHolidayStatus($holidayId, $action);
        }

        header("Location: ?target=admin&action=seeRequests");
        die();
    }
}
