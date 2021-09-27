<?php
namespace SwoStar\Server;

use SwoStar\Foundation\Application;

abstract class ServerBase
{
    protected $app;

    protected $server;

    protected $host = '0.0.0.0';

    protected $port = 9500;

    protected $serverConfig = [
        'task_worker_num' => 0
    ];

    protected $serverEvent = [
        "server" => [//有swoole本身的事件(必须会执行的事件，如onStart,onShutdown,onWorkerStart等等)
            'start' => 'onStart'
        ],
        'sub' => [],//http - websocket 记录明确swoole服务独有的事件(如websocket的onOpen与tcp的onOpen等)
        'ext' => [],//根据用户扩展task事件
    ];

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->initServerSet();#初始化服务设置
        $this->createServer();#创建服务, 不同的服务构建不一样
        $this->initEvent();#初始化事件
        $this->setSwooleEvent();#设置swoole的回调事件
    }

    abstract protected function initServerSet();

    abstract protected function createServer();

    abstract protected function initEvent();

    public function onStart($server){}

    protected function setSwooleEvent(){
        foreach ($this->serverEvent as $type => $events){
            foreach ($events as $event => $func){
                $this->server->on($event,[$this,$func]);
            }
        }
    }

    public function start(){
        $this->server->set($this->serverConfig);

        $this->server->start();
    }

    public function setEvent($type,$event){
        if($type == "server"){
            return;
        }
        $this->serverEvent[$type] = $event;
    }
}