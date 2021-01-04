<?php 
$categories = [];
foreach($post->getCategories() as $category){
    $url = $router->url('category', ['id' => $category->getID(), 'slug' =>$category->getSlug()]);
    $categories[] = <<<HTML
<a href="{$url}">{$category->getName()}</a>
HTML;
}

?>


<div class="card mb-3">
<?php if($post->getImage()):?>
<img src="<?= $post->getImageURL('small')?>" class="card-img-top" alt="">
<?php endif ?>
    <div class="card-body">
        <h5 class="card-title"><?= e($post->getName())?></h5>
        <p class="text-muted">
            <?= $post->getCreatedAt()->format('d F Y' . " à " . 'H:i'); ?> ::
            <?php if (!empty($post->getCategories())): ?>
            ::
            <?= implode(', ', $categories) ?>
            <?php endif ?>


        </p>
        <p><?= $post->getExcerpt()?></p>
        <p>
            <a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="btn btn-primary">Voir +</a>
        </p>
    </div>
</div>