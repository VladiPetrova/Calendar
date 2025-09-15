<html lang="bg">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Календар за отпуски</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- bootstrap icons -->	
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <?php if (!empty($_SESSION['first_name'])) { ?>
                    <a class="navbar-brand" href="?target=calendar&action=index">Календар за отпуски</a>
                <?php } else { ?>
                    <a class="navbar-brand">Календар за отпуски</a>
                <?php } ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php if (!empty($_SESSION['first_name'])) { ?>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarContent">
                        <div class="mx-auto text-center">
                            <span class="navbar-text text-light">Hello, <?php echo $_SESSION['first_name']; ?>!</span>
                        </div>
                        <?php if ($_SESSION["isAdmin"] == true) { ?>
                            <div class="d-flex">
                                <a class="nav-link text-light" href="?target=admin&action=seeRequests">Заявки за отпуск</a>
                            </div>
                        <?php } else { ?>
                            <div class="d-flex">
                                <a class="nav-link text-light" href="?target=holiday&action=seeYourLeaves">Моите отпуски</a>                            </div>
                        <?php } ?>
                        <div class="d-flex">
                            <a class="nav-link text-light" href="?target=base&action=logout">Изход</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </nav>

