<?php
namespace SwoStar\Routes;

use SwoStar\Supper\ServerPriovder;

class RouteServerPriovder extends ServerPriovder
{
    public function boot()
    {
        dd('这里是route路由boot方法');
    }
}