<?php


const ADMIN_PATH = __DIR__.'/';
require_once ADMIN_PATH . "admin_config.php";

require_once '../config.php';
require_once ABS_PATH . 'functions' . EXT;

require_once ADMIN_PATH . 'admin_functions.php';


if (DEV_MODE) {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

try {
    \Myapp\AdminKernel::init();
} catch (Exception $ex) {

}