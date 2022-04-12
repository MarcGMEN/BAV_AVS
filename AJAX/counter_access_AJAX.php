<?php


function return_countByPage()
{
    extract($GLOBALS);
    return countByPage($INFO_APPLI['numero_bav']);
}


function return_byTree()
{
    extract($GLOBALS);
    return getByTree($INFO_APPLI['numero_bav']);
}
