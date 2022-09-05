<?php
declare(strict_types=1);

date_default_timezone_set('Asia/Shanghai');

ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
set_error_handler('errorHandler', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
set_exception_handler('exceptionHandler');

header('Content-type: application/json; charset=utf-8');
// 跨域
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Authorization,X-Requested-With,X_Requested_With,X-PINGOTHER,Content-Type'); 

if (empty($_FILES) || empty($_FILES['file']) || $_FILES['file']['error'] != UPLOAD_ERR_OK || ! is_uploaded_file($_FILES['file']['tmp_name'])) {
    output('Uploaded fail.', 1);
}
$file = $_FILES['file'];

$uploads_dir = '/tmp/';
$name = basename($file['name']);

$uploaded = move_uploaded_file($file['tmp_name'], $uploads_dir . $name);

if ($uploaded) {
    output('Uploaded success.');
} else {
    output('Sorry, please try again.', 1);
}

/**
 * @param string $msg
 * @param int    $code
 */
function output($msg = 'ok', $code = 0)
{
    echo json_encode(['msg' => $msg, 'code' => $code]);
    exit;
}

/**
 * 错误处理
 *
 * @param int    $severity Error number
 * @param string $errstr   PHP error text string
 * @param string $errfile  File that contained the error
 * @param int    $errline  Line in the file that contained the error
 *
 * @throws \ErrorException
 * @return bool            true: don't execute PHP internal error handler
 */
function errorHandler($severity, $errstr, $errfile, $errline): bool
{
    if (! (error_reporting() & $severity)) {
        return true;
    }

    throw new \ErrorException("{$errstr} in {$errfile} on line {$errline}", $severity, $severity, $errfile, $errline);
}

/**
 * 异常处理
 *
 * @param Throwable $ex
 */
function exceptionHandler(Throwable $ex): void
{
    output($ex->getMessage(), $ex->getCode() ?: 1);
}
