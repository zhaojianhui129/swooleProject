<?php
/**
 * 初始化文件
 */
define('DEBUG', 'on');
define('DS', DIRECTORY_SEPARATOR);
define('WEBPATH', __DIR__ . DS . '..');

//载入composer自加载文件
require_once WEBPATH . '/vendor/autoload.php';
//载入框架配置
require WEBPATH . '/vendor/matyhtf/swoole_framework/libs/lib_config.php';