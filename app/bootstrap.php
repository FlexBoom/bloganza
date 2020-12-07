<?php declare(strict_types=1);

spl_autoload_register(function ($class) {
    $file = __DIR__.'/'.str_replace('\\', '/', str_replace('Bloganza\\', '', $class)).'.php';

    if (is_file($file)) {
        require $file;
    }
});

$settings = require('Config/Settings.php');

$dsn = "mysql:host=".$settings['PDO']['host'].";dbname=".$settings['PDO']['dbname'].";charset=".$settings['PDO']['charset'];
$pdo = new PDO($dsn, $settings['PDO']['user'], $settings['PDO']['password'], $settings['PDO']['options']);

$router = new Bloganza\Router();

$router->add('/', 'get', function($parameters = []) {
    echo 'Home';
});

$router->add('/first-post', 'get', function($parameters = []) use ($pdo) {
    $db = new Bloganza\Adapters\PdoAdapter($pdo);
    $mapper = new Bloganza\Mappers\Post($db);
    $repository = new Bloganza\Repositories\Post($mapper);
    $posts = new Bloganza\Services\Posts($repository);

    $post = $posts->getPost(1);

    var_dump($post);
});

$router->add('/admin/page/<id>/<type>', 'get', function($parameters = []) {
    var_dump($parameters);
    echo 'Admin page';
});

$router->checkRoutes();
