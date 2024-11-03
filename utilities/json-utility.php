<?php

class JsonUtility
{
    public static function encode(array $objectList, $flag) {
        return json_encode($objectList,$flag);
    }
}
