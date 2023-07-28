<?php
declare(strict_types=1);


namespace Panliang\PhpKrpano\Command;

trait CubeAndSphereInput
{
    /** @var int  Picture quality*/
    public $jpegQuality;

    /** @var int Picture color sampling */
    public $jpegSubSamp;

    /** @var bool Picture compression or not */
    public $jpegOptimize = false;

    /** @var string Set the TIFF compression method to none, lzw, zip or jpeg, default=lzw */
    public $tiffCompress;

    /** @var string Custom directory for temporary files. */
    public $tempDir;

    /** @var bool  work fast */
    public $isFast = false;

    /**
     * Set picture quality
     * @param int $num
     * @return $this
     */
    public function setJpegQuality(int $num): CubeToSphere
    {
        if(0<$num && $num<=100) {
            $this->jpegQuality = $num;
        }
        return $this;
    }

    /**
     *Set image color sampling
     * @param int $samp
     * @return $this
     */
    public function setJpegSubSamp(int $samp = 444): CubeToSphere
    {
        if(in_array($samp,[444, 420, 420, 41])) {
            $this->jpegSubSamp = $samp;
        }
        return $this;
    }

    /**
     * The huffman algorithm is used to compress images
     * @param bool $bool
     * @return $this
     */
    public function setJpegOptimize(bool $bool = true)
    {
        $this->jpegOptimize = $bool;
        return $this;
    }

    /**
     * Set the TIFF compression method, none, lzw, zip or jpeg, default=lzw.
     * @return $this
     */
    public function setTiffCompress(string $str = 'lzw')
    {
        $this->tiffCompress = $str;
        return $this;
    }

    /**
     * Set a custom directory for temporary files.
     * @param string $str
     * @return $this
     */
    public function setTempDir(string $str)
    {
        $this->tempDir = $str;
        return $this;
    }

    /**
     * Faster but lower-quality processing.
     * @param bool $fast
     * @return $this
     */
    public function fast(bool $fast)
    {
        $this->isFast = $fast;
        return $this;
    }


    /**
     * Quiet mode, no console output.
     * @param bool $bool
     * @return $this
     */
    public function quit(bool $bool = true): CubeToSphere
    {
        $this->isQuit = $bool;
        return $this;
    }

}