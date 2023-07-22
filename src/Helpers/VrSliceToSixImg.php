<?php
declare(strict_types=1);
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2023/7/22
 * Time : 11:28
 **/

namespace Panliang\PhpKrpano\Helpers;

class VrSliceToSixImg
{
    /**
     * 根据切片算法合成6位面小图
     * @param string $path
     * @return array
     */
    public function getSixImage(string $path) :array
    {
        $surface  = array('l', 'r', 'u', 'b', 'f', 'd');
        $sixImage = [];
        foreach ($surface as $v) {
            $outputImagePath = $path.$v.'.jpg';
            if(file_exists($outputImagePath)) {
                $sixImage[$v] = $outputImagePath;
                continue;
            }
            $list_slice[$v][]=sprintf($path."l1_%s_%s_%s.jpg",$v,1,1);
            $list_slice[$v][]=sprintf($path."l1_%s_%s_%s.jpg",$v,1,2);
            $list_slice[$v][]=sprintf($path."l1_%s_%s_%s.jpg",$v,2,1);
            $list_slice[$v][]=sprintf($path."l1_%s_%s_%s.jpg",$v,2,2);
            // 根据拼接逻辑
            // 1-1 1-2
            // 2-1 2-2
            // 计算图片长 宽
            [$w0,$h0] = getimagesize($list_slice[$v][0]);
            [$w1,$h1] = getimagesize($list_slice[$v][1]);
            [$w2,$h2] = getimagesize($list_slice[$v][2]);
            $imageWidth = $w0+$w1;
            $imageHeight = $h0+$h2;
            $canvas = imagecreatetruecolor($imageWidth,$imageHeight);
            $backgroundColor = imagecolorallocate($canvas, 255, 255, 255);
            imagefill($canvas, 0, 0, $backgroundColor);

            $imagePositions= [
                [0, 0],  // 图片1的位置
                [$w0, 0],  // 图片2的位置
                [0, $w0],  // 图片3的位置
                [$h1,$w2],  // 图片4的位置
            ];
            $imagePaths = $list_slice[$v];
            foreach ($imagePaths as $index => $imagePath) {
                $image = imagecreatefromjpeg($imagePath);
                $position = $imagePositions[$index];
                imagecopy($canvas, $image, $position[0], $position[1], 0, 0, $imageWidth, $imageHeight);
                imagedestroy($image);
            }
            imagejpeg($canvas, $outputImagePath);
            imagedestroy($canvas);
            $sixImage[$v] = $outputImagePath;
        }
        return $sixImage;
    }
}
