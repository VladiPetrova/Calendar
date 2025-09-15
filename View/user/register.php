<?php require_once 'View/layouts/header.php'; ?>

<form method="post" action="index.php?target=user&action=doRegister" class="container mt-5">
    <h2>Регистрация</h2>
    <?php if (!empty($error)) { ?>
        <div class="text-danger"><?= $error ?></div>
    <?php } ?>
    <input type="text" name="first_name" class="form-control mb-2" placeholder="Име" required>
    <input type="text" name="last_name" class="form-control mb-2" placeholder="Фамилия" required>
    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-2" placeholder="Парола" required>
    <button type="submit" class="btn btn-primary">Регистрация</button>
    <p class="mt-2">Имаш профил? <a href="index.php?target=user&action=login">Вход</a></p>
</form>

<?php
require_once 'View/layouts/footer.php';
