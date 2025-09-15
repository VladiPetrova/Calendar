<?php
if (empty($_SESSION['first_name'])) {
    header('Location: index.php');
}
?>
<?php if ($successMessage) { ?>
    <div class="alert alert-success">
        <?= $successMessage == 'holiday_saved' ? 'Успешно запазен отпуск!' : $successMessage; ?>
    </div>
<?php } ?>

<?php if ($errorMessage) { ?>
    <div class="alert alert-danger">
        <?= $errorMessage == 'invalid_dates' ? 'Невалидни дати!' : $errorMessage; ?>
    </div>
<?php } ?>
<div class="container">
    <div class="d-flex justify-content-between m-2">
        <div>
            <form method="GET">
                <a href="?target=calendar&action=index&offset=<?= $offset - 1; ?>" class="btn btn-primary" id="prevMonth">
                    <i class="bi bi-caret-left-square-fill"></i>
                </a>
                <a href="?target=calendar&action=index&offset=0" class="btn btn-primary" id="currMonth">
                    <i class="bi bi-calendar-event-fill"></i>
                </a>
                <a href="?target=calendar&action=index&offset=<?= $offset + 1; ?>" class="btn btn-primary" id="nextMonth">
                    <i class="bi bi-caret-right-square-fill"></i>
                </a>
		<button type="button" class="btn btn-primary px-2 py-1" data-bs-toggle="modal" data-bs-target="#holidayModal">
                    Пусни отпуск
		</button>
            </form>
        </div>	
        <h3 class="m-0"><?= $now->format('F'); ?></h3>
        <h3 class="m-0"><?= $year; ?></h3>

    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 14.28%;">ПН</th>
                <th style="width: 14.28%;">ВТ</th>
                <th style="width: 14.28%;">СР</th>
                <th style="width: 14.28%;">ЧТ</th>
                <th style="width: 14.28%;">ПТ</th>
                <th style="width: 14.28%;">СБ</th>
                <th style="width: 14.28%;">НД</th>
            </tr>
        </thead>
        <tbody>

	    <?php
	    $previous_month_counter = $daysInPreviousMonth - $weekDayFirstDayOfMonth + 1;
	    $current_month_counter = 1;
	    $next_month_counter = 1;
	    for($i = 0; $i < 6; $i++){
	    ?>
		
		<tr>
		    <?php for($j = 0; $j < 7; $j++){
			if($i == 0 && $j < $weekDayFirstDayOfMonth){
		    ?>
			
			<!-- before start of current month -->
			<td class="table-secondary" style="height:130px"> <?=$previous_month_counter++;?></td>
			<?php 
			continue;
			}elseif($current_month_counter > $daysInCurrentMonth){
			?>
			    
			    <!-- after end of current month -->
			    <td class="table-secondary" style="height:130px"> <?=$next_month_counter++?></td>
			    <?php
			    continue;
			    }
			    ?>
			    
			    <!-- current month incrementation -->
			    <td <?=($day == $current_month_counter && $month == date('m')) ? 'class = "table-primary"' : '';?> style="height:130px"> <?=$current_month_counter++?>
				<?php foreach($holidays as $key_holiday => $holiday){
				    $rand_color = '#' . substr(md5($key_holiday . "seed1"), 10, 6);
				    $holiday_start_day = explode("-", $holiday['start_date'])[2];
				    $holiday_end_day = explode("-", $holiday['end_date'])[2];
				    if($current_month_counter - 1 >= $holiday_start_day && $current_month_counter - 1 <= $holiday_end_day){
					if($holiday['status'] == 'approved'){
					    $rand_color = '#00' . sprintf("%02x", min(120 + ($holiday['user_id']*30), 255))  . '00';
					}elseif($holiday['status'] == 'rejected'){
					    $rand_color = '#' . sprintf("%02x", min(100 + ($holiday['user_id']*30), 255))  . '0000';
					}else{
					    $rand_color = '#ff' . sprintf("%02x", min(150 + ($holiday['user_id']*30), 255))  . '00';
					}
				?>
				    <div class="opacity-50 my-1 w-100" style="height:20px; background-color:<?=$rand_color;?>;"><span class="text-light p-2"> <?=$holidayDao->getNameById($holiday['user_id']);?></span></div>
				<?php }
				}?>

			    </td>
			<?php } ?>
		</tr>
		
		<?php
		if($current_month_counter > $daysInCurrentMonth) break;
		}
		?>
	</tbody>

    </table>
    <!-- Modal -->
    <form method="post" action="?target=calendar&action=submitDates">
        <div class="modal fade" id="holidayModal" tabindex="-1" aria-labelledby="holidayModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="holidayModalLabel">Избери дати:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="start" class="form-label">Начална дата:</label>
                            <input type="date" id="start" name="start_date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="end" class="form-label">Крайна дата:</label>
                            <input type="date" id="end" name="end_date" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Изход</button>
                        <button type="submit" class="btn btn-primary" name="add_holiday">Запази</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>