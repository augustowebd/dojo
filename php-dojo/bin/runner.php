<?php
declare(strict_types=1);

return function (callable $run, int $milliseconds)
{
    $seconds = (int) $milliseconds / 1000;
    while(true) {
        $run();
        sleep($seconds);
    }
};
