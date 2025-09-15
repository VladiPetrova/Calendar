<?php

namespace Controller;

use DateTime;
use Model\Dao\HolidayDao;

class CalendarController {

    public function index() {

	// Get current year and month
        $now = new DateTime();
	// Modify date based on offset
        $offset = 0;
        if (isset($_GET['offset'])) {
            $offset = htmlentities(trim($_GET['offset']));

	    // Make sure it's a valid integer, positive or negative
            if (is_numeric($offset)) {
                $offset = (int) $offset;

		// Limit the range
                if ($offset < -36) {
                    $offset = -36;
                } elseif ($offset > 36) {
                    $offset = 36;
                }
            } else {
                $offset = 0;
            }

            $now->modify($offset . ' month');
        }
        $year = $now->format('Y');
        $month = $now->format('m');
        $day = $now->format('j');
	// Get number of days in current month
        $daysInCurrentMonth = $now->format('t');
	// Get previous year and month
        $previousMonth = clone $now;
        $previousMonth->modify('-1 month');
        $previous_month = $previousMonth->format('m');
	// Get number of days in previous month
        $daysInPreviousMonth = $previousMonth->format('t');

	// Get weekday of first day of current month
	// Get first day of the current month
        $firstDayOfMonth = (clone $now)->modify('first day of this month');
	$lastDayOfMonth = (clone $now)->modify('last day of this month');
	// Get weekday of the first day (1 = Monday, 7 = Sunday)
        $weekDayFirstDayOfMonth = $firstDayOfMonth->format('N') - 1;

	// Get all holidays in current month
	$holidayDao = new HolidayDao();
	$holidays = $holidayDao->getHolidaysInRange($_SESSION['user_id'], $firstDayOfMonth->format('Y-m-d'), $lastDayOfMonth->format('Y-m-d'));

	//var_dump($holidays);

        $successMessage = isset($_GET['success']) ? $_GET['success'] : null;
        $errorMessage = isset($_GET['error']) ? $_GET['error'] : null;

        require_once('View/layouts/header.php');
        require_once('View/calendar_p/index.php');
        require_once('View/layouts/footer.php');
    }

    public function submitDates() {
        if (isset($_POST["add_holiday"])) {
            $startDate = $_POST["start_date"];
            $endDate = $_POST["end_date"];
            $userId = $_SESSION["user_id"];

            if (!$startDate || !$endDate || strtotime($startDate) > strtotime($endDate)) {
                header("Location: ?target=calendar&error=invalid_dates");
                die();
            }

            HolidayDao::addHoliday($startDate, $endDate, $userId);

            header("Location: ?target=calendar&success=holiday_saved");
            die();
        }
    }
    
  
}
