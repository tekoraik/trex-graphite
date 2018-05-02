<?php


namespace trex\graphite;


interface Client
{
    public function increment($path, $inc = 1);
    public function close();
}