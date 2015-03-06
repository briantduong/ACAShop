<?php

/**
 * Pretty print an object to a web-page or CLI
 *
 * @param mixed  $pre  Object to pretty print
 * @param string $name Optional title to print above the object
 *
 * @return void
 */
function pre($pre, $name = null)
{
    if (strtolower(php_sapi_name()) == 'cli') {
        if ($name) {
            echo '---------' . $name . '---------' . PHP_EOL;
        }
        print_r($pre);
    } else {
        if ($name) {
            echo '<h3>' . $name . '</h3>';
        }
        echo '<pre>';
        print_r($pre);
        echo '</pre>';
    }
}

/**
 * Write to a log file, useful when stdout is not readily available
 *
 * @param mixed  $msg  Message to write. Can be a string, array or object
 * @param string $file Name of file to write debug data to
 *
 * @return bool true on success, false on failure
 */
function flog($msg = 'EMPTY', $file = '/home/vagrant/debug.log')
{
    $fp = fopen($file, 'a+');
    $msg = is_array($msg) || is_object($msg) ? json_encode($msg) : $msg;

    if (fwrite($fp, $msg, strlen($msg))) {

        fwrite($fp, PHP_EOL . '________________________________________________' . PHP_EOL);
        return fclose($fp);
    }

    return false;
}