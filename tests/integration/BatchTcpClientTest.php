<?php

/**
 * @property \trex\graphite\TcpClient client
 */
class BatchTcpClientTest extends \Codeception\Test\Unit
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected function _before()
    {
        $this->client = new \trex\graphite\BatchTcpClient('localhost', 2003, 100);
    }

    protected function _after()
    {
    }

    // tests
    public function testWorkProperly()
    {
        for ($i = 1; $i < 1000; ++$i) {
            $this->client->increment('testbatch.foo.bar', $i);
            usleep(1000);
        }
        $this->client->close();
    }
}