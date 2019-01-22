<?php

namespace Sasin91\TrinitycoreCompiler\Http\Controllers;

use Symfony\Component\Process\Process;

class RunDeployScript extends \Illuminate\Routing\Controller
{
    public function __invoke()
    {
        $deploy = config('deploy');

        $process = new Process(['sudo', "-u {$deploy['user']}", './deploy'], $deploy['path']);

        return response()->stream(function () use ($process) {
            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo 'ERR > '.$buffer;
                } else {
                    echo 'OUT > '.$buffer;
                }
            });
        });
    }
}
