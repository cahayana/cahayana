<?php
/**
 * @package     Helpers - helpers
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @version     1
 * @created     2021-05-08
 * @updated     -
 *
 * this file for autoload all file with prefix helpers in this folder and this script load in composer.json
 **/

$files = glob(__DIR__ . '/*_helpers.php');
if ($files === false) {
    throw new RuntimeException("Failed to glob for function files");
}
foreach ($files as $file) {
    require_once $file;
}
unset($file);
unset($files);
