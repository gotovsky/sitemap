<?php

namespace Skygsn\Sitemap;

use DateTime;

class Url
{
    /**
     * @var string
     */
    private $location;

    /**
     * @var DateTime
     */
    private $lastModified;

    /**
     * @var string
     */
    private $changeFrequency;

    /**
     * @var float
     */
    private $priority;

    /**
     * @param string $location
     * @param DateTime $lastModified
     * @param string $changeFrequency
     * @param float $priority
     */
    public function __construct(
        string $location,
        DateTime $lastModified = null,
        string $changeFrequency = '',
        float $priority = null
    ) {
        $this->location = $location;
        $this->lastModified = $lastModified;
        $this->changeFrequency = $changeFrequency;
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @return string
     */
    public function getChangeFrequency()
    {
        return $this->changeFrequency;
    }

    /**
     * @return float
     */
    public function getPriority()
    {
        return $this->priority;
    }
}