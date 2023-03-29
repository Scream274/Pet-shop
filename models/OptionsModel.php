<?php

namespace Myapp;

class OptionsModel extends DBContext
{
    public function __construct()
    {
        parent::__construct("options");
    }

    public function getAllOptions()
    {
        return $this->getManyRows();
    }

    public function getOption($optionName)
    {
        $result = $this->getManyRows(['option_name' => $optionName]);
        if (count($result) == 1) {
            return $result[0];
        }
        return null;
    }

    public function createOption($optionName, $optionValue, $optionGroup = NULL)
    {
        return $this->addOneRow([
            "name" => $optionName,
            "value" => $optionValue,
            "group" => $optionGroup
        ]) == 1;
    }

    public function updateOption($id, $name, $value, $group)
    {
        return $this->updateOneRow($id, [
                'name' => $name,
                'value' => $value,
                'group' => $group
            ]) == 1;
    }

    public function deleteOption($id){
        return $this->deleteOneRow($id) == 1;
    }

}