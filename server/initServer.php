<?php
/**
 * 初始化文件
 */
define('DEBUG', 'on');
define('DS', DIRECTORY_SEPARATOR);
define('WEBPATH', __DIR__ . DS . '..');

//载入swoole frameworkZ框架配置
require_once WEBPATH . '/libs/lib_config.php';