<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?= isset($title) ? e($title) : 'Mon site' ?></title>
</head>
<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a href="#" class="navbar-brand">Mon site</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="<?= $router->url('admin_posts') ?>" class="nav-link">Articles</a>
            </li>
            <li class="nav-item">
                <a href="<?= $router->url('admin_categories') ?>" class="nav-link">Catégories</a>
            </li>
            <li class="nav-item">
                <form action="<?= $router->url('logout') ?>" method="post" style="display:inline">
                    <button type="submit" class="nav-link" style="background:transparent; border:none;">Se déconnecter</button>
                </form>
            </li>
        </ul>
    </nav>
    <div class="container p-5">
        <?= $content ?>
    </div>

<footer class="bg-light py-4 footer mt-auto">
    <div class="container">
        <?php if (defined('DEBUG_TIME')) : ?>
            Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?>ms
        <?php endif; ?>
    </div>
</footer>
</body>
</html>