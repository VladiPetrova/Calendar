<?php
if (!empty($_SESSION['first_name'])){
    header('Location: index.php?target=calendar&action=index');
}
?>

<?php require_once 'View/layouts/header.php'; ?>

<form method="post" action="index.php?target=user&action=doLogin" class="container mt-5">
    <h2>Вход</h2>
    <?php if (!empty($error)) { ?>
        <div class="text-danger"><?= $error ?></div>
    <?php } ?>
    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-2" placeholder="Парола" required>
    <button type="submit" class="btn btn-primary">Вход</button>
    <p class="mt-2">Нямаш профил? <a href="index.php?target=user&action=register">Регистрация</a></p>
</form>

<?php
require_once 'View/layouts/footer.php';
