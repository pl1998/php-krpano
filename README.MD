#### PHP Krpano 工具包

> 集成krpanotools工具命令，不用看官方文档。即可使用的工具包几行代码搞定`krpanotools`搞定生涩的命令。

#### krpano Tools (Command-Line) 说明
 > krpanotools应用程序提供以下功能:
 * [makepano](/tests/make_pano_test.php) - 制作一个基于模板的全景图或全景图。
 * maketiles - 制作或合并平铺图像。也可用于转换和调整大小。
 * convert - 转换或调整图像大小。
 * makepreview - 制作平滑的全景预览图像。
 * spheretocube - 将球面图像转换为立方体全景图像。
 * [cubetosphere](tests/make_pano_test.php) - 将立方体图像转换为球形全景图像。
 * protect - 创建具有自定义保护设置的查看器文件。
 * encrypt - 加密文件。
 * testserver - krpano测试服务器。
 * register -License注册工具。

#### 安装
```shell
composer require pl1998/php-krpano
```

#### `makepano`命令 全景图片生成全景图
```php
<?php
require "vendor/autoload.php";

$pkgPath = "/Users/panliang/Desktop/krpano-1.21/";

$filePath = __DIR__.'/vr/99999';

$cmd = (new \Panliang\PhpKrpano\Command\MakePano())
    ->setConfig("{$pkgPath}templates/vtour-multires.config") //设置配置文件
    ->setTilePath("{$filePath}/vtour/list/l%Al[_c]_%Av_%Ah.jpg") //设置切片规则
//    ->setThumbPath("{$filePath}/thumb.jpg") //设置主题图生成路径
//    ->setXmlPath("{$filePath}/tour.xml") // 设置xml文件生成路径
    ->setPreviewPath("{$filePath}/vtour/list/preview.jpg") //设置预览图生成路径
    ->setTempCubePath("{$filePath}/tempcubepath")
    ->setThumbSize(430) // 设置主题图尺寸
    ->setImgPath(__DIR__."/origin90.jpg") //需要生成的全景球面图路径
    ->setOutput($filePath."/vtour"); //生成目录

//生成vr作品
$data =  (new \Panliang\PhpKrpano\ExecShell(
    (new \Panliang\PhpKrpano\KrpanoToolsScripts("$pkgPath/krpanotools"))
        ->setCmd($cmd)
))->exec()->echo();

var_dump($data);

```

#### `cubetosphere` 命令 demo 根据切片还原全景图
```PHP
<?php

require "vendor/autoload.php";
// 命令路径
$pkgPath = "/Users/panliang/Desktop/krpano-1.21/";

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
//        ->setTempDir("") // 为临时文件设置自定义目录。
    ->setOutput(__DIR__."/origin90.jpg"); //输出指定图片

//切片合成全景图
$data =  (new \Panliang\PhpKrpano\ExecShell(
    (new \Panliang\PhpKrpano\KrpanoToolsScripts("{$pkgPath}krpanotools"))
        ->setCmd($cmd)
))->exec()->echo();

var_dump($data);


```
