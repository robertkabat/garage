<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class LoggerService
{
    public function log(Exception $exception)
    {
        Log::error('ERROR', [
            'line' => $exception->getLine(),
            'file' => $exception->getFile(),
            'code' => $exception->getCode(),
            'message' => $exception->getMessage()
        ]);
    }
}
