
<?php require_once('View/layouts/header.php'); ?>

<div class="container mt-4">
    <h2>Заявки за отпуск</h2>

    <?php if (empty($pendingRequests)) { ?>
        <p class="text-muted">Няма чакащи заявки.</p>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Име</th>
                    <th>Начална дата</th>
                    <th>Крайна дата</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendingRequests as $request) { ?>
                    <tr>
                        <td><?= $request["first_name"] . " " . $request["last_name"]; ?></td>
                        <td><?= $request["start_date"]; ?></td>
                        <td><?= $request["end_date"]; ?></td>
                        <td>
                            <form method="post" action="?target=admin&action=handleRequest" class="d-inline">
                                <input type="hidden" name="holiday_id" value="<?= $request["id"]; ?>">
                                <button type="submit" name="action" value="approved" class="btn btn-success btn-sm">Одобри</button>
                                <button type="submit" name="action" value="rejected" class="btn btn-danger btn-sm">Откажи</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>
<?php
require_once('View/layouts/footer.php');
