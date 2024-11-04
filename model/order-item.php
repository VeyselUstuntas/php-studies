<?php
class OrderItem{
    public int $id;
    public int $user_id;


    public function __construct(int $id,int $user_id )
    {
        $this->user_id = $user_id;
        $this->id = $id;
    }
}