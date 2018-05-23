<?php

namespace App\Exceptions;

class GeneralException extends \Exception
{

    public function render($request)
    {
        return redirect()->home()->withMessage($this->message);
    }
}