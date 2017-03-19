<?php
require_once "Pagination.php";

/**
*
* Images management
*
* Configuration :
*   folderPath : path to image folder,
*   types : Supported images file types,
*   sortByName : to sort by name. Default false, images will be sorted by date,
*   orderByNewestImage : if sorted by date, orderer by newests images,
*   lastModifiedDateFormat : date format in label (http://php.net/manual/en/function.date.php)
*   pagination : [usePagination : true/false, imagesPerPage : number of images per pages]
*
*/

$imagesConfig = array(
    "folderPath" => "imgs/",
    "types" => "{*.jpg,*.JPG,*.jpeg,*.JPEG,*.png,*.PNG,*.gif,*.GIF}",
    "sortByName" => false,
    "orderByNewestImage" => true,
    "lastModifiedDateFormat" => "F d Y", //"F d Y H:i:s"
    "pagination" => array (
            "usePagination" => false,
            "imagesPerPage" => 7
            )
);

# Images array list generation
$images = glob($GLOBALS['imagesConfig']['folderPath'].$GLOBALS['imagesConfig']['types'], GLOB_BRACE);

/**
 *
 * Sort images list
 *
 * @param    array $imagesList to sort
 * @return    array $sortedImages
 *
 */
function sortImagesList(Array $imagesList){
    $sortedImages = array();
    # check sort by name or by date
    if ($GLOBALS['imagesConfig']['sortByName']) {
        $sortedImages = $imagesList;
        natsort($sortedImages);
    } else {
        # sort by 'last modified' timestamp
        $count = count($imagesList);
        for ($i = 0; $i < $count; $i++) {
            $sortedImages[date('YmdHis', filemtime($imagesList[$i])) . $i] = $imagesList[$i];
        }
        if ($GLOBALS['imagesConfig']['orderByNewestImage']) {
            krsort($sortedImages);
        } else {
            ksort($sortedImages);
        }
    }
    return $sortedImages;
}

/**
 *
 * Html images list rendering
 *
 * @param    array $imagesList to render
 * @return    void, echoes Html
 *
 */
function renderImagesHtml(Array $imagesList) {
    foreach ($imagesList as $image) {
        renderImageHtml($image);
    }
}

/**
 *
 * Html image rendering
 *
 * @param    string $image to render
 * @return    void, echoes Html
 *
 */
function renderImageHtml($image) {
    # Get image name without path and extension
    $imageName = basename($image);
    $imageName = pathinfo($imageName, PATHINFO_FILENAME);

    # Get 'last modified' date
    $lastModifiedDate = date($GLOBALS['imagesConfig']['lastModifiedDateFormat'], filemtime($image));

    $imageLabel = 'Image name: ' . $imageName;
    $lastModifiedLabel = '(last modified: ' . $lastModifiedDate . ')';
    $label = $imageLabel.' '.$lastModifiedLabel;

    # Begin addition
    echo <<<EOT
    <li class="ins-imgs-li">
        <div class="ins-imgs-img" onclick=this.classList.toggle("zoom");>
            <a name="$image" href="#$image ">
                <img src="$image" alt="$imageName" title="$imageName">
            </a>
        </div>
        <div class="ins-imgs-label">$label</div>
    </li>
EOT;
}

// sort images
$images = sortImagesList($images);
$htmlPagination = false;

// pagination
if ($GLOBALS['imagesConfig']['pagination']['usePagination']) {
    $Pagination  = new Pagination($images);
    $pageNumber = 1;
    if (isset($_GET['page']) && is_numeric($_GET['page']) && ($_GET['page'] > 0)) {
        $pageNumber = (int) $_GET['page'];
    }
    $imagesToDisplay = $Pagination->getPageData($images, $GLOBALS['imagesConfig']['pagination']['imagesPerPage'], $pageNumber);
    $htmlPagination = $Pagination->renderPaginationHtml($pageNumber);
} else {
    $imagesToDisplay = $images;
}

# Action render images list with style
echo('<link rel="stylesheet" type="text/css" href="inc/ins-imgs.css">');
echo('<ul class="ins-imgs">');
renderImagesHtml($imagesToDisplay);
echo('</ul>');
echo $htmlPagination;

?>
