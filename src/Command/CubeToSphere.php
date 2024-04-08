<?php
declare(strict_types=1);

namespace Panliang\PhpKrpano\Command;

use Panliang\PhpKrpano\Enum\CmdEnum;
use Panliang\PhpKrpano\Exception\KrpanoException;

class CubeToSphere extends KrpanoTools implements KrpanoToolsInterface
{
    /** @var string|null six img */
    protected ?string  $sixImageCmd = null;

    /** @var string|null  */
    protected ?string $baseCmd = CmdEnum::CUBE_TO_SPHERE;

    /** @var int|null  Picture quality*/
    protected ?int $jpegQuality = null;

    /** @var int|null Picture color sampling */
    protected ?int $jpegSubSamp = null;

    /** @var bool Picture compression or not */
    protected bool $jpegOptimize = false;

    /** @var string|null Set the TIFF compression method to none, lzw, zip or jpeg, default=lzw */
    protected ?string $tiffCompress = null;

    /** @var string|null Custom directory for temporary files. */
    protected ?string $tempDir = null;

    /** @var bool  work fast */
    protected bool $isFast = false;

    /**
     * Set 6 faces
     * @param array $list
     * @return $this
     * @throws KrpanoException
     */
    public function setImageList(array $list): CubeToSphere
    {
        $keys = array_keys($list);
        sort($keys);
        if(implode(',',$keys)!="b,d,f,l,r,u") {
            throw new KrpanoException("The images should have suffixes like _l, _f, _r, _b, _u, _d or names like left, front, right, back, up, down in their filenames to allow an automatic detection of the related cube-side.
Alternatively it would be possible specify the filesnames for the cubesides manually by using: -l=### -f=### -r=### -b=### -u=### -d=###.");
        }
        foreach ($keys as $v) {
            $this->sixImageCmd .= " -$v=$list[$v]";
        }
        return $this;
    }

    /**
     * Faster but lower-quality processing.
     * @param bool $fast
     * @return $this
     */
    public function fast(bool $fast) :CubeToSphere
    {
        $this->isFast = $fast;
        return $this;
    }

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
    public function setJpegOptimize(bool $bool = true) :CubeToSphere
    {
        $this->jpegOptimize = $bool;
        return $this;
    }

    /**
     * Set the TIFF compression method, none, lzw, zip or jpeg, default=lzw.
     * @return $this
     */
    public function setTiffCompress(string $str = 'lzw') :CubeToSphere
    {
        $this->tiffCompress = $str;
        return $this;
    }

    /**
     * Set a custom directory for temporary files.
     * @param string $str
     * @return $this
     */
    public function setTempDir(string $str) :CubeToSphere
    {
        $this->tempDir = $str;
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

    /**
     * export cmd
     * @return string
     * @throws KrpanoException
     */
    public function export() :string
    {
        if(!$this->sixImageCmd) {
            throw new KrpanoException("Please set up six cube panoramas .. function setImageList");
        }
        if(!$this->output) {
            throw new KrpanoException("Set the file output location");
        }
        $cmd = "$this->baseCmd $this->sixImageCmd";
        if($this->size) {
            $cmd .= " -size=$this->size";
        }
        if($this->jpegQuality) {
            $cmd .= " -jpegquality=$this->jpegQuality";
        }
        if($this->isFast) {
            $cmd .= " -fast";
        }
        if($this->jpegSubSamp) {
            $cmd .= " -jpegsubsamp=$this->jpegSubSamp";
        }
        if($this->jpegOptimize) {
            $cmd .= " -jpegoptimize=$this->jpegOptimize";
        }
        if($this->tiffCompress) {
            $cmd .= " -tiffcompress=$this->tiffCompress";
        }
        if($this->tempDir) {
            $cmd .= " -tempdir=$this->tempDir";
        }
        if($this->isQuit) {
            $cmd .= " -q";
        }
        $cmd .= " -o=$this->output";
        return $cmd;
    }
}
