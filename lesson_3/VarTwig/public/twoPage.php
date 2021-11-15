<?php

include_once '../engine/dataBase.php';

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use \Twig\Loader\FilesystemLoader;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$loader = new FilesystemLoader(dirname(__DIR__) . '/templates');

$twig = new Environment($loader, [
    'cache' => dirname(__DIR__) . '/cache',
]);


$connect_db = mysqli_connect(
    "localhost", "root", "", "VarTwig");

$sqlTwoPage = 'SELECT media.filename, images_mini.url_img_mini, images_big.url_img_big, images_big.size FROM media JOIN images_mini ON images_mini.media_id = media.id JOIN images_big ON images_big.media_id = media.id ORDER BY RAND() LIMIT 3';


$resultTwoPage = mysqli_query($connect_db, $sqlTwoPage);

$arrayDataTwoPage = array();
while ($row = mysqli_fetch_assoc($resultTwoPage)) {
    $arrayDataTwoPage[] = $row;
};

$photo = stripcslashes($_GET['photo']);

mysqli_query($connect_db, "UPDATE images_big SET view_count = view_count + 1  WHERE url_img_big = '$photo';");

$countView = mysqli_fetch_assoc(mysqli_query($connect_db, "SELECT view_count  FROM images_big  WHERE url_img_big = '$photo';"));

try {
    echo $twig->render('twoPage.twig', [
        'arrayData' => $arrayDataTwoPage,
        'photo' => $photo,
        'countView' => $countView]);
} catch (LoaderError | RuntimeError | SyntaxError $error) {
    echo $error;
}