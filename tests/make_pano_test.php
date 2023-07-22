<?php
declare(strict_types=1);
require "../vendor/autoload.php";

$pkgPath = "/Users/panliang/Desktop/krpano-1.21/";

$filePath = __DIR__.'/vr/99999';

$cmd = (new \Panliang\PhpKrpano\Command\MakePano())
    ->setConfig("{$pkgPath}templates/vtour-multires.config") //设置配置文件
    ->setTilePath("{$filePath}/vtour/list/l%Al[_c]_%Av_%Ah.jpg")
//    ->setThumbPath("{$filePath}/thumb.jpg")
//    ->setXmlPath("{$filePath}/tour.xml")
    ->setPreviewPath("{$filePath}/vtour/list/preview.jpg")
    ->setTempCubePath("{$filePath}/tempcubepath")
    ->setThumbSize(430)
    ->setImgPath(__DIR__."/origin90.jpg")
    ->setOutput($filePath."/vtour");


//生成vr作品
$data =  (new \Panliang\PhpKrpano\ExecShell(
    (new \Panliang\PhpKrpano\KrpanoToolsScripts("$pkgPath/krpanotools"))
        ->setCmd($cmd)
))->exec()->echo();

var_dump($data);
