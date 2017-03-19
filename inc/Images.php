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

}


