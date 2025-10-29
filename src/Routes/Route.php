<?php

namespace Tualo\Office\RequireJS\Routes;

use Tualo\Office\Basic\TualoApplication;
use Tualo\Office\Basic\Route as R;
use Tualo\Office\Basic\IRoute;


class Route extends \Tualo\Office\Basic\RouteWrapper
{
    public static function register()
    {

        R::add('/require-js/(?P<file>[\/.\w\d\-]+)', function ($matches) {
            if (file_exists(dirname(__DIR__, 2) . '/src/js/' . $matches['file'] . '')) {
                $path_parts = pathinfo(dirname(__DIR__, 2) . '/src/js/' . $matches['file'] . '');
                if ($path_parts['extension'] == 'js')   TualoApplication::contenttype('application/javascript');
                if ($path_parts['extension'] == 'css')   TualoApplication::contenttype('text/css');
                TualoApplication::etagFile((dirname(__DIR__, 2) . '/src/js/' . $matches['file'] . ''));
            } else {
                TualoApplication::body("// hm, something is wrong " . $matches['file']);
            }
        }, array('get', 'post'), false);
    }
}
