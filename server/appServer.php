<?php
require_once 'initServer.php';

//设置PID文件的存储路径
Swoole\Network\Server::setPidFile(__DIR__ . '/appServer.pid');
/**
 * 显示Usage界面
 * php app_server.php start|stop|reload
 */
Swoole\Network\Server::start(function () {
    $server = Swoole\Protocol\WebServer::create(__DIR__ . '/swoole.ini');
    //设置应用所在的目录
    $server->setAppPath(WEBPATH . '/apps/');
    //设置应用所在的目录
    $server->setDocumentRoot(WEBPATH . '/public/');
    //Logger
    $server->setLogger(new \Swoole\Log\EchoLog(WEBPATH . "/logs/webserver.logs"));
    //作为守护进程
    //$server->daemonize();
    //启动
    $server->run(['worker_num' => 1, 'max_request' => 5000, 'log_file' => WEBPATH.'/logs/swoole.logs']);
});