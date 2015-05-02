<?php
/**
 * This file is part of Disque PHP client.
 *
 * @copyright    2015 - Marco Vito Moscaritolo <marco@mavimo.org>
 * @license      https://github.com/mavimo/disque-client-php/blob/master/LICENSE.md
 * @link         https://github.com/mavimo/disque-client-php
 */

namespace Mavimo\Disque\Job;

class Job
{
    protected $body;

    protected $ids;

    public function __construct($body, $ids = null)
    {
        if (!is_string($body)) {
            throw new \InvalidArgumentException('Job body should be a string');
        }

        $this->body = $body;

        if (!is_null($ids)) {
            $this->setIds($ids);
        }
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getIds()
    {
        return $this->ids;
    }

    public function setIds($ids)
    {
        if (!is_string($ids)) {
            throw new \InvalidArgumentException('Job ids should be a string');
        }

        $this->ids = $ids;
    }

    public function getNodeId()
    {
        return substr($this->ids, 2, 8);
    }

    public function getRandomId()
    {
        return substr($this->ids, 10, 32);
    }

    public function getTtl()
    {
        return substr($this->ids, 42, 4);
    }
}
