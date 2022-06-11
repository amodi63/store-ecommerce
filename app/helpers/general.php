<?php
define('PATINATION_COUNT', 10);
function get_folder()
{
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
};
function uplodeImage($folder, $image)
{
    $image->store('/', $folder);
    $fileName = $image->hashName();
    $path = 'images/' . $folder . '/' . $fileName;
    return $fileName;

}
