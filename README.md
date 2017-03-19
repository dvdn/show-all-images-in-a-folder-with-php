Show all images in a folder with PHP
------------------------------------

A simple webpage to display all images in a folder with PHP.

This project is an evolution of https://github.com/lthr/show-all-images-in-a-folder-with-php.

It requires PHP.


Large images will be displayed smaller than their original dimensions. You can zoom large images by clicking on it.

You can link to a specific image as they're link anchored. Just click on the specific image and copy the browser URL.

You can use pagination and specify a number of images per pages.

See [Demo](http://dvdn.free.fr/show-all-images-in-folder/)

### Setup
#### The easy way
This works out of the box, so you can either [download the zip](https://github.com/dvdn/show-all-images-in-a-folder-with-php/archive/master.zip) or Git clone the repository.

#### The other way
Copy 'inc' folder [`inc`](https://github.com/dvdn/show-all-images-in-a-folder-with-php/blob/master/inc/) in your root folder (or wherever your index file is).

In your index page :

in the head

    <!-- style for images insertion -->
    <link rel="stylesheet" type="text/css" href="inc/ins-imgs.css">

in the body

    <!-- images insertion -->
    <?php include "ins-imgs.php"; ?>


### Settings
In [`Images.php`](https://github.com/dvdn/show-all-images-in-a-folder-with-php/blob/master/inc/Images.php#L20) you can find the following settings:

    *   folderPath : path to image folder,
    *   types : Supported images file types,
    *   sortByName : to sort by name. Default false, images will be sorted by date,
    *   orderByNewestImage : if sorted by date, orderer by newests images,
    *   lastModifiedDateFormat : date format in label (http://php.net/manual/en/function.date.php)
    *   pagination : [usePagination : true/false, imagesPerPage : number of images per pages]

Adapt values according to your needs.

### Help, bugs, pull requests, etc.
Very welcomed.

### Customized implementations
[Easy Folio](https://github.com/mikelothar/easy-folio)
