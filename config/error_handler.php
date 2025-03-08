<?php
/**
 * Custom error handler for the Furni PHP Shop
 * This file sets up error handling for the entire application
 */

// Disable all error reporting except for fatal errors and parse errors
error_reporting(E_ERROR | E_PARSE);

// Don't display errors to the user
ini_set('display_errors', 0);

// Log errors to a file
ini_set('log_errors', 1);
ini_set('error_log', dirname(__DIR__) . '/logs/php_errors.log');

// Create logs directory if it doesn't exist
$logDir = dirname(__DIR__) . '/logs';
if (!file_exists($logDir)) {
    mkdir($logDir, 0777, true);
}

// Set a custom error handler
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    // Don't handle errors that are suppressed with @
    if (error_reporting() === 0) {
        return false;
    }
    
    // Log the error
    error_log("Error [$errno]: $errstr in $errfile on line $errline");
    
    // Don't execute PHP's internal error handler
    return true;
}

// Set the custom error handler
set_error_handler("customErrorHandler");

// Set exception handler
function customExceptionHandler($exception) {
    error_log("Uncaught Exception: " . $exception->getMessage() . 
              " in " . $exception->getFile() . 
              " on line " . $exception->getLine());
}

// Set the custom exception handler
set_exception_handler("customExceptionHandler");
