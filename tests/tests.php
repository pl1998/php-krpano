<?php
declare(strict_types=1);
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2023/7/22
 * Time : 09:56
 **/
require "../vendor/autoload.php";

// 切片存放的文件夹
$path = __DIR__.'/list/';

// 根据切片获取6张小图
$sixImage = (new \Panliang\PhpKrpano\Helpers\VrSliceToSixImg())->getSixImage($path);

// 设置CubeToSphere命令
$cmd = (new \Panliang\PhpKrpano\Command\CubeToSphere())
    ->setImageList($sixImage)
    ->setJpegQuality(90) //设置图片质量 0-100
//    ->setQuit() // 设置直接退出
//    ->setSize("1080x1090") //设置图片长宽
//    ->setJpegSubSamp() //设置图片颜色采样 444,420,420,411，default=444
//    ->setJpegOptimize()//是使用huffman算法压缩图片，true或false，default=true。
//    ->setTiffCompress()//设置TIFF压缩方法，none，lzw, zip或jpeg, default=lzw。
//        ->setTempDir("") // Set a custom directory for temporary files.
    ->setOutput(__DIR__."/origin90.jpg"); //输出指定图片

//切片合成全景图
$data =  (new \Panliang\PhpKrpano\ExecShell(
    (new \Panliang\PhpKrpano\KrpanoToolsScripts("/Users/panliang/Desktop/krpano-1.21/krpanotools"))
    ->setCmd($cmd)
))->exec()->echo();

var_dump($data);
