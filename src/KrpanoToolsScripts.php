<?php
declare(strict_types=1);

namespace Panliang\PhpKrpano;
use Panliang\PhpKrpano\Command\KrpanoToolsInterface;
use Panliang\PhpKrpano\Exception\KrpanoException;

class KrpanoToolsScripts
{
    /**
     * @var string
     */
    protected ?string $baseCmd = null;

    /**
     * @var string
     */
    protected string $cmd;

    public function __construct(string $baseCmd)
    {
        $this->baseCmd = $baseCmd;
    }

    /**
     * set cmd
     * @param KrpanoToolsInterface $cmd
     * @return $this
     */
    public function setCmd(KrpanoToolsInterface $cmd) :KrpanoToolsScripts
    {
        $this->cmd = $cmd->export();
        return $this;
    }

    /**
     * @return string
     * @throws KrpanoException
     */
    public function echo() :string
    {
        if(!$this->cmd) {
            throw new KrpanoException('cmd value not set');
        }
        return "{$this->baseCmd} {$this->cmd}";
    }


}
