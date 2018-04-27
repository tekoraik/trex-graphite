<?php
namespace trex\graphite;

class TcpClient
{
    private $socket;

    public function __construct($host, $port)
    {
        $this->socket = fsockopen($host, $port);
    }

    public function close()
    {
        fclose($this->socket);
    }

    public function increment($path, $inc = 1)
    {
        fwrite($this->socket, "$path $inc " . time() . "\n");
    }
}