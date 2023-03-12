<?php
//include "tempalte.php";
//include_once "navbar".EXT;
//require "configurate.php";
//require_once "admin_config.php";

require_once "config.php";
require_once "functions" . EXT;

$option = new \Myapp\OptionsModel();
$navModel = new \Myapp\NavigateModel();

if (DEV_MODE == true) {
   error_reporting(E_ALL);
} else {
   error_reporting(0);
}

try{
    \Myapp\Kernel::init();
}
catch (Exception $ex){

}