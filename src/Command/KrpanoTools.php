<?php
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2023/7/22
 * Time : 10:07
 **/

namespace Panliang\PhpKrpano\Command;

abstract class KrpanoTools
{
    /** @var string output file path */
    public $output;

    /** @var string file size  */
    public $size;

    /** @var bool quit */
    public $isQuit = false;

    public function setOutput(string $output)
    {
        $this->output = $output;
        return $this;
    }

    /**
     * @param bool $quit
     * @return $this
     */
    public function setQuit(bool $quit = true)
    {
        $this->isQuit = $quit;
        return $this;
    }

    /**
     * Set picture size
     * @param string $size
     * @return $this
     */
    public function setSize(string $size): CubeToSphere
    {
        $this->size = $size;
        return $this;
    }
}
