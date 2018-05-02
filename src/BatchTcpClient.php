<?php


namespace trex\graphite;


class BatchTcpClient implements Client
{
    private $client;
    private $buffer = [];
    private $bufferCounter = 0;
    private $batchSize;

    public function __construct($host, $port, $batchSize = 100)
    {
        $this->client = new TcpClient($host, $port);
        $this->batchSize = $batchSize;
    }


    public function increment($path, $inc = 1)
    {
        if (!array_key_exists($path, $this->buffer)) {
            $this->buffer[$path] = 0;
        }
        ++$this->buffer[$path];
        ++$this->bufferCounter;
        if ($this->bufferCounter >= $this->batchSize) {
            $this->flush();
        }
    }

    public function close()
    {
        $this->flush();
        $this->client->close();
    }

    private function flush()
    {
        foreach ($this->buffer as $path => $increment) {
            $this->client->increment($path, $increment);
        }
    }
}