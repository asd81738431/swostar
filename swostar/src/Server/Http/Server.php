<?php
namespace SwoStar\Server\Http;

use SwoStar\Console\Input;
use SwoStar\Server\ServerBase;

class Server extends ServerBase{

    protected function createServer()
    {
        $this->server = new \Swoole\Http\Server($this->host,$this->port);

        Input::info(swoole_get_local_ip()['enp3s0'].":".$this->port,'访问地址');
    }

    protected function initServerSet()
    {

    }

    protected function initEvent()
    {
        $this->setEvent('sub',[
            'request' => 'onRequest'
        ]);
    }

    public function onRequest($request,$response)
    {
        dd(app('config')->get('app'),'获取到配置');
        dd('http服务编辑ok');
    }
}