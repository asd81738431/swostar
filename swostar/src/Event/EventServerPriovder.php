<?php
namespace SwoStar\Event;

use SwoStar\Supper\ServerPriovder;

class EventServerPriovder extends ServerPriovder
{
    public function boot()
    {
        dd('这里是event路由boot方法');
    }
}