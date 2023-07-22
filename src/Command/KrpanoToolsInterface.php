<?php
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2023/7/22
 * Time : 09:54
 **/

namespace Panliang\PhpKrpano\Command;

interface KrpanoToolsInterface
{
    /**
     * export cmd
     * @return string
     */
    public function export():string;
}
