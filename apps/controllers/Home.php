<?php
namespace App\Controller;
use Swoole;

class Home extends Swoole\Controller
{
    /*function __construct($swoole)
    {
        parent::__construct($swoole);
        Swoole::$php->session->start();
        Swoole\Auth::loginRequire();
    }*/

    function index()
    {
        echo __METHOD__;
    }
    function test()
    {
        var_dump(model('User')->get(1)->get());
    }

    /**
     * 设置favicon显示方法
     */
    function favicon()
    {
        $favicon = file_get_contents(WEBPATH.'/public/favicon.ico');
        $this->response->setHeader('Content-Type','image/jpeg');
        echo $favicon;
    }
}