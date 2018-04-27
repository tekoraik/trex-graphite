<?php

/**
 * @property \trex\graphite\TcpClient client
 */
class TcpClientTest extends \Codeception\Test\Unit
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;
    
    protected function _before()
    {
        $this->client = new \trex\graphite\TcpClient('localhost', 2003);
    }

    protected function _after()
    {
    }

    // tests
    public function testWorkProperly()
    {
        for ($i = 1; $i < 1000; ++$i) {
            $this->client->increment('test.foo.bar', $i);
            usleep(1000);
        }
    }
}