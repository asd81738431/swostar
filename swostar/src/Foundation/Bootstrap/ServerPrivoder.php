<?php
namespace SwoStar\Foundation\Bootstrap;

use SwoStar\Config\Config;
use SwoStar\Foundation\Application;

class ServerPrivoder
{
    public function bootstrap(Application $app){
        $priovders = $app->make('config')->get('app.priovders');

        dd($priovders,'注册的服务');

        //先执行register
        foreach ($priovders as $k => $priovder){
            (new $priovder($app))->register();
        }

        //后执行boot
        foreach ($priovders as $k => $priovder){
            (new $priovder($app))->boot();
        }
    }
}