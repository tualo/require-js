<?php

namespace Tualo\Office\RequireJS\Routes;

use Tualo\Office\Basic\TualoApplication;
use Tualo\Office\Basic\Route as R;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Basic\RouteSecurityHelper;


class Route extends \Tualo\Office\Basic\RouteWrapper
{
    public static function register()
    {

        R::add('/require-js/(?P<file>[\/.\w\d\-]+).js', function ($matches) {
            RouteSecurityHelper::serveSecureStaticFile(
                $matches['file'] . '.js',
                dirname(__DIR__, 1) . '/js/',
                ['js'],
                ['js' => 'application/javascript']
            );

            return;
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
