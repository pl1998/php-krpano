<?php
declare(strict_types=1);

namespace Panliang\PhpKrpano;
use Panliang\PhpKrpano\Command\KrpanoToolsInterface;
use Panliang\PhpKrpano\Exception\KrpanoException;

class KrpanoToolsScripts
{
    /**
     * @var string cmd命令
     */
    protected $baseCmd;

    /**
     * @var string cmd命令
     */
    protected $cmd;

    public function __construct(string $baseCmd)
    {
        $this->baseCmd = $baseCmd;
    }

    public function setCmd(KrpanoToolsInterface $cmd)
    {
        $this->cmd = $cmd->export();
        return $this;
    }

    public function echo()
    {
        if(!$this->cmd) {
            throw new KrpanoException('cmd value not set');
        }
        return "{$this->baseCmd} {$this->cmd}";
    }


}
