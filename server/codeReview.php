<?php
//代码审计方法
$currentFile = 'testClass.php';
//$currentFile = '../apps/controllers/Home.php';
require_once $currentFile;
$currentFileContent = trim(file_get_contents($currentFile));
Reflection::export();
preg_match_all('~^\s*(?:abstract\s+|final\s+)?(?:class|interface)\s+(\w+)(\s+(extends|implements)\s+(\w+))?\s*{~mi', $currentFileContent, $classes);
foreach ($classes[1] as $key => $class) {
    echo "====================class========================\r\n";
    $rc = new ReflectionClass($class);
    $methods = $rc->getMethods();
    foreach ($methods as $method){
        echo "======================method=========================\r\n";
        $rm = new ReflectionMethod($method->class, $method->name);
        $doc = $rm->getDocComment();
        $matchDoc = [];
        preg_match_all("#\\r\\n#", $doc, $matchDoc);
        var_dump($rm->getDocComment(), count($matchDoc[0]) + 1);
    }
    var_dump($rc->getMethods());
}
var_dump($classes[1]);