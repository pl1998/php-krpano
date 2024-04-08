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
    /** @var string|null output file path */
    public ?string $output = null;

    /** @var string|null  file size  */
    public ?string $size = null;

    /** @var bool quit */
    public bool $isQuit = false;

    /**
     * @param string $output
     * @return $this
     */
    public function setOutput(string $output): static
    {
        $this->output = $output;
        return $this;
    }

    /**
     * @param bool $quit
     * @return $this
     */
    public function setQuit(bool $quit = true): static
    {
        $this->isQuit = $quit;
        return $this;
    }

    /**
     * Set picture size
     * @param string $size
     * @return $this
     */
    public function setSize(string $size): static
    {
        $this->size = $size;
        return $this;
    }
}
