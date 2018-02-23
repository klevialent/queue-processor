<?php

namespace Klevialent\Tests\Unit;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Klevialent\QueueProcessor\TarantoolQueue;
use Tarantool\Client\Client as TarantoolClient;
use Tarantool\Client\Exception\ConnectionException;
use Tarantool\Client\Response;
use Tarantool\Queue\Task;


class TarantoolQueueTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->client = $this->getMockBuilder(TarantoolClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queue = new TarantoolQueue($this->client, 'queue_name');
    }

    public function testTakeWhenReadTimedOutFromQueue()
    {
        $this->client->method('call')->willThrowException(new ConnectionException('Read timed out.'));

        $this->assertNull($this->queue->take());
    }

    /**
     * @expectedException \Tarantool\Client\Exception\ConnectionException
     */
    public function testTakeWhenNotReadTimedOutFromQueue()
    {
        $this->client->method('call')->willThrowException(new ConnectionException(''));

        $this->queue->take();
    }

    public function testTakeTask()
    {
        $response = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->client->method('call')->willReturn($response);
        $response->method('getData')->willReturn([[0, 't', ['data']]]);

        $this->assertInstanceOf(Task::class, $this->queue->take());
    }

    public function testClientDisconnect()
    {
        $this->client->expects($this->once())->method('disconnect');

        $this->queue->clientDisconnect();
    }

    /**
     * @var MockObject
     */
    private $client;

    /**
     * @var TarantoolQueue
     */
    private $queue;
}
