<?php

/**
* Images management class
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

class Images {

    public function __construct() {
        $this->folderPath = "imgs/";
        $this->types = "{*.jpg,*.JPG,*.jpeg,*.JPEG,*.png,*.PNG,*.gif,*.GIF}";
        $this->sortByName = false;
        $this->orderByNewestImage = true;
        $this->lastModifiedDateFormat = "F d Y"; //"F d Y H:i:s"
        $this->pagination = array (
                    "usePagination" => false,
                    "imagesPerPage" => 5
                    );
        # Images array list generation
        $this->imagesList = glob($this->folderPath.$this->types, GLOB_BRACE);

    }

    /**
     *
     * Sort images list
     *
     * @param    array $imagesList to sort
     * @return    array $sortedImages
     *
     */
    public function sortImagesList(Array $imagesList){
        $sortedImages = array();
        # check sort by name or by date
        if ($this->sortByName) {
            $sortedImages = $imagesList;
            natsort($sortedImages);
        } else {
            # sort by 'last modified' timestamp
            $count = count($imagesList);
            for ($i = 0; $i < $count; $i++) {
                $sortedImages[date('YmdHis', filemtime($imagesList[$i])) . $i] = $imagesList[$i];
            }
            if ($this->orderByNewestImage) {
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
    public function renderImagesHtml(Array $imagesList) {
        foreach ($imagesList as $image) {
            $this->renderImageHtml($image);
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
    private function renderImageHtml($image) {
        # Get image name without path and extension
        $imageName = basename($image);
        $imageName = pathinfo($imageName, PATHINFO_FILENAME);

        # Get 'last modified' date
        $lastModifiedDate = date($this->lastModifiedDateFormat, filemtime($image));

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

}


