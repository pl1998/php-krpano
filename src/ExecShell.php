<?php
declare(strict_types=1);

namespace Panliang\PhpKrpano;
class ExecShell
{
    /**
     * @var KrpanoToolsScripts
     */
    protected  $scripts;

    /**
     * @var string|array message
     */
    protected $message;

    public function __construct(KrpanoToolsScripts $scripts)
    {
        $this->scripts = $scripts;
    }


    /**
     * exec shell cmd
     * @return $this
     */
    public function exec(callable $callback = null)
    {
        if($callback) {
            call_user_func($callback);
            return $this;
        }
        try {
            if(extension_loaded("swoole") && version_compare(phpversion("swoole"),"4.4.6",">=")) {
                //swoole v4.4.6 后可用
                \Swoole\Coroutine\run(function() {
                    $this->message =  \Swoole\Coroutine\System::exec($this->scripts->echo());
                });
            }else{
                $this->message =  shell_exec($this->scripts->echo());
            }
        }catch (\Throwable $exception) {
            $this->message =  $exception->getMessage();
        }
        return $this;
    }

    /**
     * @return array|string
     */
    public function echo()
    {
        return $this->message;
    }


}
