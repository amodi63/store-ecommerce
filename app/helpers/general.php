<?php
function get_folder()
{
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
};
