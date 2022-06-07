<?php
define('PATINATION_COUNT', 10);
function get_folder()
{
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
};
