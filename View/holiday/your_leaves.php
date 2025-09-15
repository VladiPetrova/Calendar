<?php require_once('View/layouts/header.php'); ?>

<div class="container mt-4">
    <h2>Моите отпуски</h2>

    <?php if (empty($yourLeaves)) { ?>
        <p class="text-muted">Нямате подадени отпуски.</p>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Начална дата</th>
                    <th>Крайна дата</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($yourLeaves as $leave) { ?>
                    <tr>
                        <td><?= $leave["start_date"]; ?></td>
                        <td><?= $leave["end_date"]; ?></td>
                        <td>
                            <?php
                            switch ($leave["status"]) {
                                case "pending": echo 'Oчаква одобрение';
                                    break;
                                case "approved": echo 'Одобрена';
                                    break;
                                case "rejected": echo 'Отказана';
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($leave["status"] == "pending") { ?>
                                <form method="post" action="?target=holiday&action=editLeave" class="d-inline">
                                    <input type="hidden" name="holiday_id" value="<?= $leave["id"]; ?>">
                                    <input type="date" name="start_date" value="<?= $leave["start_date"]; ?>" required>
                                    <input type="date" name="end_date" value="<?= $leave["end_date"]; ?>" required>
                                    <button type="submit" class="btn btn-warning btn-sm">Редактирай</button>
                                </form>
                            <?php } else { ?>
                                <p>Не може да се редактира</p>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<?php require_once('View/layouts/footer.php'); ?>

