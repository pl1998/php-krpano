<?php
declare(strict_types=1);

namespace Panliang\PhpKrpano\Command;

use Panliang\PhpKrpano\Exception\KrpanoException;

/**
 * docs https://krpano.com/docu/tools/#spheretocube
 */
class SphereToCube extends KrpanoTools implements KrpanoToolsInterface
{

    use CubeAndSphereInput;

    /**
     *
     * @var string
     */
    protected $model;

    /**
     * @var string
     */
    protected $tiled;

    /**
     * @var string
     */
    protected $infov;

    /** @var bool  Define that the input image is cylindrical pano image. */
    protected $cylinder = false;

    protected $fov;

    protected $lookat;
    protected $rotate;
    protected $outsize;
    protected $noautolevel;
    protected $profile;
    protected $jpegprogressive;

    protected $cachesize;

    protected $noauToLevel;

    /**
     * set mode
     * Mode:
     * CUBE - output 6 separate cube face images.
     * HCUBE - output a horizontal image strip.
     * VCUBE - output a vertical image strip.
     * CUBE32 - output a 3x2 arranged image strip.
     * CUBE23 - output a 2x3 arranged image strip.
     * VIEW - output a rectilinear view.
     * @param string $model
     * @return $this
     */
    public function setMode(string $model): SphereToCube
    {
        $this->model = $model;
        return $this;
    }


    /**
     * Special case - using a tiled-image as input:
     * Input syntax: tiled:tile_%v_%h.jpg:WIDTH:HEIGHT:TILESIZE
     * Ideal for low memory usage and faster processing on huge images. That means first tile the input image using the maketiles tool and then convert it to cube.
     * @param string $tiled
     * @return $this
     */
    public function setTiled(string $tiled): SphereToCube
    {
        $this->tiled = $tiled;
        return $this;
    }

    /** For partial pano images the -infov=### option need to be added. */
    public function setInfoV(string $v): SphereToCube
    {
        if (!in_array($v, ['HFOV', 'VFOV', 'HFOV'])) {
            throw new KrpanoException(
                "
            -infov=HFOVxVFOV/VOFFSET
            HFOV - the horizontal field-of-view in degrees.
            VFOV - the vertical field-of-view in degrees (optional).
            HFOV - a vertical offset in degrees (optional).
            "
            );
        }
        $this->infov = $v;
        return $this;
    }


    /**
     * @param string $cylinder
     * @return $this
     */
    public function setCylinder(bool $bool = true): SphereToCube
    {
        $this->cylinder = $bool;
        return $this;
    }

    public function setFov(string $fov = '#'): SphereToCube
    {
        $this->fov = $fov;
        return $this;
    }


    public function setLookAt(string $lookAt = 'H,V,R'): SphereToCube
    {
        $this->lookat = $lookAt;
        return $this;
    }


    public function setRotate(string $rotate, array $value): SphereToCube
    {
        if (!in_array($rotate, ["XYZ,XZY,YXZ,YZX,ZXY,ZYX"])) {
            throw new KrpanoException(
                "Set a custom viewing rotation.
    ORDER - the axis rotation order, can be XYZ, XZY, YXZ, YZX, ZXY, ZYX.
    X,Y,Z - the rotation angles around the axis in degrees."
            );
        }
        $this->rotate = $rotate . implode(',', $value);

        return $this;
    }

    public function setOutSize(string $size): SphereToCube
    {
        $this->outsize = $size;
        return $this;
    }

    public function setNoAutoLevel(string $value) :SphereToCube
    {
        $this->noautolevel = $value;
        return $this;
    }

    public function setProfile(string $value) :SphereToCube
    {
        if(!in_array($value,["COPY","CONVERT","sRGB","SKIP"])) {
            throw new KrpanoException("Embedded Color Profile (ICC) settings:
COPY - copy the color profile from the input image to the output image (default).
CONVERT - convert to a sRGB color profile but don't embed the profile.
sRGB - convert to a sRGB color profile and embed a very small sRGB profile.
SKIP - skip / ignore an embedded color profile.
");
        }
        $this->profile = $value;
        return $this;
    }


    /**
     * export cmd
     * @return string
     */
    public function export(): string
    {
        // TODO: Implement export() method.
        return "";
    }
}