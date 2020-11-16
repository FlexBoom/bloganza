<?php declare(strict_types=1);

require('autoload.php');

$settings = require('Config/Settings.php');

$dsn = "mysql:host=".$settings['PDO']['host'].";dbname=".$settings['PDO']['dbname'].";charset=".$settings['PDO']['charset'];
$pdo = new PDO($dsn, $settings['PDO']['user'], $settings['PDO']['password'], $settings['PDO']['options']);

$db = new Bloganza\Adapters\PdoAdapter($pdo);
$mapper = new Bloganza\Mappers\Post($db);
$repository = new Bloganza\Repositories\Post($mapper);
$posts = new Bloganza\Services\Posts($repository);

$post = $posts->getPost(1);

var_dump($post);