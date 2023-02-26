<?php

// add helper file to composer file in 'autoload' add the kay name is 'files' and value is ["app/Helper/global.php"]

//active('categories');
//active('categories', 'menu-open');
//active('categories.index');
//active('categories.index', 'custom-class');

function active($path = '', $class = 'active') {
    if(str_contains($path, '.')) {
        return request()->routeIs($path) ? $class : "";
    }
    return str_contains(request()->url(), $path) ? $class : "";
}
