<?php
declare(strict_types=1);

namespace Panliang\PhpKrpano\Enum;

class CmdEnum
{
    /** @var string  */
    public const CUBE_TO_SPHERE = "cubetosphere";
    /** @var string  */
    public const MAKE_PANO = "makepano";
    /** @var string  */
    public const SPHERE_TO_CUBE = "spheretocube";


    /** @var string  output 6 separate cube face images. */
    public const MODE_CUBE = 'CUBE';

    /** @var string  output a horizontal image strip. */
    public const MODE_H_CUBE = 'HCUBE';

    /** @var string output a vertical image strip */
    public const MODE_V_CUBE = 'VCUBE';

    /** @var string   output a 3x2 arranged image strip */
    public const MODE_CUBE_32 = 'VCUBE_32';

    /** @var string  output a 2x3 arranged image strip. */
    public const MODE_CUBE_23 = 'VCUBE_23';

    /** @var string - output a rectilinear view. */
    public const MODE_CUBE_VIEW = 'VCUBE_VIEW';
}
