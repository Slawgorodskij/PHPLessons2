<?php
include_once '../Engine/Connect.php';

use lesson_4\Engine\Connect;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;


require_once dirname(__DIR__) . '/vendor/autoload.php';

$loader = new FilesystemLoader(dirname(__DIR__) . '/templates');

$twig = new Environment($loader, [
    'cache' => dirname(__DIR__) . '/cache',
]);

$sqlRequest = 'SELECT products.id, products.name, products.description, 
                                   products.price, photo.url_img FROM products JOIN photo 
                                   ON photo.product_id = products.id LIMIT 3';

$connectBD = Connect::getConnectBase();
$arrayDataOnePage = $connectBD->dataPage($sqlRequest);

try {
    echo $twig->render('index.twig', [
        'title' => 'Домашнее задание 4 урока',
        'arrayData' => $arrayDataOnePage]);
} catch (LoaderError | RuntimeError | SyntaxError $error) {
    echo $error;
}
