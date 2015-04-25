<?php


function dd() {
    echo "<pre>";
    foreach(func_get_args() as $param)
        var_dump($param);
    exit;
}