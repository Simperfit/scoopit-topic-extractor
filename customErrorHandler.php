<?php

function customErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // Ce code d'erreur n'est pas inclus dans error_reporting()
        return;
    }

    throw new Exception("$errstr in $errfile line $errline");
    return true;
}

set_error_handler("customErrorHandler");