<?php
include_once '../Engine/Connect.php';

use lesson_4\Engine\Connect;

header('Content-type: json/application');

$sqlRequest = 'SELECT products.id, products.name, products.description, 
                                   products.price, photo.url_img FROM products JOIN photo 
                                   ON photo.product_id = products.id';

$connectBD = Connect::getConnectBase();
$arrayDataOnePage = $connectBD->dataPage($sqlRequest);

echo json_encode($arrayDataOnePage);
