<?php
declare(strict_types=1);
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2023/7/22
 * Time : 12:42
 **/

namespace Panliang\PhpKrpano\Command;

use Panliang\PhpKrpano\Enum\CmdEnum;
use Panliang\PhpKrpano\Exception\KrpanoException;

class MakePano extends KrpanoTools implements KrpanoToolsInterface
{
    /** @var string|null */
    protected ?string $config = null;

    /** @var string|null */
    protected ?string $tilePath= null;

    /** @var string|null */
    protected ?string $thumbPath= null;

    /** @var string|null */
    protected ?string $xmlPath= null;

    /** @var string|null */
    protected ?string $previewPath= null;

    /** @var string|null */
    protected ?string $tempCubePath= null;

    /** @var int|null */
    protected ?int $thumbSize = null;

    /** @var string|null */
    protected ?string  $imgPath = null;

    /** @var string|null */
    protected ?string  $levels = null;

    /**
     * @var string|null
     */
    protected ?string  $maxsize = null;

    /**
     * @param string $config
     * @return $this
     */
    public function setConfig(string $config): MakePano
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @param string|null $size
     * @return $this
     */
    public function setMaxSize(string|null $size): MakePano
    {
        $this->maxsize = $size;
        return $this;
    }


    /**
     * @param string $levels
     * @return $this
     */
    public function setLevels(string $levels): MakePano
    {
        $this->levels = $levels;
        return $this;
    }

    /**
     * @param $tilePath
     * @return $this
     */
    public function setTilePath($tilePath): MakePano
    {
        $this->tilePath = $tilePath;
        return $this;
    }

    /**
     * @param string $thumbPath
     * @return $this
     */
    public function setThumbPath(string $thumbPath): MakePano
    {
        $this->thumbPath = $thumbPath;
        return $this;
    }

    /**
     * @param string $xmlPath
     * @return $this
     */
    public function setXmlPath(string $xmlPath): MakePano
    {
        $this->xmlPath = $xmlPath;
        return $this;
    }

    /**
     * @param string $previewPath
     * @return $this
     */
    public function setPreviewPath(string $previewPath): MakePano
    {
        $this->previewPath = $previewPath;
        return $this;
    }

    /**
     * @param string $tempCubePath
     * @return $this
     */
    public function setTempCubePath(string $tempCubePath): MakePano
    {
        $this->tempCubePath = $tempCubePath;
        return $this;
    }

    /**
     * @param int $thumbSize
     * @return $this
     */
    public function setThumbSize(int $thumbSize = 420): MakePano
    {
        $this->thumbSize = $thumbSize;
        return $this;
    }

    /**
     * @param string $imgPath
     * @return $this
     * @throws KrpanoException
     */
    public function setImgPath(string $imgPath): MakePano
    {
        if(!file_exists($imgPath)) {
            throw new KrpanoException("imgPath File does not exist");
        }
        $this->imgPath = $imgPath;
        return $this;
    }


    /**
     * @return string
     * @throws KrpanoException
     */
    public function export() :string
    {
        if(!$this->config)    throw new KrpanoException("Please select Config- position:/templates/*.config");
        if(!$this->imgPath)   throw new KrpanoException("Please select Image Path");
        $cmd = CmdEnum::MAKE_PANO."  -config=$this->config";
        if($this->tilePath)        $cmd .=" -tilepath=$this->tilePath";
        if($this->thumbPath)       $cmd .=" -thumbpath=$this->thumbPath";
        if($this->thumbSize)       $cmd .=" -thumbsize=$this->thumbSize";
        if($this->xmlPath)         $cmd .=" -xmlpath=$this->xmlPath";
        if($this->previewPath)     $cmd .=" -previewpath=$this->previewPath";
        if($this->levels)          $cmd .=" -levels=$this->levels";
        if($this->maxsize)         $cmd .=" -maxsize=$this->maxsize";
        $cmd .=" $this->imgPath";
        if($this->tempCubePath)    $cmd .=" -tempcubepath=$this->tempCubePath";
        if($this->output)          $cmd .=" -outputpath=$this->output";
        return $cmd;
    }
}
