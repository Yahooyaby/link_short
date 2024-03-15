<?php

namespace App\Exceptions;
use Exception;
class RedirectException extends Exception
{
    public function render()
    {
        return response()->json([
            'error' => true,
            'message' => 'Невозможно перейти по ссылке.',
        ], 404);
    }
}
