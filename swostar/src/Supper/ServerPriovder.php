<?php
namespace SwoStar\Supper;

use SwoStar\Foundation\Application;

abstract class ServerPriovder
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function register()
    {

    }

    abstract public function boot();
}