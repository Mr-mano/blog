<?php require '../vendor/autoload.php';


use App\Router;

define('DEBUG_TIME', microtime(true));

//outil de débugage whoops
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

define('UPLOAD_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'uploads');

// si la page = /?page=1 on renvoie à d'origine
if(isset($_GET['page']) && $_GET['page'] === '1'){
    
    //réécrire l'url sans le paramètre ?page
    $uri = $_SERVER['REQUEST_URI'];
    $uri = explode('?', $uri)[0];
    $get = $_GET; // ne jamais modifier directement les variables globale
    unset($get['page']); //unset détruit le terme sélectionné 'page'
    $query = http_build_query($get);
    if (!empty($query)){
        $uri = $uri . '?' . $query;
    }
    http_response_code(301);
    header('Location: ' . $uri);
    exit();
}

$router = new Router(dirname(__DIR__) . '/views');

$router
    ->get('/', 'post/index', 'home')
    ->get('/blog/category/[*:slug]-[i:id]', 'category/show', 'category')
    ->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
    ->match('/login', 'auth/login', 'login')
    ->post('/logout', 'auth/logout', 'logout')
    //ADMIN
    //gestion des articles
    ->get('/admin', 'admin/post/index', 'admin_posts')
    ->match('/admin/post/[i:id]', 'admin/post/edit', 'admin_post') //modifier un article
    ->post('/admin/post/[i:id]/delete', 'admin/post/delete', 'admin_post_delete') //supprimer un article
    ->match('/admin/post/new', 'admin/post/new', 'admin_post_new') //créer un article
    //gestion des catégories
    ->get('/admin/categories', 'admin/category/index', 'admin_categories')
    ->match('/admin/category/[i:id]', 'admin/category/edit', 'admin_category') //modifier 
    ->post('/admin/category/[i:id]/delete', 'admin/category/delete', 'admin_category_delete') //supprimer
    ->match('/admin/category/new', 'admin/category/new', 'admin_category_new') //créer
    ->run();