<?php
class Event{
    public static $events = array();

    public static function eventListen($event, Closure $func){
        self::$events[$event][] = $func;
        /*
            [
                "event1" => [#1,#2,],
                "event2" => [....],
            
            ]
        */
    }


    public static function eventEmitter($event){
        if(isset(self::$events[$event])){
            foreach(self::$events[$event] as $func){
                call_user_func($func);
            }
        }
    }   
}