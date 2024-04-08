<?php
declare(strict_types=1);

namespace Panliang\PhpKrpano;
use Throwable;
class ExecShell
{
    /**
     * @var KrpanoToolsScripts
     */
    protected KrpanoToolsScripts  $scripts;

    /**
     * @var string|array|null message
     */
    protected string|null|array $message = null;

    public function __construct(KrpanoToolsScripts $scripts)
    {
        $this->scripts = $scripts;
    }


    /**
     * exec shell cmd
     * @return $this
     */
    public function exec(callable $callback = null) :ExecShell
    {
        //Supports custom output
        if($callback) {
            call_user_func($callback);
            return $this;
        }
        try {
            if(extension_loaded("swoole") && version_compare(phpversion("swoole"),'4.4.6','>=')) {
                 \Swoole\Coroutine\run(function() {
                    $this->message =  \Swoole\Coroutine\System::exec($this->scripts->echo());
                });
            }else{
                $this->message =  shell_exec($this->scripts->echo());
            }
        }catch (Throwable $exception) {
            $this->message =  $exception->getMessage();
        }
        return $this;
    }

    /**
     * @return array|string|null
     */
    public function echo() :array|null|string
    {
        return $this->message;
    }


}
