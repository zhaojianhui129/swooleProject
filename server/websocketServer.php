<?php
//载入初始化文件
require_once __DIR__ . '/initServer.php';

class WebSocket extends Swoole\Protocol\WebSocket
{
    protected $message;

    /**
     * @param     $serv swoole_server
     * @param int $worker_id
     */
    function onStart($serv, $worker_id = 0)
    {
        Swoole::$php->router([$this, 'router']);
        parent::onStart($serv, $worker_id);
    }

    function router()
    {
        //var_dump($this->message);
        return array('controller' => 'Home', 'view' => 'test');
    }

    /**
     * 进入
     * @param $client_id
     */
    function onEnter($client_id)
    {

    }

    /**
     * 下线时，通知所有人
     */
    function onExit($client_id)
    {
        //将下线消息发送给所有人
        $this->log("onOffline: " . $client_id);
        $this->broadcast($client_id, "onOffline: " . $client_id);
    }

    function onMessage($client_id, $ws)
    {
        $this->log("onMessage: " . $client_id . ' = ' . $ws['message']);

        $this->message = $ws['message'];
        $response = Swoole::$php->runMVC();

        $this->send($client_id, $response);
        //$this->broadcast($client_id, $ws['message']);
    }

    /**
     * 接收到消息时
     */
    function onMessage2($client_id, $ws)
    {
        $this->log("onMessage: " . $client_id . ' = ' . $ws['message']);
        $this->send($client_id, 'Server: ' . $ws['message']);
        //$this->broadcast($client_id, $ws['message']);
    }

    function broadcast($client_id, $msg)
    {
        foreach ($this->connections as $clid => $info) {
            if ($client_id != $clid) {
                $this->send($clid, $msg);
            }
        }
    }
}

//require __DIR__'/phar://swoole.phar';
Swoole\Config::$debug = true;
//设置PID文件的存储路径
Swoole\Network\Server::setPidFile(WEBPATH . '/server/websocketServer.pid');
Swoole\Error::$echo_html = false;
/**
 * 显示Usage界面
 * php app_server.php start|stop|reload
 */
Swoole\Network\Server::start(function () {
    $AppSvr = new WebSocket();
    $AppSvr->loadSetting(__DIR__ . "/swoole.ini"); //加载配置文件
    $AppSvr->setLogger(new \Swoole\Log\EchoLog(true)); //Logger
    $AppSvr->setAppPath(WEBPATH . '/apps/');
    $AppSvr->setDocumentRoot(WEBPATH . '/public/');

    /**
     * 如果你没有安装swoole扩展，这里还可选择
     * BlockTCP 阻塞的TCP，支持windows平台
     * SelectTCP 使用select做事件循环，支持windows平台
     * EventTCP 使用libevent，需要安装libevent扩展
     */
    $enable_ssl = false;
    $server = Swoole\Network\Server::autoCreate('0.0.0.0', 9443, $enable_ssl);
    $server->setProtocol($AppSvr);
    //$server->daemonize(); //作为守护进程
    $server->run([
        'worker_num'    => 1,
        'ssl_key_file'  => __DIR__ . '/ssl/ssl.key',
        'ssl_cert_file' => __DIR__ . '/ssl/ssl.crt',
        //'max_request' => 1000,
        //'ipc_mode' => 2,
        //'heartbeat_check_interval' => 40,
        //'heartbeat_idle_time' => 60,
    ]);
});

