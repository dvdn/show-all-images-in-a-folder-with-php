<?php
require_once "Images.php";
require_once "Pagination.php";

/**
*
* Images treatment
*
*/

$Images  = new Images();
$imagesList = $Images->sortImagesList($Images->imagesList);
$dataToDisplay = $Images->managePagination($imagesList);


// Action render images list with style
echo('<link rel="stylesheet" type="text/css" href="inc/ins-imgs.css">');
echo('<ul class="ins-imgs">');
    $Images->renderImagesHtml($dataToDisplay["imagesToDisplay"]);
echo('</ul>');
echo $dataToDisplay["htmlPagination"];

?>
