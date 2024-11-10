<?php
namespace Utilities;

class JsonUtility
{
    public static function encode(array $objectList) {
        return json_encode($objectList);
    }
}
