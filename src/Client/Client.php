<?php
/**
 * This file is part of Disque PHP client.
 *
 * @copyright    2015 - Marco Vito Moscaritolo <marco@mavimo.org>
 * @license      https://github.com/mavimo/disque-client-php/blob/master/LICENSE.md
 * @link         https://github.com/mavimo/disque-client-php
 */

namespace Mavimo\Disque\Client;

use Mavimo\Disque\Client\SocketInterface;
use Mavimo\Disque\Job\Job;
use Mavimo\Disque\Queue\Queue;

class Client
{
    protected $socket;

    /**
     * Create a new Disque Client.
     *
     * @param string $address
     * @param int    $port
     */
    public function __construct(SocketInterface $socket)
    {
        $this->socket = $socket;
    }

    /**
     * Extract a job form the queue.
     *
     * @param  Queue $queue     Queue used to extract Job.
     * @param  int   $timeout   Timeout for job extraction from queue
     *
     * @return Job
     */
    public function fetch(Queue $queue, $timeout = null)
    {
        // Compose the command list to get job
        $commands = ['GETJOB'];
        if (!is_null($timeout)) {
            $commands[] = 'TIMEOUT';
            $commands[] = $timeout;
        }
        $commands[] = 'FROM';
        $commands[] = $queue->getName();

        $result = $this->socket->sendCommand($commands);

        if (count($result) > 0) {
            return new Job(
                $result[0][2],
                $result[0][1]
            );
        }
    }

    /**
     * Add a job into queue
     *
     * @param  Queue $queue
     * @param  Job   $job
     * @param  int   $expire
     *
     * @return Job
     */
    public function push(Queue $queue, Job $job, $expire = 0)
    {
        // Compose the command list to add job
        $commands = ['ADDJOB'];
        $commands[] = $queue->getName();
        $commands[] = $job->getBody();
        $commands[] = $expire;

        // Enqueue the job
        $result = $this->socket->sendCommand($commands);
var_dump($result);
        // Set the job ids for the created element
        // $job->setIds($result);

        return $job;
    }
}
