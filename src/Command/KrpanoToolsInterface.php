<?php
declare(strict_types=1);

namespace Panliang\PhpKrpano\Command;

interface KrpanoToolsInterface
{
    /**
     * export cmd
     * @return string
     */
    public function export():string;
}
