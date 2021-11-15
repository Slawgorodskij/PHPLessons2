<?php
$connect_db = mysqli_connect(
    "localhost", "root", "", "VarTwig");
$sqlOnePage = 'SELECT media.filename, images_mini.url_img_mini, 
       images_big.url_img_big, images_big.size FROM media JOIN 
           images_mini ON images_mini.media_id = media.id JOIN 
           images_big ON images_big.media_id = media.id ORDER BY images_big.view_count DESC';
$resultOnePage = mysqli_query($connect_db, $sqlOnePage);


$arrayDataOnePage = array();
while ($row = mysqli_fetch_assoc($resultOnePage)) {
    $arrayDataOnePage[] = $row;
};


