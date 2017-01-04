<?php
$log['master'] = array(
    'type' => 'FileLog',
    'file' => WEBPATH . '/logs/app.logs',
);

$log['test'] = array(
    'type' => 'FileLog',
    'file' => WEBPATH . '/logs/test.logs',
);

return $log;