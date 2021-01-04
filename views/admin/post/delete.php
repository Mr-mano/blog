<?php
use App\Auth;
use App\Connection;
use App\Table\PostTable;
use App\Attachment\PostAttachment;

Auth::check();

$pdo = Connection::getPDO();
$table = new PostTable($pdo);
$post = $table->find($params['id']);//on récupére l'ID de l'article
PostAttachment::detach($post);//on suprime les images liées à l'article
$table->delete($params['id']);
header('Location:' . $router->url('admin_posts') . '?delete=1');


