<?php
namespace App\Controller;

use Swoole;

class Home extends Swoole\Controller
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
        /*Swoole::$php->session->start();
        Swoole\Auth::loginRequire();*/
    }

    public function index()
    {
        echo __METHOD__;
    }

    public function test()
    {
        $data = model('User')->get(1)->get();

        return json_encode($data);
    }

    /**
     * 设置favicon显示方法
     */
    public function favicon()
    {
        $favicon = file_get_contents(WEBPATH . '/public/favicon.ico');
        $this->response->setHeader('Content-Type', 'image/jpeg');
        echo $favicon;
    }
}
