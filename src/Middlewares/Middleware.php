<?php

namespace Tualo\Office\RequireJS\Middlewares;

use Tualo\Office\Basic\TualoApplication;
use Tualo\Office\Basic\IMiddleware;

class Middleware implements IMiddleware
{
    public static function register()
    {
        TualoApplication::use('require-js', function () {
            try {

                TualoApplication::javascript('require_js', './require-js/require.js', [], -5000000);
            } catch (\Exception $e) {
                TualoApplication::set('maintanceMode', 'on');
                TualoApplication::addError($e->getMessage());
            }
        }, -100); // should be one of the last
    }
}
