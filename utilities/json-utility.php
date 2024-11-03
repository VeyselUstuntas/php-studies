<?php

class JsonUtility
{
    /**
     * @param Order[] $objectList
    */
    public static function orderJsonEncodeList(array $objectList, $flag) {
        return json_encode($objectList,$flag);
    }
}
