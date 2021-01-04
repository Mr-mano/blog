<?php

use App\Connection;
use App\Table\PostTable;

$title = 'Mon blog';
$pdo = Connection::getPDO();

$table = new PostTable($pdo); //retourne un tableau résultats requête pagination et categories
[$posts, $pagination]= $table->findPaginated();

$link = $router->url('home');

?>

<h1>Mon Blog</h1>

<div class="row">
    <?php foreach($posts as $post): ?>
        <div class="col-md-3">
            <?php require 'card.php' ?>
        </div>
    <?php endforeach ?>
</div>
<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>


