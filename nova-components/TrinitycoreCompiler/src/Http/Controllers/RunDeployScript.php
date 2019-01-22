<?php

namespace Sasin91\TrinitycoreCompiler\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Sasin91\TrinitycoreCompiler\Http\Requests\RunDeployScriptRequest;
use Symfony\Component\Process\Process;

class RunDeployScript extends \Illuminate\Routing\Controller
{
    public function __invoke(RunDeployScriptRequest $request)
    {
        $deploy = config('deploy');

        $process = new Process(['bash', './deploy'], $deploy['path']);
        $process->setTty(Process::isTtySupported());

        Cache::put('deploying', true, 60);

        $result = '';

        $process->run(function ($type, $buffer) use (&$result) {
            if (Process::ERR === $type || $buffer === "[100%] Built target worldserver") {
                Cache::forget('deploying');
            }

            $result .= $buffer;

            echo $buffer;
            echo '<br>';
        });

        return $result;
    }
}
