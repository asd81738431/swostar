<?php
namespace SwoStar\Foundation;

use SwoStar\Console\Input;
use SwoStar\Container\Container;

class Application extends Container
{
    protected $basePath = '';

    protected $bootstraps = [
        Bootstrap\LoadConfiguration::class,
        Bootstrap\ServerPrivoder::class
    ];

    public function __construct($path)
    {
        if(!empty($path)){
            $this->setBasePath($path);
        }

        #设置自己为单例容器
        self::setInstance($this);

        #加载框架驱动
        $this->bootstrap();

        Input::info('-----启动项目-----');
    }

    public function bootstrap(){
        foreach ($this->bootstraps as $k => $bootstrap){
            (new $bootstrap())->bootstrap($this);
        }
    }

    public function run($argv){
        $server = null;
        switch ($argv[1]){
            case 'http:start':
                $server = new \SwoStar\Server\Http\Server($this);
                break;

            default:
                Input::info('-----找不到服务-----');
                die();
                break;
        }

        $server->start();
    }

    public function getConfigPath(){
        return $this->getBasePath()."/config";
    }

    public function setBasePath($path){
        $this->basePath = rtrim($path,'\/');
    }

    public function getBasePath(){
        return $this->basePath;
    }
}