<?php
declare(strict_types=1);

namespace Panliang\PhpKrpano\Command;

use Panliang\PhpKrpano\Enum\CmdEnum;
use Panliang\PhpKrpano\Exception\KrpanoException;

/**
 * docs https://krpano.com/docu/tools/#cubetosphere
 */
class CubeToSphere extends KrpanoTools implements KrpanoToolsInterface
{
    use CubeAndSphereInput;

    /** @var string six img */
    protected $sixImageCmd ;

    /** @var string  */
    protected $baseCmd = CmdEnum::CUBE_TO_SPHERE;

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
