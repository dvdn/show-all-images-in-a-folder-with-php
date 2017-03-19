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
$htmlPagination = false;

// pagination
if ($Images->pagination['usePagination']) {
    $Pagination  = new Pagination($imagesList);
    $pageNumber = 1;
    if (isset($_GET['page']) && is_numeric($_GET['page']) && ($_GET['page'] > 0)) {
        $pageNumber = (int) $_GET['page'];
    }
    $imagesToDisplay = $Pagination->getPageData($imagesList, $Images->pagination['imagesPerPage'], $pageNumber);
    $htmlPagination = $Pagination->renderPaginationHtml($pageNumber);
} else {
    $imagesToDisplay = $imagesList;
}

// Action render images list with style
echo('<link rel="stylesheet" type="text/css" href="inc/ins-imgs.css">');
echo('<ul class="ins-imgs">');
    $Images->renderImagesHtml($imagesToDisplay);
echo('</ul>');
echo $htmlPagination;

?>
