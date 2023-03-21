<?php

function autoloadAdminClassRegister($className)
{
    $dirs = [
        ADM_CORE_PATH,
        ADM_CONTROL_PATH,
        ADM_MODELS_PATH,
        ADM_VIEWS_PATH,
        ADM_PAGES_PATH
    ];

    foreach ($dirs as $dir) {
        $className = explode('\\', $className);
        $className = end($className);
        if (file_exists($dir . $className . EXT)) {
            require_once $dir . $className . EXT;
            return;
        }
    }
}

spl_autoload_register('autoloadAdminClassRegister');