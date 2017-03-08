<?php
/**
 * 配置文件：apps/configs/event.php
 * 事件列表：apps/events/*.php
 * 具体事件处理代码：apps/classes/Handler/*.php
 */
//初始化文件
define('DEBUG', 'on');
define('DS', DIRECTORY_SEPARATOR);
//设置当前web目录
define('WEBPATH', __DIR__ . DS . '..');
//设置APP目录
define('APPSPATH', WEBPATH .'/apps');
//使用composer扩展
require_once WEBPATH . '/vendor/autoload.php';
//载入swoole frameworkZ框架配置
require_once WEBPATH . '/vendor/matyhtf/swoole_framework/libs/lib_config.php';
//执行脚本
//Swoole::$php->redis->append('hello', json_encode(['data'=>['name'=>'赵建辉','sex'=>'男']]));
Swoole::$php->loadModule('queue')->pop(['data'=>['name'=>'赵建辉','sex'=>'男']]);
//Swoole::$php->queue->pop(['data'=>['name'=>'赵建辉','sex'=>'男']]);
//var_dump(Swoole::$php->redis->keys('*'));