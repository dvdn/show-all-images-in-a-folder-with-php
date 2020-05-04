Show all images in a folder with PHP
------------------------------------

A simple webpage to display all images in a folder with PHP.

It requires PHP.

Large images will be displayed smaller than their original dimensions. You can zoom by clicking on it.

Share a link to a specific image with it's anchor. Just click on it and copy the browser URL.

You can specify a number of images displayed per pages.

See [Demo](http://dvdn.online.fr/show-all-images-in-folder/)

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
In [`Images.php`](https://github.com/dvdn/show-all-images-in-a-folder-with-php/blob/master/inc/Images.php#L20) you can adjust the following settings:

    *   folderPath : path to image folder,
    *   types : which images file types will be displayed,
    *   sortByName : to sort by name. Default false, images will be sorted by last modified date,
    *   reverseOrder : to invert sort order, if 'true'
    *                   if sorted by date, ordered by newests images (uses EXIF data if possible),
    *                   if sorted by name order is naturally inverted,
    *   dateFormat : date format in label (http://php.net/manual/en/function.date.php)
    *   pagination : [usePagination : true/false, imagesPerPage : number of images per pages]

Adapt values according to your needs.

### Forked
This project is an evolution of https://github.com/lthr/show-all-images-in-a-folder-with-php.

I forked as my old pull request in original repository eventually died unmerged without any comment :/ .

Features addition :
- pagination
- image date from EXIF metadata

### Contributions
Very welcomed.
