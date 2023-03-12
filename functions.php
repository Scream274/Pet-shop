<?php

function varSuperDump($obj)
{
    echo "<pre>";
    var_dump($obj);
    echo "</pre>";
}

function autoloadClassRegister($className)
{
    $dirs = [
        CORE_PATH,
        DB_PATH,
        MODELS_PATH,
        CONTROLLERS_PATH,
        SERVICES_PATH,
        ADM_CORE_PATH,
        ADM_CONTROL_PATH,
        ADM_MODELS_PATH
    ];

    foreach ($dirs as $dir) {
        $className = explode("\\", $className);
        $className = end($className);
        if (file_exists($dir . $className . EXT)) {
            require_once $dir . $className . EXT;
            return;
        }
    }
}

spl_autoload_register("autoloadClassRegister");

function getNavBar()
{
    return [
        ["Id" => 1, "title" => "Main", "href" => "/", "order" => 1, "childs" => null],
        ["Id" => 2, "title" => "Blog", "href" => "/blog", "order" => 2, "childs" => [
            ["id" => 8, "title" => "News", "href" => "/news", "order" => 1, "childs" => null],
            ["id" => 9, "title" => "Archive", "href" => "/archive", "order" => 2, "childs" => null]
        ]
        ],

        ["Id" => 3, "title" => "Contacts", "href" => "/contacts", "order" => 5, "childs" => null],
    ];
}

function getAllData($tableName)
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $query = "SELECT * FROM $tableName";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($conn);
        return $result;
    } else {
        mysqli_close($conn);
        return null;
    }
}

function addNewOption($option_name, $option_value, $option_group = null)
{
    $query = "";
    if (is_null($option_group)) {
        $query = "INSERT INTO `options` (option_name, option_value)
            VALUES ('$option_name', '$option_value')";
    } else {
        $query = "INSERT INTO `options` (option_name, option_value, option_group)
            VALUES ('$option_name', '$option_value', '$option_group')";
    }

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    mysqli_query($conn, $query);

    $result = false;
    if (mysqli_affected_rows($conn) == 1) {
        $result = true;
    }

    mysqli_close($conn);
    return $result;
}

function deleteOneRow($id)
{
    $query = "DELETE FROM `options` WHERE Id = $id";
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    mysqli_query($conn, $query);

    $result = false;
    if (mysqli_affected_rows($conn) == 1) {
        $result = true;
    }

    mysqli_close($conn);
    return $result;
}

function changeOneOption($id, $newData = [])
{
    $query = "UPDATE `options` SET option_name = '$newData[option_name]', 
                     option_value = '$newData[option_value]'  WHERE Id = $id";
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    mysqli_query($conn, $query);

    $result = false;
    if (mysqli_affected_rows($conn) == 1) {
        $result = true;
    }

    mysqli_close($conn);
    return $result;
}

//varSuperDump(getAllData("options"));
//addNewOption('test','test');
//addNewOption('test2','test2','test_group');

//changeOneOption(6, ['option_name'=>'title', 'option_value' => 'Site title']);
//deleteOneRow(7);