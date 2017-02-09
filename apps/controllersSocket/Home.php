<?php
namespace App\ControllerSocket;

use Swoole;
class Home extends Swoole\Controller
{
    function index()
    {
        return [];
    }
    function test()
    {
        $data = model('User')->get(1)->get();
        return $data;
    }
}